<?php declare(strict_types=1);

namespace Logawin;

use Stringable;

/**
 * class Logger
 *
 * This class implements the LoggerInterface for logging messages.
 *
 * @package Logawin
 */
class Logger implements LoggerInterface
{
    /**
     * Logs a message.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function log(Stringable|string $message): void
    {
        printf("[Console]: %s\n", $message);
    }
}