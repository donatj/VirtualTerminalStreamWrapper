<?php

namespace donatj\VirtualTerminal;

class OutputStream {
//	var $position;
	/**
	 * @var OutputStream[]
	 */
	static $instances;
	protected $varname;

	/**
	 * @var Terminal
	 */
	protected $terminal;

	function __construct() {
		self::$instances[] = $this;
	}

	/**
	 * @return OutputStream
	 */
	static function latest_instance() {
		return end(self::$instances);
	}

	/**
	 * @param Terminal $terminal
	 */
	public function setTerminal( $terminal ) {
		$this->terminal = $terminal;
	}

	function stream_open( $path, $mode, $options, &$opened_path ) {
		$url           = parse_url($path);
		$this->varname = $url["host"];

		return true;
	}

	function stream_write( $data ) {
		$return = $this->mbStringToArray($data);

		foreach($return as $rune) {
			$this->terminal->receiveRune($rune);
		}

		return strlen($data);
	}

	private function mbStringToArray( $string ) {
		$strlen = mb_strlen($string);
		$array  = array();
		while( $strlen ) {
			$array[] = mb_substr($string, 0, 1, "UTF-8");
			$string  = mb_substr($string, 1, $strlen, "UTF-8");
			$strlen  = mb_strlen($string);
		}

		return $array;
	}

}