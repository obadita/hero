<?php
use Game\Realms\Forest;
use Game\Utils\Constants;
use Game\Utils\CreatureFactory;

require_once('./vendor/autoload.php');

$hero=CreatureFactory::makeHero(Constants::HERO_DEFAULT_NAME);
$emagia=new Forest(Constants::REALM_DEFAULT_NAME);
$hero->enterForest($emagia);

echo "\n";

echo "\n";



