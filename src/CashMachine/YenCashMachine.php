<?php

declare(strict_types=1);

namespace App\CashMachine;

use App\CashMachine\CashMachine;
use App\CashMachine\Exception\CannotChange;
use App\CashMachine\Model\ChangeEnvelope;
use App\CashMachine\Model\Currency;

define('YEN_POSSIBLE_CHANGE', [10000, 5000, 2000, 1000, 500, 100, 50, 10, 5, 1]);

class YenCashMachine implements CashMachine
{

    public function currency(): Currency
    {
        return new Currency('JPY', '¥');
    }

    public function change(float $amount): ChangeEnvelope
    {
        if (($amount < 1 && $amount > 0) || $amount < 0) {
            throw new CannotChange(
                sprintf('Cannot change "%f", invalid change due.', $amount)
            );
        }

        $changeEnvelope = new ChangeEnvelope([]);

        $changeEnvelope = $changeEnvelope->autoFillEnvelope(constant('YEN_POSSIBLE_CHANGE'), $amount);

        return $changeEnvelope;
    }
}
