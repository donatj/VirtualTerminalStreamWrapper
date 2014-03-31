<?php

namespace donatj\VirtualTerminal;

use donatj\VirtualTerminal\Commands\AbstractCommand;

class CommandCollection {

	/**
	 * @var AbstractCommand[]
	 */
	protected $commands = array();

	public function reset() {
		foreach( $this->commands as $command ) {
			$command->reset();
		}
	}

	public function match( $rune ) {
		foreach( $this->commands as $command ) {
			$command->match($rune);
		}
	}

	public function register( AbstractCommand $command ) {
		$this->commands[] = $command;
	}

}