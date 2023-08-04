<?php

declare(strict_types=1);

namespace App\CashMachine;

use App\CashMachine\Exception\NotRegistered;

interface CashMachineRegistry
{
    /**
     * Get a cash machine from this registry.
     *
     * @param string $currency The currency code
     *
     * @return CashMachine The cash machine object
     * @throws NotRegistered If this cash machine name have not been registered yet.
     */
    public function get(string $currency): CashMachine;
}
