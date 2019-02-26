<?php


namespace Game\Utils\Logger;


class WebLogger implements LoggerInterface {

	public function log($message){

		echo "<pre>";
		echo $message;
		echo "</pre>";
	}

}