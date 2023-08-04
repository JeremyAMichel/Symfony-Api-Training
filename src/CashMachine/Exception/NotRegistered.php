<?php

declare(strict_types=1);

namespace App\CashMachine\Exception;

use InvalidArgumentException;

/**
 * This exception will occurs whenever a not registered cash machine is fetched from the registry.
 */
final class NotRegistered extends InvalidArgumentException
{
}
