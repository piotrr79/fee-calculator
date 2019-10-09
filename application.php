<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Fee\Calculator\Command\CalculatorCommand;

$application = new Application();

// ... register commands
$application->add(new CalculatorCommand());

$application->run();
