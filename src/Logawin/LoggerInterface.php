<?php declare(strict_types=1);

namespace Logawin;

use Stringable;

interface LoggerInterface
{
    public function log(string|Stringable $message): void;
}