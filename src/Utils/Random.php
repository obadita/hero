<?php


namespace Game\Utils;


class Random {

	public static function getChance($chance){
		return round(rand(0,100))<$chance?1:0;
	}
//	public static function getChance($chance){
//		$event=[];
//		for($i=0;$i<100;$i++)
//		{
//			if($i<round($chance))
//			{
//				$event[$i]=1;
//			}
//			else
//			{
//				$event[$i]=0;
//			}
//		}
//		$index=round(rand(0,99));
//		return $event[$index];
//	}

}