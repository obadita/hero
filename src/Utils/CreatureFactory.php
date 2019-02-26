<?php


namespace Game\Utils;
use Game\Beast;
use Game\Hero;
use Game\Skills\RapidStrike;
use Game\Skills\MagicShield;

class CreatureFactory {

	public static function makeBeast($name=Constants::DEFAULT_BEAST_NAME){
		return new Beast($name);
	}

	/**
	 * Make a hero with all skills
	 */
	public static function makeHero($name){
		$hero= new Hero($name);
		$hero->addSkill(new RapidStrike());
		$hero->addSkill(new MagicShield());
		return $hero;
	}
}