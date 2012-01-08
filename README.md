# Color messages on console

*Scripts working only for posix systems.*

# Example

```php
<?php 
require_once __DIR__ . '/../src/Wally/Console/Console.php';

use Wally\Console\Console;

$console = Console::getInstance();

echo $console->red("walter %s", "hdaklg") . PHP_EOL;
echo $console->blue("walter %s", "hello") . PHP_EOL;
echo $console->green("walter %s %d %s", "hello", 5, "no") . PHP_EOL;
```

Or using long method for fixed colors:

```php
<?php

$console->setColor(Console::RED);
echo $console->sprintf("hello") . PHP_EOL;

$console->setColor(Console::YELLOW);
echo $console->sprintf("hello %s", "walter") . PHP_EOL;

$console->setColor(Console::GREEN);
echo $console->sprintf("hello %s %s %s", "walter", "dal", "mut") . PHP_EOL;

$console->setColor(Console::BLUE);
echo $console->sprintf("hello %s %s", "walter", "dal mut") . PHP_EOL;
```
