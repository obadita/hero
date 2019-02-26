<?php


namespace Game\Realms;


use Game\Hero;
use Game\Creature;
use Game\Combat;
use Game\Utils\Constants;
use Game\Utils\CreatureFactory;
use Game\Utils\Logger;

class Forest {

	protected $beasts=[];
	protected $hero;
	protected $name;
	protected $numberOfBeasts;

	public function __construct($name='Emagia',$numberOfBeasts=Constants::NUMBER_OF_BEASTS_IN_FOREST)
	{
		$this->numberOfBeasts=$numberOfBeasts;
		$this->populateForest();
		$this->name = $name;
	}

	/**
	 * @return string
	 * Returns the name of the Forest
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Fills the forest with creatures
	 */
	private function populateForest()
	{
		for($i=0;$i<$this->numberOfBeasts;$i++)
		{
			$this->beasts[]=CreatureFactory::makeBeast();
		}
	}

	/**
	 * @param Hero $hero
	 * Hero is added in Forest and game starts
	 */
	public function take(Hero $hero)
	{
		Logger::log("$hero->name enters forest $this->name");
		$this->hero=$hero;
		Logger::log("Our hero looks like this: {$hero->stats()}");

		$this->startMagic();
	}

	/**
	 * Starts the combat with the fastest luckiest beast in the forest
	 */
	private function startMagic()
	{
		Logger::log("Magic is about to happen");

		Logger::log("In forest $this->name are $this->numberOfBeasts beasts");

		$fastestBeast=$this->findFirstStriker();

		Logger::log("{$this->hero->name} is attacked by $fastestBeast->name");

		Logger::log("The monster looks like this: {$fastestBeast->stats()}");


		Combat::startFight($this->hero, $fastestBeast);
	}

	/**
	 * @return Creature
	 * Finds the fastest and luckiest beast in forest
	 */
	private function findFirstStriker()
	{
		$fastestBeast=$this->getFastestBeast();
		return $this->getLuckiestFastestBeast($fastestBeast);

	}

	/**
	 * @return Beast
	 * Finds the fastest beast
	 */
	private function getFastestBeast()
	{
		$fastestBeast=$this->beasts[0];
		for($i=1;$i<count($this->beasts); $i++)
		{
			if($fastestBeast->getSpeed()<$this->beasts[$i]->getSpeed())
			{
				$fastestBeast=$this->beasts[$i];
			}
		}

		return $fastestBeast;
	}

	/**
	 * @param Creature $fastestBeast
	 * @return Creature
	 * Finds the luckiest beast from the fastest ones
	 */
	private function getLuckiestFastestBeast(Creature $fastestBeast)
	{
		$luckiestBeast=$fastestBeast;
		for($i=1;$i<count($this->beasts); $i++)
		{
			if($fastestBeast->getSpeed() === $this->beasts[$i]->getSpeed() && !$this->isLuckier($fastestBeast, $this->beasts[$i]))
			{
				$luckiestBeast=$this->beasts[$i];
			}
		}

		return $luckiestBeast;
	}

	/**
	 * @param Creature $fastestBeast
	 * @param Creature $currentBeast
	 * @return bool
	 */
	private function isLuckier(Creature $fastestBeast, Creature $currentBeast)
	{
		return $fastestBeast->getLuck() > $currentBeast->getLuck();
	}


}