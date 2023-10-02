<?php declare(strict_types=1);

namespace Logawin\Taps;

use Logawin\Level;
use Stringable;

/**
 * interface TapInterface
 *
 * This interface defines the contract for a tap in the cask of a logger.
 *
 * @package Logawin\Taps
 */
interface TapInterface
{
    /**
     * Gets the minimum log level this tap accepts.
     *
     * @return Level The minimum log level.
     */
    public function getMinimumLevel(): Level;

    /**
     * Sets the minimum log level for this tap.
     *
     * @param Level $minimumLevel The minimum log level to set.
     *
     * @return void
     */
    public function setMinimumLevel(Level $minimumLevel): void;

    /**
     * Pours a message through the tap.
     *
     * @param string|Stringable $message The message to be poured.
     * @param Level $level The log level of the message.
     *
     * @return void
     */
    public function pour(Stringable|string $message, Level $level): void;
}