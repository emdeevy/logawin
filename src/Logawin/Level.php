<?php declare(strict_types=1);

namespace Logawin;

/**
 * enum Level
 *
 * This enum defines different log levels for messages.
 *
 * @package Logawin
 */
enum Level: int
{
    /**
     * Error level.
     */
    case ERROR = 4;

    /**
     * Warning level.
     */
    case WARNING = 3;

    /**
     * Information level.
     */
    case INFO = 2;

    /**
     * Debug level.
     */
    case DEBUG = 1;
}
