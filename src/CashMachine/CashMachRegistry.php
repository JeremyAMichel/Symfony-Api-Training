<?php

declare(strict_types=1);

namespace App\CashMachine;

use App\CashMachine\CashMachine;
use App\CashMachine\CashMachineRegistry;
use App\CashMachine\Exception\NotRegistered;

final class CashMachRegistry implements CashMachineRegistry
{

    /**
     * @var iterable|CashMachine[]
     */
    private iterable $machines;

    /**
     * @param iterable<CashMachine> $machines
     */
    public function __construct(iterable $machines)
    {
        $this->machines = $machines;
    }

    public function get(string $currency): CashMachine
    {
        /** runs through all the CashMachines detected by symfony, asks them for their symbol,
         * and returns it if this symbol match our currency */
        foreach ($this->machines as $machine) {
            if ($machine->currency()->code() === $currency) {
                return $machine;
            }
        }

        throw new NotRegistered(
            sprintf('No cash machine for currency "%s".', $currency)
        );
    }
}
