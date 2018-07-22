<?php

/**
 * @param string $class
 * @return void
 */
function iceteaInternalClassAutoloader($class)
{
	$class = str_replace("\\", "/", $class);
	require ICETEA_SOURCE_PATH."/classes/".$class.".php";
}

spl_autoload_register("iceteaInternalClassAutoloader");

require ICETEA_SOURCE_PATH."/helpers.php";
