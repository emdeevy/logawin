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
readonly class Logger implements LoggerInterface
{
    public function __construct(private Level $minimumLevel)
    {

    }

    /**
     * Logs a message.
     *
     * @param string|Stringable $message The message to be logged.
     * @param Level $level
     *
     * @return void
     */
    public function log(Stringable|string $message, Level $level): void
    {
        $ignored = ($level->value >= $this->minimumLevel->value) ? '' : "[Ignored]";

        printf("[%s][Console]%s: %s\n", $level->name, $ignored, $message);
    }

    /**
     * Logs an error.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function error(Stringable|string $message): void
    {
        $this->log($message, Level::ERROR);
    }

    /**
     * Logs a warning.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function warning(Stringable|string $message): void
    {
        $this->log($message, Level::WARNING);
    }

    /**
     * Logs an info.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function info(Stringable|string $message): void
    {
        $this->log($message, Level::INFO);
    }

    /**
     * Logs a debug.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function debug(Stringable|string $message): void
    {
        $this->log($message, Level::DEBUG);
    }
}