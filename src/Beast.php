<?php


namespace Game;

use Game\Utils\Constants;

class Beast extends Creature
{

	public  function initStats()
	{
		$this->health=round(rand(Constants::BEAST_MINIMUM_HEALTH,Constants::BEAST_MAXIMUM_HEALTH));
		$this->strength=round(rand(Constants::BEAST_MINIMUM_STRENGTH,Constants::BEAST_MAXIMUM_STRENGTH));
		$this->defence=round(rand(Constants::BEAST_MINIMUM_DEFENCE,Constants::BEAST_MAXIMUM_DEFENCE));
		$this->speed=round(rand(Constants::BEAST_MINIMUM_SPEED,Constants::BEAST_MAXIMUM_SPEED));
		$this->luck=round(rand(Constants::BEAST_MINIMUM_LUCK,Constants::BEAST_MAXIMUM_LUCK));
	}

}