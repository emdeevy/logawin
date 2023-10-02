<?php declare(strict_types=1);

namespace Logawin;

/**
 * Trait LoggerAware
 *
 * This trait provides functionality for classes that need to be aware of a logger.
 *
 * @package Logawin
 */
trait LoggerAware
{
    /**
     * @var LoggerInterface The logger instance.
     */
    private LoggerInterface $Logger;

    /**
     * Set the logger instance.
     *
     * @param LoggerInterface $Logger The logger instance to be set.
     * @return void
     */
    public function setLogger(LoggerInterface $Logger): void
    {
        $this->Logger = $Logger;
    }

    /**
     * Get the logger instance.
     *
     * @return LoggerInterface The logger instance.
     */
    public function getLogger(): LoggerInterface
    {
        if (!isset($this->Logger)) {
            $this->Logger = new Logger(Level::DEBUG);
        }

        return $this->Logger;
    }
}