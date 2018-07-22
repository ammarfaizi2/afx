<?php

/**
 * @param string $class
 * @return void
 */
function iceteaInternalClassAutoloader($class)
{
	$class = str_replace("\\", "/", $class);
	if (file_exists($file = ICETEA_SOURCE_PATH."/classes/".$class.".php")) {
		require $file;
	} elseif (file_exists($file = ICETEA_SOURCE_PATH."/phx/".$class.".phx")) {
		require $file;
	}
}

spl_autoload_register("iceteaInternalClassAutoloader");

require ICETEA_SOURCE_PATH."/helpers.php";
