<?php

require('vendor/autoload.php');

$commands = new \donatj\VirtualTerminal\CommandCollection();

$commands->register( new \donatj\VirtualTerminal\Commands\Erase\EndOfLine() );
$commands->register( new \donatj\VirtualTerminal\Commands\Erase\EndOfLine() );

$term = new \donatj\VirtualTerminal\Terminal(24, 80, $commands);

$stdout = $term->getSTDOUT();
$stderr = $term->getSTDERR();

fwrite($stdout, "Funky Fresh Freedom");

fwrite($stderr, "私るêë");
