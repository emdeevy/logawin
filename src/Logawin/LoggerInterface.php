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
     * @param Level $level The log level we want to output the log at.
     * @return void
     */
    public function log(string|Stringable $message, Level $level): void;

    /**
     * Logs an error message.
     *
     * @param string|Stringable $message The error message to be logged.
     *
     * @return void
     */
    public function error(string|Stringable $message): void;

    /**
     * Logs a warning message.
     *
     * @param string|Stringable $message The warning message to be logged.
     *
     * @return void
     */
    public function warning(string|Stringable $message): void;

    /**
     * Logs an info message.
     *
     * @param string|Stringable $message The info message to be logged.
     *
     * @return void
     */
    public function info(string|Stringable $message): void;

    /**
     * Logs a debug message.
     *
     * @param string|Stringable $message The debug message to be logged.
     *
     * @return void
     */
    public function debug(string|Stringable $message): void;
}