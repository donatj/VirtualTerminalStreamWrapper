<?php

namespace donatj\VirtualTerminal\Commands;

abstract class AbstractCommand {

	protected $matched = array();

	abstract function __invoke();

	public function reset() {
		$this->matched = array();
	}

	public function match( $rune ) {
		echo "[{$rune}";
		$pattern = $this->getPattern();
		if( $rune == $pattern[count($this->matched)] ) {
			$matched[] = $rune;
			see('match');
		}
	}

	/**
	 * @return array
	 */
	abstract function getPattern();

}