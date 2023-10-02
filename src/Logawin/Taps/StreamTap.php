<?php declare(strict_types=1);

namespace Logawin\Taps;

use Logawin\Level;
use Stringable;

/**
 * Placeholder implementation of a stream tap (console tap but differentiated in the console as requested)
 */
class StreamTap extends Tap implements TapInterface
{
    public function __construct(Level $minimumLevel = Level::DEBUG)
    {
        parent::__construct("Stream", $minimumLevel);
    }

    public function pour(Stringable|string $message, Level $level): void
    {
        $ignored = ($level->value >= $this->getMinimumLevel()->value) ? '' : "[Ignored]";

        printf("[%s][%s]%s: %s\n", $level->name, $this->name, $ignored, $message);
    }
}