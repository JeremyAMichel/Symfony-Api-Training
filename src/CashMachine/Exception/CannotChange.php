<?php

declare(strict_types=1);

namespace App\CashMachine\Exception;

use InvalidArgumentException;

/**
 * This exception will occurs whenever a cash machine fails to change certain amount.
 */
final class CannotChange extends InvalidArgumentException
{
}
