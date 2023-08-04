<?php

declare(strict_types=1);

namespace App\CashMachine;

use App\CashMachine\Exception\CannotChange;
use App\CashMachine\Model\ChangeEnvelope;
use App\CashMachine\Model\Currency;

interface CashMachine
{
    /**
     * Fetch this cash machine supported currency.
     *
     * @return Currency The supported currency
     */
    public function currency(): Currency;

    /**
     * Perform change operation.
     *
     * @param float $amount The amount of money to turn into change
     *
     * @return ChangeEnvelope The change envelope
     * @throws CannotChange If the amount cannot be refund
     */
    public function change(float $amount): ChangeEnvelope;
}
