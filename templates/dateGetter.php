<?php

	// Prise de la date inGame
	if ((int) $player->dayOfMonthForSaveGame == 29) {
		$seasonGame = (int) $player->seasonForSaveGame + 1;
		$dayGame = 1;
		if ($seasonGame == 4) $yearGame = (int) $player->yearForSaveGame++;
		else $yearGame = (int) $player->yearForSaveGame;
	}
	else{
		$seasonGame = (int) $player->seasonForSaveGame;
		$yearGame = (int) $player->yearForSaveGame;
		$dayGame = (int) $player->dayOfMonthForSaveGame;
	}
	switch ($seasonGame){
		case 0:
			$seasonGame = "Printemps";
			break;
		case 1:
			$seasonGame = "Été";
			break;
		case 2:
			$seasonGame = "Automne";
			break;
		case 3:
			$seasonGame = "Hiver";
			break;
	}

	$date = $dayGame . " " .  $seasonGame . " année " . $yearGame;
	$dateNoYear = $dayGame . " " .  $seasonGame;

?>