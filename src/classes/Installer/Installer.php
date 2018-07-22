<?php

namespace Installer;

use Installer\Linux\LinuxInstaller;

/**
 * @author Amamr Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 * @since 0.0.1
 */
class Installer
{
	/**
	 * @var \Installer\Linux\LinuxInstaller
	 */
	private $installer;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		if (PHP_OS === "Linux") {
			$this->installer = new LinuxInstaller;
		}
	}

	/**
	 * @param string $method
	 * @param array  $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		return call_user_func_array([$this->installer, $method], $parameters);
	}
}
