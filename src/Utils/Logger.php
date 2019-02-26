<?php


namespace Game\Utils;


use Game\Utils\Logger\LogStrategy;

class Logger {

	public static function log($message)
	{
		$logger=LogStrategy::getLog();
		$logger->log($message);
	}

}