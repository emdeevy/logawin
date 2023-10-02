<?php declare(strict_types=1);

namespace Logawin\Taps;

use Logawin\Level;
use Stringable;

/**
 * Placeholder implementation of a buffer tap (console tap but differentiated in the console as requested)
 */
class BufferTap extends Tap implements TapInterface
{
    public function __construct(Level $minimumLevel = Level::DEBUG)
    {
        parent::__construct("Buffer", $minimumLevel);
    }

    public function pour(Stringable|string $message, Level $level): void
    {
        $ignored = ($level->value >= $this->getMinimumLevel()->value) ? '' : "[Ignored]";

        printf("[%s][%s]%s: %s\n", $level->name, $this->name, $ignored, $message);
    }
}