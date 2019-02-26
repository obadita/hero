<?php


namespace Game\Skills;


use Game\Utils\Constants;
use Game\Utils\Random;

class RapidStrike extends Skill {

	public $name="Rapid Strike" ;

	/**
	 * @return returns the number of extra hits
	 */
	public function multipleHits()
	{
		if(Random::getChance(Constants::RAPID_STRIKE_CHANCE)){
			return Constants::RAPID_STRIKE_MOD;
		}
		return 0;
	}

}