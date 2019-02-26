<?php

namespace Game;
use Game\Skills\Skill;
use Game\Utils\Random;
Abstract class Creature
{

	protected $health;
	protected $strength;
	protected $defence;
	protected $speed;
	protected $luck;

	protected $skills=[];

	public $name;

	public function __construct($name)
	{
		$this->initStats();
		$this->name=$name;
	}

	abstract function initStats();


	public function takeDamage($damage)
	{
		if($damage>$this->health){
			$damage=$this->health;
			$this->health=0;
			return $damage;
		}

		$this->health-=$damage;
		return $damage;
	}

	public function isLucky()
	{
		return Random::getChance($this->luck);
	}

	public function isDead()
	{
		return $this->health==0;
	}
	/**
	 * @return mixed
	 */
	public function getHealth()
	{
		return $this->health;
	}

	public function addSkill(Skill $skill)
	{
		$this->skills[]=$skill;
	}
	/**
	 * @return mixed
	 */
	public function getStrength()
	{
		return $this->strength;
	}

	/**
	 * @return mixed
	 */
	public function getDefence()
	{
		return $this->defence;
	}

	/**
	 * @return mixed
	 */
	public function getSpeed()
	{
		return $this->speed;
	}

	/**
	 * @return mixed
	 */
	public function getLuck()
	{
		return $this->luck;
	}

	/**
	 * @return array
	 */
	public function getSkills()
	{
		return $this->skills;
	}

	public function stats()
	{
		$stats= <<<TXT
\n
		Name: {$this->name} \n
		Health: {$this->health} \n
		Strength: {$this->strength} \n
		Defence: {$this->defence} \n
		Speed: {$this->speed} \n
		Luck: {$this->luck} \n

TXT;
		return $stats;
	}



}