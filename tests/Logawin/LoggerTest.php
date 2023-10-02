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
        $logger = new Logger();
        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    /**
     * @covers Logger::log
     */
    public function testLoggerLogsMessage()
    {
        $logger = new Logger();

        // Redirect output to a buffer
        ob_start();
        $logger->log('Test message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[Console]: Test message', $output);
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

            public function logMessage($message): void
            {
                $this->getLogger()->log($message);
            }
        };

        $logger = new Logger();
        $class->setLogger($logger);

        ob_start();
        $class->logMessage('Test message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[Console]: Test message', $output);
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

            public function logMessage($message): void
            {
                $this->getLogger()->log($message);
            }
        };

        ob_start();
        $class->logMessage('Test message');
        $output = ob_get_clean();

        $this->assertStringContainsString('[Console]: Test message', $output);
    }
}
