<?php

declare(strict_types=1);

namespace App\CashMachine\Model;

final class Change
{
    /**
     * The change amount
     * @var float
     */
    private float $amount;

    /**
     * The change quantity
     * @var int
     */
    private int $quantity;

    /**
     * @param float $amount   The change amount
     * @param int   $quantity The change quantity
     */
    public function __construct(float $amount, int $quantity = 0)
    {
        $this->amount = $amount;
        $this->quantity = $quantity;
    }

    /**
     * Fetch this change amount
     *
     * @return float The change amount
     */
    public function amount(): float
    {
        return $this->amount;
    }

    /**
     * Fetch this change quantity
     *
     * @return int The change quantity
     */
    public function quantity(): int
    {
        return $this->quantity;
    }
}
