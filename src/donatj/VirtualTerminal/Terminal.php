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

	/**
	 * @var bool
	 */
	protected $status_line_wrap = true;

	/**
	 * @var CommandCollection
	 */
	protected $command_collection;

	function __construct( $lines = 24, $cols = 80, CommandCollection $command_collection ) {
		$this->lines = $lines;
		$this->cols  = $cols;

		$this->command_collection = $command_collection;

		for( $x = 1; $x <= $cols; $x++ ) {
			for( $y = 1; $y <= $lines; $y++ ) {
				$this->matrix[$x][$y] = array( 'rune' => ' ' );
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
	 * @return Resource
	 */
	public function getSTDERR() {
		return $this->STDERR;
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

	public function receiveRune( $rune ) {
//		echo "|{$rune}";
		$this->command_collection->match( $rune );
	}

}