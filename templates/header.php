<?php

	error_reporting(E_ERROR | E_PARSE);
	session_start();

	if ($_SERVER['HTTP_HOST'] == "localhost"){
		if ($_SERVER["PHP_SELF"] == "/Projet/portfolio/projets/sve/others/villageois/index.php") $filename_better = '../../files/gameInfos_better.xml';
		else $filename_better = '../files/gameInfos_better.xml';
		$baseurl = 'http://localhost/Projet/portfolio/projets/sve/';
	}
	else {
		if ($_SERVER["PHP_SELF"] == "/projets/sve/others/villageois/index.php") $filename_better = '../../files/gameInfos_better.xml';
		else $filename_better = '../files/gameInfos_better.xml';
		$baseurl = 'https://romain-gerard.com/projets/sve/';
	}
	$json = file_get_contents($baseurl."files/villager.json");
	$villagerInfo = json_decode($json, true);

	$fileExist = false;
	if (file_exists($filename_better)){
		$xml=simplexml_load_file($filename_better) or die("Error: Cannot create object - Most likely more than 1 <?xml element.");
		$indoors = $xml->locations->GameLocation->buildings->Building->indoors;
		if ($_GET["player"] == $xml->player->name) $player = $xml->player;
		else $player = $indoors->farmhand;
		$fileExist = true;
	}
	
	$prefixVillager = $villagerInfo['villagers'];
	$recipes = $villagerInfo["recipeCrafts"];

	$count = count($prefixVillager);
	$countRecipes = count($recipes);

	include 'dateGetter.php';
	
?>
<!doctype html>
<html lang="fr">
<head>
  	<meta charset="utf-8">
  	<link rel="icon" href="<?= $baseurl ?>others/styleImgs/Icon.ico" />
  	<meta name="viewport" content="width=device-width, initial-scale=1" />
  	<link rel="stylesheet" href="<?= $baseurl ?>style.css">
	<script type="text/javascript" src="<?= $baseurl ?>script/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="<?= $baseurl ?>script/menu.js"></script>