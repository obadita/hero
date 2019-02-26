<?php


namespace Game;
use Game\Creature;
use Game\Skills\EmptySkill;
use Game\Utils\Constants;
use Game\Utils\Logger;

class Combat {

	/**
	 * @param Creature $hero
	 * @param Creature $beast
	 * Starts the fight by deciding who hits first
	 */
	public static function startFight(Creature $hero, Creature $beast)
	{
		if(static::isHeroFaster($hero, $beast))
		{
			static::fight($hero,$beast);
		}
		static::fight($beast,$hero);
	}

	/**
	 * @param Creature $hero
	 * @param Creature $beast
	 * @return bool
	 */
	private static function isHeroFaster(Creature $hero, Creature $beast)
	{
		return $hero->getSpeed()>$beast->getSpeed()
		|| ($hero->getSpeed()==$beast->getSpeed() && $hero->getLuck()>$beast->getLuck());
	}

	/**
	 * @param Creature $hero
	 * @param Creature $beast
	 * Fighting algorithm implemenetion
	 */
	private static function fight(Creature $hero, Creature $beast)
	{
		$rounds=0;
		while($rounds<Constants::COMBAT_MAXIMUM_ROUNDS)
		{
			$rounds++;
			Logger::log("\nRound $rounds begins");
			Logger::log("$hero->name attacks");
			$winner = static::attack($hero, $beast);
			if($winner)
			{
				Logger::log("{$winner->name} is the winner" );
				return;
			}
			Logger::log("$beast->name attacks");
			$winner = static::attack($beast, $hero);
			if($winner)
			{
				Logger::log("{$winner->name} is the winner" );
				return;
			}
		}
		Logger::log("It was a long fight. No one wins today! \n");
	}

	/**
	 * @param Creature $hero
	 * @param Creature $beast
	 * @return Creature || null
	 * returns the winner of the attack, if any
	 */
	private static function attack(Creature $hero, Creature $beast)
	{
		$multipleHits = static::multipleHits($hero);
		static::manageMultipleHits($hero, $beast, $multipleHits);
		if ($beast->isDead())
		{
			return $hero;
		}
		static::doOneAttack($hero, $beast);
		if ($beast->isDead())
		{
			return $hero;
		}
	}


	/**
	 * @param Creature $creature
	 * @return int
	 * Decides if there are any skills that have multiple hits and returns the maximum effect
	 */
	private static function multipleHits(Creature $creature)
	{
		$max=0;
		foreach($creature->getSkills() as $skill)
		{
			if($max<$skill->multipleHits())
			{
				$max=$skill->multipleHits();
				Logger::log("{$skill->name} was activated and {$creature->name} will hit $max more times");
			}
		}
		return $max;
	}

	/**
	 * @param Creature $creature
	 * @param $damage
	 * @return Damage after defense skills is applied using the skill with maximum effect
	 */
	private static function applyDefenseSkills(Creature $creature, $damage)
	{
		$skill = self::chooseMaximumReduction($creature);
		$defense = $skill->defense();
		if($defense >0)
		{
			$reduction = $defense/ 100;
			$realDamage = $damage * $reduction;
			Logger::	log("{$creature->name} activated the skill $skill->name and reduced the damege $damage by $defense%.  Final damage is: $realDamage");
			return $realDamage;
		}
		return $damage;
	}

	/**
	 * @param Creature $hero
	 * @param Creature $beast
	 * @param $multipleHits
	 * Perform the extra hits based on the strongest skill
	 */
	private static function manageMultipleHits(Creature $hero, Creature $beast, $multipleHits)
	{
		while ($multipleHits > 0)
		{
			$multipleHits--;
			static::doOneAttack($hero, $beast);
			if ($beast->isDead())
			{
				Logger::log("{$beast->name} is dead");
				break;
			}
		}
	}

	/**
	 * @param Creature $hero
	 * @param Creature $beast
	 */
	private static function doOneAttack(Creature $hero, Creature $beast)
	{
		if ($beast->isLucky())
		{
			Logger::log("{$beast->name} is lucky and takes 0 damage");
			return;
		}

		$damage = $hero->getStrength() - $beast->getDefence();
		$realDamage = static::applyDefenseSkills($beast, $damage);
		$ingestedDamage = $beast->takeDamage($realDamage);
		Logger::log("{$hero->name} hits with $realDamage. {$beast->name} takes $ingestedDamage damage and now has {$beast->getHealth()} health left");
	}

	/**
	 * @param Creature $creature
	 * @return Skill
	 * Identifies the skill with maximum effect and returns its name and value
	 */
	private static function chooseMaximumReduction(Creature $creature)
	{
		$max = 0;
		$bestSkill=new EmptySkill();
		$skills = $creature->getSkills();
		foreach ($skills as $skill)
		{
			if ($max < $skill->defense())
			{
				$max = $skill->defense();
				$bestSkill = $skill;
			}
		}

		return $bestSkill;
	}


}