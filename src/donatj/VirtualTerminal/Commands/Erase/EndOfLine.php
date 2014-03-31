<?php

namespace donatj\VirtualTerminal\Commands\Erase;

use donatj\VirtualTerminal\Commands\AbstractCommand;

class EndOfLine extends AbstractCommand {

	/**
	 * @return array
	 */
	function getPattern() {
		return array("\033", "[", "K");
	}


	function __invoke() {
		drop('invoked');
		// TODO: Implement __invoke() method.
	}
}