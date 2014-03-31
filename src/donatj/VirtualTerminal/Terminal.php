<?php

namespace donatj\VirtualTerminal;

class Terminal {

	var $matrix = array();

	/**
	 * @var int
	 */
	protected $lines;
	/**
	 * @var int
	 */
	protected $cols;

	protected $output_protocol;

	/**
	 * @var Resource
	 */
	protected $STDOUT;

	/**
	 * @var Resource
	 */
	protected $STDERR;

	function __construct( $lines = 24, $cols = 80 ) {
		$this->lines = $lines;
		$this->cols  = $cols;

		for( $x = 1; $x <= $cols; $x++ ) {
			for( $y = 1; $y <= $lines; $y++ ) {
				$this->matrix[$x][$y] = array('rune' => ' ');
			}
		}

		$this->output_protocol = md5('virtTerm' . rand());

		stream_wrapper_register($this->output_protocol, 'donatj\\VirtualTerminal\\OutputStream') or die('error creating wrapper');

		$this->STDOUT = fopen($this->output_protocol . '://stdout', 'w');
		OutputStream::latest_instance()
					->setTerminal($this);

		$this->STDERR = fopen($this->output_protocol . '://stdout', 'w');
		OutputStream::latest_instance()
					->setTerminal($this);
	}

	/**
	 * @return Resource
	 */
	public function getSTDOUT() {
		return $this->STDOUT;
	}

	/**
	 * @return int
	 */
	public function getCols() {
		return $this->cols;
	}

	/**
	 * @return int
	 */
	public function getLines() {
		return $this->lines;
	}

}