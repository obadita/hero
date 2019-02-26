<?php


namespace Game;

use Game\Realms\Forest;
use Game\Utils\Constants;

class Hero extends Creature
{


	public function initStats()
	{
		$this->health=round(rand(Constants::HERO_MINIMUM_HEALTH,Constants::HERO_MAXIMUM_HEALTH));
		$this->strength=round(rand(Constants::HERO_MINIMUM_STRENGTH,Constants::HERO_MAXIMUM_STRENGTH));
		$this->defence=round(rand(Constants::HERO_MINIMUM_DEFENCE,Constants::HERO_MAXIMUM_DEFENCE));
		$this->speed=round(rand(Constants::HERO_MINIMUM_SPEED,Constants::HERO_MAXIMUM_SPEED));
		$this->luck=round(rand(Constants::HERO_MINIMUM_LUCK,Constants::HERO_MAXIMUM_LUCK));
	}

	public function enterForest(Forest $forest)
	{
		$forest->take($this);
	}

}