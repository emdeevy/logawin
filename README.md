# Logawin Library

The `Logawin` library provides a simple and lightweight solution for logging messages to the console in PHP applications.

## Features

- **Simple Logging**: Log messages to the console with just one method call.
- **SOLID Principles**: The library (ALMOST) follows SOLID principles for maintainability and extensibility.
- **Dependency Injection**: Libary designed to be used as a dependency through the dependency injection design pattern.

## Installation

1. Add the repository and require the package in the `composer.json` file.

```json
// "repositories": [
    {
      "type": "git",
      "url": "https://github.com/emdeevy/logawin.git",
      "branch": "php/point-two"
    }
// ]
```
```json
// "require": {
        "emdeevy/logawin": "dev-php/point-two"
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

class Client
{
    use LoggerAware;

    public function performAction(Stringable|string $action): void
    {
        $this->setLogger(new Logger(Level::WARNING));

        $logger = $this->getLogger();

        $logger->log(sprintf("A Client performed %s", $action), Level::DEBUG);
        $logger->log(sprintf("A Client performed %s", $action), Level::INFO);
        $logger->log(sprintf("A Client performed %s", $action), Level::WARNING);
        $logger->log(sprintf("A Client performed %s", $action), Level::ERROR);
    }
}

$me = new Client();
$me->performAction("comment");
```

Above is what i consider the elegant version, you could just inject the logger as a `LoggerInterface` parameter in any method or constructor and you'll be just as fine.

## Design Principles

### SOLID

- **Single Responsibility Principle (SRP)**: The `Logger` class has a single responsibility: logging messages to the console.

- **Open/Closed Principle (OCP)**: The class is open for extension (you can add more methods or features), but unfortunately, we would not benefit from having it closed for modification, as, to maintain efficiency, minimal modifications will be required in order to restrict log levels per target.

- **Liskov Substitution Principle (LSP)**: Subclasses could be used interchangeably with `Logger` without affecting the correctness of the program but as its nature is to log/output messages, it should never have 'continued' implementation.

- **Interface Segregation Principle (ISP)**: The class implements only the necessary methods for its purpose.

- **Dependency Inversion Principle (DIP)**: External dependencies, if any, would be abstracted behind interfaces for easy substitution.

### Design Pattern

The `Logger` class is implemented as a dependency interface, promoting maintainability, testability, and flexibility.