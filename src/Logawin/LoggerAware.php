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
        if (!isset($this->Logger)) {
            $this->Logger = new Logger();
        }

        return $this->Logger;
    }
}