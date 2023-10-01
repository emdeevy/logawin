<?php declare(strict_types=1);

namespace Logawin;

use Stringable;

class Logger implements LoggerInterface
{
    public function log(Stringable|string $message): void
    {
        printf("Logger: %s\n", $message);
    }
}