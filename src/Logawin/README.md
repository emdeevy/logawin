# Logawin Library

The `Logawin` library provides a simple and lightweight solution for logging messages to the console in PHP applications.

## Features

- **Simple Logging**: Log messages to the console with just one method call.
- **SOLID Principles**: The library (ALMOST) follows SOLID principles for maintainability and extensibility.
- **Dependency Injection**: Libary designed to be used as a dependency through the dependency injection design pattern.

## Installation

Simply include the `ConsoleLogger.php` file in your project.

```php
use Logawin\Logger;
```

## Usage

```php
$logger = Logger::getInstance();
$logger->log("This is a log message.");
```

## Design Principles

### SOLID Principles

- **Single Responsibility Principle (SRP)**: The `Logger` class has a single responsibility: logging messages to the console.

- **Open/Closed Principle (OCP)**: The class is open for extension (you can add more methods or features), but unfortunately, we would not benefit from having it closed for modification, as, for example, abstracting Log Levels later on would add unnecessary complexity.

- **Liskov Substitution Principle (LSP)**: Subclasses could be used interchangeably with `Logger` without affecting the correctness of the program but as its nature is to log/output messages, it should never have 'continued' implementation.

- **Interface Segregation Principle (ISP)**: The class implements only the necessary methods for its purpose.

- **Dependency Inversion Principle (DIP)**: External dependencies, if any, would be abstracted behind interfaces for easy substitution.

### Design Pattern (Singleton)

The `Logger` class is implemented as a dependency interface, promoting maintainability, testability, and flexibility.