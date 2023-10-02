<?php declare(strict_types=1);

namespace Logawin\Taps;

use Logawin\Level;

/**
 * Tap
 *
 * This abstract class provides a base implementation for TapInterface.
 *
 * @package Logawin\Taps
 */
abstract class Tap implements TapInterface
{

    public function __construct(public string $name, private Level $minimumLevel = Level::DEBUG)
    {

    }

    /**
     * Gets the minimum log level this tap accepts.
     *
     * @return Level The minimum log level.
     */
    public function getMinimumLevel(): Level
    {
        return $this->minimumLevel;
    }

    /**
     * Sets the minimum log level for this tap.
     *
     * @param Level $minimumLevel The minimum log level to set.
     *
     * @return void
     */
    public function setMinimumLevel(Level $minimumLevel): void
    {
        $this->minimumLevel = $minimumLevel;
    }
}