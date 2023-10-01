<?php declare(strict_types=1);

namespace Logawin;

trait LoggerAware
{
    private LoggerInterface $Logger;

    public function setLogger(LoggerInterface $Logger): void
    {
        $this->Logger = $Logger;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->Logger;
    }
}