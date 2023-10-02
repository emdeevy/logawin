<?php declare(strict_types=1);

namespace Logawin\Taps;

use Logawin\Level;
use Stringable;

/**
 * class ConsoleTap
 *
 * This class extends the Tap class to implement TapInterface for logging messages to the console (through the console tap).
 *
 * @package Logawin\Taps
 */
class ConsoleTap extends Tap implements TapInterface
{
    public function __construct(Level $minimumLevel = Level::DEBUG)
    {
        parent::__construct("Console", $minimumLevel);
    }

    /**
     * Pours a message through the tap.
     *
     * @param string|Stringable $message The message to be poured.
     * @param Level $level The log level of the message.
     *
     * @return void
     */
    public function pour(Stringable|string $message, Level $level): void
    {
        $ignored = ($level->value >= $this->getMinimumLevel()->value) ? '' : "[Ignored]";

        printf("[%s][%s]%s: %s\n", $level->name, $this->name, $ignored, $message);
    }
}