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

if (! function_exists("rfilescanner")) {
	/**
	 * @param string $dir
	 * @param string $match
	 * @return array
	 */
	function rfilescanner($dir, $match = null)
	{
		$result = [];
		$scan = scandir($dir);
		unset($scan[0], $scan[1]);
		if (is_string($match)) {
			foreach ($scan as $file) {
				if (is_dir($dir."/".$file)) {
					$result = array_merge($result, rfilescanner($dir."/".$file, $match));
				} else {
					if (preg_match($match, $dir."/".$file)) {
						$result[] = realpath($dir."/".$file);	
					}
				}
			}
		} else {
			foreach ($scan as $file) {
				if (is_dir($dir."/".$file)) {
					$result = array_merge($result, rfilescanner($dir."/".$file));
				} else {
					$result[] = realpath($dir."/".$file);
				}
			}
		}
		return $result;
	}
}

if (! function_exists("rfilescanner_callback")) {
	/**
	 * @param string   $dir
	 * @param callable $callback
	 * @param string   $match
	 * @return void
	 */
	function rfilescanner_callback($dir, $callback, $match = null)
	{
		$result = [];
		$scan = scandir($dir);
		unset($scan[0], $scan[1]);
		if (is_string($match)) {
			foreach ($scan as $file) {
				if (is_dir($dir."/".$file)) {
					rfilescanner_callback($dir."/".$file, $callback, $match);
				} else {
					if (preg_match($match, $dir."/".$file)) {
						$callback(($dir."/".$file));
					}
				}
			}
		} else {
			foreach ($scan as $file) {
				if (is_dir($dir."/".$file)) {
					rfilescanner_callback($dir."/".$file, $callback, $match);
				} else {
					$callback(($dir."/".$file));
				}
			}
		}
	}
}
