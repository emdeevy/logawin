<?php declare(strict_types=1);

namespace Logawin;

use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @covers Logger::__construct
     */
    public function testLoggerImplementsInterface()
    {
        $logger = new Logger(Level::DEBUG);
        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    /**
     * @covers Logger::log
     */
    public function testLoggerLogsMessage()
    {
        $logger = new Logger(Level::DEBUG);

        ob_start();
        $logger->log('Test message', Level::INFO);
        $output = ob_get_clean();

        $this->assertStringContainsString('[INFO][Console]: Test message', $output);
    }

    /**
     * @covers Logger::error
     */
    public function testLoggerError()
    {
        $logger = new Logger(Level::ERROR);

        ob_start();
        $logger->error('Error message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[ERROR][Console]: Error message', $output);
    }

    /**
     * @covers Logger::warning
     */
    public function testLoggerWarning()
    {
        $logger = new Logger(Level::WARNING);

        ob_start();
        $logger->warning('Warning message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[WARNING][Console]: Warning message', $output);
    }

    /**
     * @covers Logger::info
     */
    public function testLoggerInfo()
    {
        $logger = new Logger(Level::INFO);

        ob_start();
        $logger->info('Info message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[INFO][Console]: Info message', $output);
    }

    /**
     * @covers Logger::debug
     */
    public function testLoggerDebug()
    {
        $logger = new Logger(Level::DEBUG);

        ob_start();
        $logger->debug('Debug message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[DEBUG][Console]: Debug message', $output);
    }

    /**
     * @covers LoggerAware::setLogger
     * @covers LoggerAware::getLogger
     * @covers LoggerAware::logMessage
     */
    public function testLoggerAwareTrait()
    {
        $class = new class {
            use LoggerAware;

            public function logMessage($message, $level): void
            {
                $this->getLogger()->log($message, $level);
            }
        };

        $logger = new Logger(Level::DEBUG);
        $class->setLogger($logger);

        // Redirect output to a buffer
        ob_start();
        $class->logMessage('Test message', Level::INFO);
        $output = ob_get_clean();

        $this->assertStringContainsString('[INFO][Console]: Test message', $output);
    }

    /**
     * @covers LoggerAware::setLogger
     * @covers LoggerAware::getLogger
     * @covers LoggerAware::logMessage
     */
    public function testLoggerAwareTraitWithoutSettingLogger()
    {
        // Create a class that uses the LoggerAware trait
        $class = new class {
            use LoggerAware;

            public function logMessage($message, $level):void
            {
                $this->getLogger()->log($message, $level);
            }
        };

        // Redirect output to a buffer
        ob_start();
        $class->logMessage('Test message', Level::INFO);
        $output = ob_get_clean();

        $this->assertStringContainsString('[INFO][Console]: Test message', $output);
    }
}
