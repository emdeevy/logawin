# Considerations and Notes
There are a few things that have been assumed throughout the development of the challenge, I will note each scenario and their respective potential solution below.

## Performance and Improvements
Logawin is not exactly an engineering masterpiece when it comes to performance for in the context of its scope, it's as good as it gets. By keeping proper coding standards and avoiding senseless resource consuming practices I can confidently state that the design of this logger is as performant as possible with a few obvious exceptions and a few intentional ones (suggested in the task itself).

Let's take some practical examples and their improvement:

### Loops, nested clauses, code cleanliness
While we kept the codebase clean, readable and nice to go through (hopefully) and used guard clauses to avoid nested clauses, there are still some loops I am not pleased with.

Since there is very little to optimise when it comes to efficiency in this task, since it has no algorithmic components, it all comes down to the few loops. In our case most will be O(n) without possibility to improve on, but then we have something like this:

```php
    public function log(Stringable|string $message, Level $level): void
    {
        foreach ($this->cask as $tap) {
            $tap->pour($message, $level);
        }
    }
```

practically going through all taps in the cask, and attempting to pour through it, letting it be accepted or declined by the tap through the `ignore` if statement,
```php
    public function pour(Stringable|string $message, Level $level): void
    {
        $ignored = ($level->value >= $this->getMinimumLevel()->value) ? '' : "[Ignored]";

        printf("[%s][%s]%s: %s\n", $level->name, $this->name, $ignored, $message);
    }
```

### Solution
The ideal here would be inserting the tap into its sorted, rightful position in the cask, in such a way that when we loop through the taps inside the cask, we stop at where none of the future taps will accept the log severity any longer, therefore the loop stops before `n` (even though complexity remains O(n), there is still some room for a bit of practical efficiency).

## Programming Language, Runtime and Concurrency
At first glance reading the entire document, the design for this task looked much different from what it ended up being. Because these terms mentioned in the subtitle started conflicting with each other.

We are first told we can use a programming language of our choice, to remain consistent with my application, I chose to stick with PHP, further exploring with Java down the line in my free time. As we know, PHP is interpreted, thus, it does not have runtime and neither does it belong in the same sentence with "multi-threading". So the following assumptions have been made:
 - **Runtime = interpretation time** - we consider runtime being the time the execution pointer runs through our code during interpretation. The alternative of this is simulating true runtime through websockets (browser/cli) or prompting (cli). In the case of the alternative, the two configurations we were asked to implement that are supposed to work during runtime need to be external. e.g. database records, redis or configuration files which organically do not belong in a library/module/package (but are very easy to implement nonetheless, and am willing to expand on during the interview). 
 - **multi-threading = multiple simultaneous requests** - we consider the multi-threading issues being users requesting the same php script in the exact same time with the exact same configurations, resulting in, say, writing logs to the same file in the same time. The alternative is similar, which is some external application running php scripts on different threads, say we have a java application that spawns a new thread and runs the same php scrips in each thread logging to the same file. In either cases, most php I/O is thread-safe, especially the conventional ways of handling message/data transfer, e.g. through sockets or database connections. But in the rare case such as writing to the same file at once, without using locks such as flock or any other sync mechanism, those we should always handle externally and never in the php script itself.

Because of all 3 of these reasons, to return back to the original statement, the design of the task was completely different, and if I were to truly implement something like this for a formally assigned task, I would choose something like the following:
 - **Service handling incoming messages (Logs, Internal Events, Internal Notifications)** written in rust: receives messages and stores them in 2 stages
   - Temporary: 3000 - 10000 messages in a pub/sub channel for each sender
   - Permanently: everything earlier than the last 3000 - 10000 are picked up and sent to a scylladb cluster where they die
 - **Websocket - gRPC Bridge Service** probably in rust/go?: receive messages through websockets, turns them into proto, sends them through gRPC. 
 - **PHP Browser Client** (websokets + react): Generates logs, internal events and internal notifications on the fly, sends them through websockets to the bridge, that turns them into proper packets for the Rust Message Handler Service to push them down the pipeline.
 - **PHP Console Client**: same as above but does it through some Symfony Console prompts.
 - **Java Client**: same as above but has cool runtime and threads and all those shiny things, so it can send logs, internal events and internal notifications differently than PHP,

## Where could we make Logawin more open to modifications?
Simple: Abstraction of the Taps functionality and making data flow compact.
A few practical examples:
 - having a Log object that would represent our message and all the necessary data regarding the message alone, such as Log Severity, Sender, more formatting functionality, such as colors, placeholders and flags and the time it was sent.
 - having different classes altogether for handling the message through the tap. For example what technology needs to be used while pouring, like emailing vendors, socket or database connections, etc.
 - utility classes on extremities, such as graceful handling of errors or closures in the case of memory using taps. If for example, a buffer tap that has stored messages awaiting to be logged but have either never been logged or have been logged but the buffer is still containing them, having a way to clear it through a uniformly designed interface would be beneficial.
 - use some sort of Map for the list of Taps maybe?

In general, if this project were to continue further, more abstraction would be ideal.