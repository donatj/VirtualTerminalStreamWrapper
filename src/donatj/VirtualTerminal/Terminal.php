<?php


namespace donatj\VirtualTerminal;


class Terminal {

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
	 * @return Resource
	 */
	public function getSTDOUT() {
		return $this->STDOUT;
	}

	function __construct( $lines = 24, $cols = 80 ) {
		$this->lines = $lines;
		$this->cols  = $cols;

		$this->output_protocol = md5('virtTerm' . rand());

		stream_wrapper_register($this->output_protocol, 'donatj\\VirtualTerminal\\OutputStream') or die('error creating wrapper');

		$stdout = fopen($this->output_protocol . '://stdout', 'w');
		$instance = OutputStream::latest_instance();

		$instance->setTerminal($this);

		fwrite($stdout, "bbq funtimes!");
	}

	/**
	 * @return int
	 */
	public function getCols() {
		return $this->cols;
	}

	/**
	 * @param int $cols
	 */
	public function setCols( $cols ) {
		$this->cols = $cols;
	}

	/**
	 * @return int
	 */
	public function getLines() {
		return $this->lines;
	}

	/**
	 * @param int $lines
	 */
	public function setLines( $lines ) {
		$this->lines = $lines;
	}


}