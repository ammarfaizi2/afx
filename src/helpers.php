<?php


if (! function_exists("sh")) {
	/**
	 * @param string $cmd
	 * @return string
	 */
	function shf($cmd)
	{
		$cmd = shell_exec($cmd);
		return trim(is_string($cmd) ? $cmd : "");
	}
}

if (! function_exists("mxit")) {
	/**
	 * @param string $msg
	 * @param int    $code
	 * @return void
	 */
	function mxit($msg, $code = 0)
	{
		echo $msg."\n";
		exit($code);
	}
}