<?php

namespace Installer\Linux;

use Installer\Linux\LinuxInstaller;

static $i = 0;

/**
 * @author Amamr Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 * @since 0.0.1
 */
class LinuxInstaller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * @return bool
	 */
	public function isInstalled()
	{
		return file_exists("/etc/icetea") && file_exists("/etc/icetea/bin/icetea");
	}

	/**
	 * @param string $dir
	 */
	private function mkdir($dir)
	{	
		global $i;

		$i++;
		echo "\t{$i}. Creating directory {$dir} ";
		if (file_exists($dir)) {
			if (is_dir($dir)) {
				echo "Directory exists, Skipping, OK\n";
			} else {
				unlink($dir);
				if (mkdir($dir)) {
					echo "OK\n";
					return true;
				} else {
					echo "Cannot create directory\n";
					exit(1);
				}
			}

			return true;
		}

		if (mkdir($dir)) {
			echo "OK\n";
			return true;
		} else {
			echo "Cannot create directory\n";
			exit(1);
		}
	}

	/**
	 * @param string $from
	 * @param string $to
	 * @param string $ff
	 */
	private function forceCopy($from, $to, $fff)
	{
		global $i;

		$i++;
		do {
			$fff = str_replace("//", "/", $fff, $n);
		} while ($n);

		$ff = explode("/", $fff);
		$c = count($ff) - 1;

		foreach ($ff as $k => $v) {
			$to .= "/".$v;
			if ($k == $c)
				break;
			is_dir($to) or $this->mkdir($to);
		}
		echo "\t{$i}. Copying {$fff} ";
		if (copy($from, $to)) {
			echo "OK\n";
		} else {
			echo "Cannot copy {$fff}\n";
			exit(1);
		}
	}

	/**
	 * @return void
	 */
	public function install()
	{
		global $i;

		$i++;
		$this->mkdir("/etc/icetea");

		rfilescanner_callback(ICETEA_BASEPATH, function ($file) {
			$ff = explode(realpath(ICETEA_BASEPATH)."/", $file, 2);
			if (isset($ff[1])) {
				$this->forceCopy($file, "/etc/icetea", $ff[1]);
			}
		});

		echo "\t{$i}. Linking icetea binary to /usr/bin/icetea ";
		$i++;
		if (link("/etc/icetea/linker/icetea", "/usr/bin/icetea")) {
			echo "OK. Linked\n";
			shell_exec("chmod 755 /usr/bin/icetea");
		} else {
			echo "Cannot create symbolic link to /usr/bin/icetea\n";
		}
		echo "\t{$i}. Linking icetea binary to /usr/bin/icetea ";
		$i++;
		if (link("/etc/icetea/linker/obftea", "/usr/bin/obftea")) {
			echo "OK. Linked\n";
			shell_exec("chmod 755 /usr/bin/obftea");
		} else {
			echo "Cannot create symbolic link to /usr/bin/obftea\n";
		}
	}
}
