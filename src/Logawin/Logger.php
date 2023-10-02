<?php declare(strict_types=1);

namespace Logawin;

use Logawin\Taps\ConsoleTap;
use Logawin\Taps\TapInterface;
use Stringable;

/**
 * class Logger
 *
 * This class implements the LoggerInterface for logging messages.
 *
 * @package Logawin
 */
class Logger implements LoggerInterface
{

    public function __construct(/** @var TapInterface[] */ private array $cask = [])
    {
        if (empty($this->cask) && PHP_SAPI === 'cli') {
            $this->addTap(new ConsoleTap());
        }
    }

    /**
     * Returns the current cask
     *
     * @return TapInterface[]
     */
    public function getCask(): array
    {
        return $this->cask;
    }

    /**
     * Adds a Tap to the cask.
     *
     * @param TapInterface $tap The TapInterface to be added.
     *
     * @return void
     */
    public function addTap(TapInterface $tap): void
    {
        foreach ($this->cask as $element) {
            if ($element instanceof $tap && $element->getMinimumLevel() === $tap->getMinimumLevel()) {
                return;
            }
        }

        $this->cask[] = $tap;
    }

    /**
     * Removes a Tap from the cask.
     *
     * @param TapInterface $tap The TapInterface to be removed.
     *
     * @return void
     */
    public function removeTap(TapInterface $tap): void
    {
        foreach ($this->cask as $key => $element) {
            if ($element instanceof $tap && $element->getMinimumLevel() === $tap->getMinimumLevel()) {
                unset($this->cask[$key]);
            }
        }
    }

    /**
     * Logs a message.
     *
     * @param string|Stringable $message The message to be logged.
     * @param Level $level
     *
     * @return void
     */
    public function log(Stringable|string $message, Level $level): void
    {
        foreach ($this->cask as $tap) {
            $tap->pour($message, $level);
        }
    }

    /**
     * Logs an error.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function error(Stringable|string $message): void
    {
        $this->log($message, Level::ERROR);
    }

    /**
     * Logs a warning.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function warning(Stringable|string $message): void
    {
        $this->log($message, Level::WARNING);
    }

    /**
     * Logs an info.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function info(Stringable|string $message): void
    {
        $this->log($message, Level::INFO);
    }

    /**
     * Logs a debug.
     *
     * @param string|Stringable $message The message to be logged.
     *
     * @return void
     */
    public function debug(Stringable|string $message): void
    {
        $this->log($message, Level::DEBUG);
    }
}