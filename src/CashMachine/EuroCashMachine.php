<?php

declare(strict_types=1);

namespace App\CashMachine;

use App\CashMachine\CashMachine;
use App\CashMachine\Exception\CannotChange;
use App\CashMachine\Model\ChangeEnvelope;
use App\CashMachine\Model\Currency;

define('EURO_POSSIBLE_CHANGE', [500, 200, 100, 50, 20, 10, 5, 2, 1, 0.50, 0.20, 0.10, 0.05, 0.02, 0.01]);

class EuroCashMachine implements CashMachine
{

    public function currency(): Currency
    {
        return new Currency('EUR', '€');
    }

    public function change(float $amount): ChangeEnvelope
    {
        if (($amount < 0.01 && $amount > 0 ) || $amount < 0) {
            throw new CannotChange(
                sprintf('Cannot change "%f", invalid change due.', $amount)
            );
        }

        $changeEnvelope = new ChangeEnvelope([]);

        $changeEnvelope = $changeEnvelope->autoFillEnvelope(constant('EURO_POSSIBLE_CHANGE'), $amount);

        return $changeEnvelope;
    }
}
