<?php

declare(strict_types=1);

namespace App\Tests\CashMachine;

use App\CashMachine\CashMachine;
use App\CashMachine\CashMachineRegistry;
use App\CashMachine\Exception\NotRegistered;
use App\CashMachine\Model\Change;
use App\CashMachine\Model\ChangeEnvelope;
use PHPUnit\Framework\ExpectationFailedException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class CashMachineTestCase extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    public static function assertEnvelopeContent(array $expectations, ChangeEnvelope $envelope): void
    {
        self::assertCount(count($expectations), $content = $envelope->content());
        foreach ($expectations as [$amount, $quantity]) {
            self::assertNotNull($change = self::findChange($content, $amount));
            self::assertSame($quantity, $change->quantity());
        }
    }

    private static function findChange(array $envelopeContent, float $amount): ?Change
    {
        /** @var Change $change */
        foreach ($envelopeContent as $change) {
            if ($change->amount() == $amount) {
                return $change;
            }
        }

        return null;
    }

    protected function getCashMachine(string $currency): CashMachine
    {
        try {
            /** @var CashMachineRegistry $registry */
            $registry = self::getContainer()->get(CashMachineRegistry::class);
        } catch (ServiceNotFoundException $exception) {
            throw new ExpectationFailedException(
                'Unable to get cash machine registry from container.',
                null,
                $exception
            );
        }

        self::assertInstanceOf(CashMachineRegistry::class, $registry);

        try {
            return $registry->get($currency);
        } catch (NotRegistered $exception) {
            throw new ExpectationFailedException(
                'Unable to get ' . $currency . ' cash machine from registry.',
                null,
                $exception
            );
        }
    }
}
