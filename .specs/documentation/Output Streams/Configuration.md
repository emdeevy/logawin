The output streams should be able to be configured as such:
 - An output stream should be able to only output a log with a specific range of log levels.
 - An output stream should be able to overlap, e.g. a console output stream should be able to output all log levels while a database output stream should be able to log only warnings for the same logger instance.