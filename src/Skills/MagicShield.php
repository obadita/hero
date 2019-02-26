<?php


namespace Game\Skills;

use Game\Utils\Constants;
use Game\Utils\Random;

class MagicShield extends Skill{

	public $name=Constants::MAGIC_SHIELD_NAME ;

	/**
	 * @return defense modifier as in 50 for 50%
	 */
	public function defense()
	{
		if(Random::getChance(Constants::MAGIC_SHIELD_CHANCE)){
			return Constants::MAGIC_SHIELD_MOD;
		}
		return 0;
	}

}