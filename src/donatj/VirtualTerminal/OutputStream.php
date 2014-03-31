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

//		$this->position = 0;

		return true;
	}

//	function stream_read( $count ) {
//		$ret = substr($GLOBALS[$this->varname], $this->position, $count);
//		$this->position += strlen($ret);
//
//		return $ret;
//	}

	function stream_write( $data ) {
		see($data, $this->varname);
//		$left                    = substr($GLOBALS[$this->varname], 0, $this->position);
//		$right                   = substr($GLOBALS[$this->varname], $this->position + strlen($data));
//		$GLOBALS[$this->varname] = $left . $data . $right;
//		$this->position += strlen($data);

		return strlen($data);
	}

}