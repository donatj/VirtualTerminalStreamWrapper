<?php

namespace donatj\VirtualTerminal\Commands;

abstract class AbstractCommand {

	protected $matched = array();

	abstract function __invoke();

	public function reset() {
		$this->matched = array();
	}

	public function match( $rune ) {
//		echo "[{$rune}";
		$pattern = $this->getPattern();

		// @todo the following is just a basic proof of concept and not at all a decent pattern matching scheme
		if( $rune == $pattern[count($this->matched)] ) {
			$this->matched[] = $rune;
			echo "[{$rune}]";

			if(count($pattern) == count($this->matched)) {
				$this->__invoke();
				$this->reset();
			}

		}else{
			$this->reset();
		}
	}

	/**
	 * @return array
	 */
	abstract function getPattern();

}