<?php declare(strict_types=1);

namespace Logawin;

use Stringable;

interface LoggerInterface
{
    public function error(string|Stringable $message): void;
    public function warning(string|Stringable $message): void;
    public function info(string|Stringable$message): void;
    public function debig(string|Stringable $message): void;
    public function log(string|Stringable $message, Level $level): void;
}