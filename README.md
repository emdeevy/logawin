# Logawin Library

The `Logawin` library provides a simple and lightweight solution for logging messages through taps in PHP applications.

## Features

- **Simple Logging**: Log messages to the console with intuitive menthod calls.
- **Log Levels**: Ability to add severity to logs (DEBUG, INFO, WARNING, ERROR).
- **Taps**: Pour your logs through desired taps and bind the minimum severity they should handle.
- **SOLID Principles**: The library (ALMOST) follows SOLID principles for maintainability and extensibility.
- **Dependency Injection**: Libary designed to be used as a dependency through the dependency injection design pattern.

## Installation

1. Add the repository and require the package in the `composer.json` file.

```json
// "repositories": [
    {
      "type": "git",
      "url": "https://github.com/emdeevy/logawin.git",
      "branch": "php/point-three"
    }
// ]
```
```json
// "require": {
        "emdeevy/logawin": "dev-php/point-three"
// }

```
2. `composer install` | `composer update`.
## Usage

```php
<?php declare(strict_types=1);
require_once 'vendor/autoload.php';

use Logawin\Level;
use Logawin\Logger;
use Logawin\LoggerAware;
use Logawin\Taps\BufferTap;
use Logawin\Taps\ConsoleTap;
use Logawin\Taps\StreamTap;

class Client
{
    use LoggerAware;

    public function performAction(Stringable|string $action): void
    {
        $logger = $this->getLogger();

        // Set up your taps
        $consoleTap = new ConsoleTap();
        $ErrorConsoleTap = new ConsoleTap(Level::ERROR);
        $WarningConsoleTap = new ConsoleTap(Level::WARNING);
        $bufferTap = new BufferTap(Level::WARNING);
        $streamTap = new StreamTap(Level::ERROR);

        // Add your taps to the logger
        $logger->addTap($consoleTap);
        $logger->addTap($ErrorConsoleTap);
        $logger->addTap($WarningConsoleTap);
        $logger->addTap($bufferTap);
        $logger->addTap($streamTap);

        // Logg through all taps
        $logger->log(sprintf("Client 1 performed %s", $action), Level::DEBUG);
        $logger->log(sprintf("Client 2 performed %s", $action), Level::INFO);
        $logger->log(sprintf("Client 3 performed %s", $action), Level::WARNING);
        $logger->log(sprintf("Client 4 performed %s", $action), Level::ERROR);

        // Remove taps
        $logger->removeTap($WarningConsoleTap);

        // Log through the new list of taps
        $logger->log(sprintf("Client 5 performed %s", $action), Level::DEBUG);
        $logger->log(sprintf("Client 6 performed %s", $action), Level::INFO);
        $logger->log(sprintf("Client 7 performed %s", $action), Level::WARNING);
        $logger->log(sprintf("Client 8 performed %s", $action), Level::ERROR);
    }
}

$me = new Client();
$me->performAction("an action");
```

Above is what I consider the elegant version, you could just inject the logger as a `LoggerInterface` parameter in any method or constructor and you'll be just as fine.

## Design Principles

### SOLID

- **Single Responsibility Principle (SRP)**: The `Logger` class has a single responsibility: logging messages to the console.

- **Open/Closed Principle (OCP)**: The class is open for extension (you can add more methods or features), but unfortunately, we would not benefit from having it closed for modification, as, to maintain efficiency, minimal modifications will be required in order to expand on, for example, taps functionality.

- **Liskov Substitution Principle (LSP)**: Subclasses could be used interchangeably with `Logger` without affecting the correctness of the program but as its nature is to log/output messages, it should never have 'continued' implementation.

- **Interface Segregation Principle (ISP)**: The classes implements only the necessary methods for its purpose.

- **Dependency Inversion Principle (DIP)**: External dependencies, if any, would be abstracted behind interfaces for easy substitution.

### Design Pattern

The `Logger` class is implemented as a dependency interface, promoting maintainability, testability, and flexibility.