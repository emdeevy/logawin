<?php declare(strict_types=1);

namespace Logawin;

use Stringable;

/**
 * interface LoggerInterface
 *
 * This interface defines the contract for a message logger.
 *
 * @package Logawin
 */
interface LoggerInterface
{
    /**
     * Logs a message.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function log(string|Stringable $message): void;
}