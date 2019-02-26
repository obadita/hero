<?php


namespace Game\Utils\Logger;

class LogStrategy {

	public static function getLog()
	{
		return  php_sapi_name() == "cli" ? new ConsoleLogger() : new WebLogger();
	}

}