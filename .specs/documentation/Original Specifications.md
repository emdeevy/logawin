# Logger Exercise

Note: Use Obsidian to read these unless you enjoy having your eyes bleed.
## Overview
We aim to build a small Logger library that can be used by other development teams within the company. This library should be generic, open, and capable of handling different log levels and targets.

Note: As per original PDF: Logger library in the [[Programming Language|programming language of our choice]]

## Components

### Send logs to a Target
- Implement the ability to [[Send|write]] [[Log Overview|messages]] to an [[Output Streams Overview|output stream]].

### Support for Log Levels
- Add support for different [[Log Overview|log]] [[Log Levels Overview|levels]]: [[Log/Levels/Debug|Debug]], [[Log/Levels/Info|Info]], [[Log/Levels/Warning|Warning]], [[Log/Levels/Error|Error]].
- Allow runtime [[Output Streams/Configuration|configuration]] of the log level range.

### Level - Target Configuration
- Allow [[Output Streams/Configuration|configuration]] of the log level range.
- Allow [[Output Streams/Configuration|configuration]] of the streams between different log levels and the targets.

## Considerations

### Performance
Optimise for heavy usage scenarios. The logger should handle high volumes of logs efficiently.

### Multi-threading
Ensure proper management in a multi-threading environment to avoid race conditions and conflicts.

### Clean Code and Structure
Maintain clean code practices for readability and maintainability.

## Additional Points (Optional)

### Making Logger More Open to Modification
Consider how and where the Logger could be made more open to modification.

### Ideas for Improvement
Provide your own ideas on how to improve the Logger.

### Code Optimisation
Suggest improvements to the code that could simplify the Big O notation of every method. This could involve removing loops, if statements, switches, etc.