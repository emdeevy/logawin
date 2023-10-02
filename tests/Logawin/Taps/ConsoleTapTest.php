<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Logawin\Taps\ConsoleTap;
use Logawin\Level;

class ConsoleTapTest extends TestCase
{
    /**
     * @covers ConsoleTap::pour
     */
    public function testPour()
    {
        $tap = new ConsoleTap();
        $message = "Test message";
        $level = Level::INFO;

        ob_start();
        $tap->pour($message, $level);
        $output = ob_get_clean();

        $this->assertStringContainsString("[INFO][Console]: $message", $output);
    }

    /**
     * @covers ConsoleTap::getMinimumLevel
     */
    public function testGetMinimumLevel()
    {
        $tap = new ConsoleTap();

        $this->assertEquals(Level::DEBUG, $tap->getMinimumLevel());
    }

    /**
     * @covers ConsoleTap::setMinimumLevel
     */
    public function testSetMinimumLevel()
    {
        $tap = new ConsoleTap();
        $tap->setMinimumLevel(Level::ERROR);

        $this->assertEquals(Level::ERROR, $tap->getMinimumLevel());
    }
}
