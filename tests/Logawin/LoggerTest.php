<?php declare(strict_types=1);

namespace Logawin;

use Logawin\Taps\ConsoleTap;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @covers Logger::addTap
     */
    public function testAddTap()
    {
        $logger = new Logger();
        $consoleTap = new ConsoleTap();
        $logger->addTap($consoleTap);

        $this->assertCount(1, $logger->getCask());
    }

    /**
     * @covers Logger::removeTap
     */
    public function testRemoveTap()
    {
        $logger = new Logger();
        $consoleTap = new ConsoleTap();
        $logger->addTap($consoleTap);
        $logger->removeTap($consoleTap);

        $this->assertCount(0, $logger->getCask());
    }

    /**
     * @covers Logger::__construct
     */
    public function testLoggerImplementsInterface()
    {
        $logger = new Logger();
        $this->assertInstanceOf(LoggerInterface::class, $logger);
    }

    /**
     * @covers Logger::addTap
     * @covers Tap::pour
     * @covers Logger::error
     * @throws Exception
     */
    public function testLogError()
    {
        $logger = new Logger();
        $mockTap = $this->createMock(ConsoleTap::class);

        $mockTap
            ->expects($this->once())
            ->method('pour')
            ->with(
                $this->isType('string'),
                $this->equalTo(Level::ERROR)
            );

        ob_start();

        $logger->addTap($mockTap);
        $logger->error('Error message');

        $output = ob_get_clean();

        $this->assertStringContainsString('[ERROR][Console]: Error message', $output);
    }

    /**
     * @covers Logger::addTap
     * @covers Tap::pour
     * @covers Logger::warning
     * @throws Exception
     */
    public function testLogWarning()
    {
        $logger = new Logger();
        $mockTap = $this->createMock(ConsoleTap::class);

        $mockTap->expects($this->once())
            ->method('pour')
            ->with(
                $this->isType('string'),
                $this->equalTo(Level::WARNING)
            );

        ob_start();

        $logger->addTap($mockTap);
        $logger->warning('Warning message');

        $output = ob_get_clean();

        $this->assertStringContainsString('[WARNING][Console]: Warning message', $output);
    }

    /**
     * @covers Logger::addTap
     * @covers Tap::pour
     * @covers Logger::debug
     * @throws Exception
     */
    public function testLogDebug()
    {
        $logger = new Logger();
        $mockTap = $this->createMock(ConsoleTap::class);

        $mockTap->expects($this->once())
            ->method('pour')
            ->with(
                $this->isType('string'),
                $this->equalTo(Level::DEBUG)
            );

        ob_start();

        $logger->addTap($mockTap);
        $logger->debug('Debug message');

        $output = ob_get_clean();

        $this->assertStringContainsString('[DEBUG][Console]: Debug message', $output);
    }

    /**
     * @covers Logger::addTap
     * @covers Tap::pour
     * @covers Logger::info
     * @throws Exception
     */
    public function testLogInfo()
    {
        $logger = new Logger();
        $mockTap = $this->createMock(ConsoleTap::class);

        $mockTap->expects($this->once())
            ->method('pour')
            ->with(
                $this->isType('string'),
                $this->equalTo(Level::INFO)
            );

        ob_start();

        $logger->addTap($mockTap);
        $logger->info('Info message');

        $output = ob_get_clean();

        $this->assertStringContainsString('[INFO][Console]: Info message', $output);
    }


    /**
     * @covers Logger::log
     */
    public function testLoggerLogsMessageWithoutSpecifyingTap()
    {
        $logger = new Logger();

        ob_start();
        $logger->log('Test message', Level::DEBUG);
        $output = ob_get_clean();

        $this->assertStringContainsString('[Console]: Test message', $output);
    }

    /**
     * @covers LoggerAware::setLogger
     * @covers LoggerAware::getLogger
     * @covers LoggerAware::logMessage
     * @throws Exception
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

        $logger = new Logger();
        $class->setLogger($logger);

        $mockTap = $this->createMock(ConsoleTap::class);

        $mockTap->expects($this->once())
            ->method('pour')
            ->with(
                $this->isType('string'),
                $this->equalTo(Level::INFO)
            );

        $logger->addTap($mockTap);

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
        $class = new class {
            use LoggerAware;

            public function logMessage($message, $level): void
            {
                $this->getLogger()->log($message, $level);
            }
        };

        $mockTap = $this->createMock(ConsoleTap::class);

        $mockTap->expects($this->once())
            ->method('pour')
            ->with(
                $this->isType('string'),
                $this->equalTo(Level::INFO)
            );

        $class->getLogger()->addTap($mockTap);

        // Redirect output to a buffer
        ob_start();
        $class->logMessage('Test message', Level::INFO);
        $output = ob_get_clean();

        $this->assertStringContainsString('[INFO][Console]: Test message', $output);
    }
}
