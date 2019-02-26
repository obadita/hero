<?php


namespace Game\Utils\Logger;


class ConsoleLogger implements LoggerInterface{

	public function log($message){

		echo "\n";
		echo $message;
		echo "\n";
	}

}