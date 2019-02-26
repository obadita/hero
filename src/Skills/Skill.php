<?php
namespace Game\Skills;

abstract class Skill implements SkillInterface {

	/**
	 * @return int
	 * returns the number of extra hits/attack
	 */
	public function multipleHits()
	{
		return 0;
	}

	/**
	 * @return returns the percent modifier. If 0, there is no effect
	 */
	public function attack()
	{
		return 0;
	}

	/**
	 * @return returns the percent modifier. If 0, there is no effect
	 */
	public function defense()
	{
		return 0;
	}
}