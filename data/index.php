<?php
	include '../templates/header.php';

	$count = count($prefixVillager);
	$villagersNameArray = array();
	for ($i = 1; $i < $count; $i++){
		$nom = $prefixVillager[$i]['name'];
		array_push($villagersNameArray, $nom);
	}
?>
  	<title><?= $player->name ?> - Stardew Valley Wiki</title>
</head>
<body>
	<h1>Data - Stardew Valley Wiki</h1>	
	<div class="menu">
		<nav id="menunavigation">
				<ul>
					<li><a href="<?= $baseurl ?>">Page principale</a></li>
					<li><a href="<?= $baseurl ?>recipes">Recettes de cuisine</a></li>
					<?php
						if (!empty($_GET["player"])) echo '<li><a href="'.$baseurl.'data">Données</a></li>';
						else echo '<li><a href="'.$baseurl.'data/?player=Grochien">Données de Grochien</a></li>';
					?>
					<li><a href="<?= $baseurl ?>upload">Upload une sauvegarde</a></li>
				</ul>
		</nav>
		<div id="arrow">
			<img src="<?= $baseurl ?>others/styleImgs/arrow.png">
		</div>
	</div>
	<ul class="listeFriendship tableList">
		<ul>
			<table>
				<tbody>
					<tr>
						<th colspan="12">Données</th>
					</tr>
					<tr>
						<td colspan="12"><?= $date ?></th>
					</tr>
					<tr>
						<th colspan="4">Argent</th>
						<th colspan="4">Argent individuel gagné</th>
						<th colspan="4">Argent total de la ferme</th>
					</tr>
					<tr>
						<td colspan="4"><?= number_format((float) $player->money) ?>&nbsppo</td>
						<td colspan="4"><?= number_format((float) $player->stats->individualMoneyEarned) ?>&nbsppo</td>
						<td colspan="4"><?= number_format((float) $player->totalMoneyEarned) ?>&nbsppo</td>
					</tr>
					<tr>
						<th colspan="2">Compétences</th>
						<th colspan="2"><img src="<?= $baseurl ?>others/competences/fishing.png" height="32" width="32" alt="Pêche" title="Pêche" /></th>
						<th colspan="2"><img src="<?= $baseurl ?>others/competences/foraging.png" height="32" width="32" alt="Cueillette" title="Cueillette" /></th>
						<th colspan="2"><img src="<?= $baseurl ?>others/competences/farming.png" height="32" width="32" alt="Agriculture" title="Agriculture" /></th>
						<th colspan="2"><img src="<?= $baseurl ?>others/competences/mining.png" height="32" width="32" alt="Extraction Minière" title="Extraction Minière" /></th>
						<th colspan="2"><img src="<?= $baseurl ?>others/competences/combat.png" height="32" width="32" alt="Combat" title="Combat" /></th>
					</tr>
					<tr>
						<th colspan="2">Niveau</th>
						<?php $maxExpPoints = 15000; ?>
						<td colspan="2"><?= (int) $player->fishingLevel ?> <?php if (((int) $player->experiencePoints->int[0] - $maxExpPoints) < 0) echo " (".$maxExpPoints - (int) $player->experiencePoints->int[0]." pts d'xp)"; ?></td>
						<td colspan="2"><?= (int) $player->foragingLevel ?> <?php if (((int) $player->experiencePoints->int[1] - $maxExpPoints) < 0) echo " (".$maxExpPoints - (int) $player->experiencePoints->int[1]." pts d'xp)"; ?></td>
						<td colspan="2"><?= (int) $player->farmingLevel ?> <?php if (((int) $player->experiencePoints->int[2] - $maxExpPoints) < 0) echo " (".$maxExpPoints - (int) $player->experiencePoints->int[2]." pts d'xp)"; ?></td>
						<td colspan="2"><?= (int) $player->miningLevel ?> <?php if (((int) $player->experiencePoints->int[3] - $maxExpPoints) < 0) echo " (".$maxExpPoints - (int) $player->experiencePoints->int[3]." pts d'xp)"; ?></td>
						<td colspan="2"><?= (int) $player->combatLevel ?><?php if (((int) $player->experiencePoints->int[4] - $maxExpPoints) < 0) echo " (".$maxExpPoints - (int) $player->experiencePoints->int[4].") pts d'xp"; ?></td>
					</tr>
					<tr>
						<th colspan="12">Friendship</th>
					</tr>
					<tr>
						<th>Perso</th>
						<th>Amitié</th>
						<th>Perso</th>
						<th>Amitié</th>
						<th>Perso</th>
						<th>Amitié</th>
						<th>Perso</th>
						<th>Amitié</th>
						<th>Perso</th>
						<th>Amitié</th>
						<th>Perso</th>
						<th>Amitié</th>
					</tr>
					<?php
						if ($fileExist){
							$prefixVillager = $villagerInfo['villagers'];
							$count = count($prefixVillager);
							$exceptions = ["Zacarienne", "Vladimir", "Josée", "Adolf", "Henchman"];
							$jsonArray = array();
							for ($i = 0; $i < $player->friendshipData->item->count(); $i++){
								$villagerName = (string) $player->friendshipData->item[$i]->key->string;
								$villagerFriendship = (int) $player->friendshipData->item[$i]->value->Friendship->Points;
								$villagerStatus = $player->friendshipData->item[$i]->value->Friendship->Status;
								// Retire les personnages qui n'ont pas d'impact sur la progression du jeu
								// A mettre en array pitié
								if ($villagerName == "Zacarienne" || $villagerName == "Vladimir" || $villagerName == "Henchman" || $villagerName == "Adolf" || $villagerName == "Josée"){
									unset($player->friendshipData->item[$i]);
									$i--;
								}
								else{
									$isDatable = false;
									$isDating = false;
									$isMarried = false;
									// Exceptions des noms spécifiques / en anglais des personnages
									switch ($villagerName){
										case "GuntherSilvian":
											$villagerName = "Gunther";
											break;
										case "MarlonFay":
											$villagerName = "Marlon";
											break;
										case "Wizard":
											$villagerName = "Sorcier";
											break;
										case "Dwarf":
											$villagerName = "Nain";
											break;
										case "Robin":
											$villagerName = "Robine";
											break;
									}
									$hearts = floor($villagerFriendship/250);
									$rest =  250 - ($villagerFriendship - ($hearts * 250));
									for ($w = 0; $w <= $count; $w++){
										if ($prefixVillager[$w]["name"] == $villagerName){
											unset($villagersNameArray[$w-1]);
											if ($prefixVillager[$w]["isDatable"]){
												$max = 8;
												$isDatable = true;
											}
											else $max = 10;
										}
									}
									if ($hearts > 10) $hearts = 10;
									if ($villagerStatus == "Dating") {
										$max = 10;
										$isDating = true;
									}
									if ($villagerStatus == "Married") {
										$max = 10;
										$isMarried = true;
									}
									$jsonArray += array("$i" => array(
										"name" => $villagerName,
										"friendPoints" => $villagerFriendship,
										"hearts" => $hearts,
										"rest" => $rest,
										"max" => $max,
										"isDatable" => $isDatable,
										"isDating" => $isDating,
										"isMarried" => $isMarried,
									));
								}
							}
							sort($jsonArray);
							$countArray = count($jsonArray);
							for ($i = 0;$i < $countArray;$i+=6){
								echo "<tr>";
								for ($y = 0; $y < 6; $y++){
									$class = "";
									$villagerName = $jsonArray[$i+$y]["name"];
									$hearts = $jsonArray[$i+$y]["hearts"];
									$rest = $jsonArray[$i+$y]["rest"];
									$max = $jsonArray[$i+$y]["max"];
									$isDatable = $jsonArray[$i+$y]["isDatable"];
									$isDating = $jsonArray[$i+$y]["isDating"];
									$isMarried = $jsonArray[$i+$y]["isMarried"];

									if ($hearts >= 10 && !$isDatable) $class = "done";
									if ($hearts >= 8 && $isDatable) $class = "done";

									if ($class == "done" || $class == "none") $rest = null;

									echo "<td class='".$class."'>";
									if (file_exists('../others/villageois/img/'.$villagerName.'.webp'))
										echo '<img src="'.$baseurl.'others/villageois/img/'.$villagerName.'.webp" alt="'.$villagerName.'" title="'.$villagerName.'" width="64" height="64"/>';
									else if (file_exists('../others/villageois/img/'.$villagerName.'.png'))
										echo '<img src="'.$baseurl.'others/villageois/img/'.$villagerName.'.png" alt="'.$villagerName.'" title="'.$villagerName.'" width="64" height="64"/>';
									else if (file_exists('../others/villageois/img/'.$villagerName.'.jpg'))
										echo '<img src="'.$baseurl.'others/villageois/img/'.$villagerName.'.jpg" alt="'.$villagerName.'" title="'.$villagerName.'" width="64" height="64"/>';
									else echo $villagerName;
									echo "</td>
											<td class='".$class."'><div>";
									for ($x = 0; $x < $hearts; $x++){
										echo '<img src="'.$baseurl.'others/villageois/img/Heart.png" alt="" width="16" height="16"/>';
									}
									if ($class != "none"){
										for ($z = 0; $z < $max-$hearts; $z++){
											echo '<img src="'.$baseurl.'others/villageois/img/Empty_Heart.png" alt="" width="16" height="16"/>';
										}
										if ($isDatable && !$isMarried && !$isDating){
											for ($z = 0; $z < 2; $z++){
												echo '<img src="'.$baseurl.'others/villageois/img/Locked_Heart.png" alt="" width="16" height="16"/>';
											}
										}
									}
									echo "</div><div>".$rest."</div></td>";
								}
								echo "</tr>";
							}
						
							$villagersNameArray = array_values($villagersNameArray);
							$countNotMet = count($villagersNameArray);
							if ($countNotMet > 0){
								echo "
								<tr>
									<th colspan='12'>Personnages non rencontrés</th>
								</tr>
								<tr>
									<th>Perso</th>
									<th>Amitié</th>
									<th>Perso</th>
									<th>Amitié</th>
									<th>Perso</th>
									<th>Amitié</th>
									<th>Perso</th>
									<th>Amitié</th>
									<th>Perso</th>
									<th>Amitié</th>
									<th>Perso</th>
									<th>Amitié</th>
								</tr>";
								// Pas rencontrés
								for ($u = 0;$u < $countNotMet;$u+=6){
									echo "<tr>";
									for ($v = 0; $v < 6; $v++){
										$class = "none";
										$villagerName = $villagersNameArray[$u+$v];
										if ($villagerName) $max = 10;
										else $max = 0;

										echo "<td class='".$class."'>";
										if (file_exists('../others/villageois/img/'.$villagerName.'.webp'))
											echo '<img src="'.$baseurl.'others/villageois/img/'.$villagerName.'.webp" alt="'.$villagerName.'" title="'.$villagerName.'" width="64" height="64"/>';
										else if (file_exists('../others/villageois/img/'.$villagerName.'.png'))
											echo '<img src="'.$baseurl.'others/villageois/img/'.$villagerName.'.png" alt="'.$villagerName.'" title="'.$villagerName.'" width="64" height="64"/>';
										else if (file_exists('../others/villageois/img/'.$villagerName.'.jpg'))
											echo '<img src="'.$baseurl.'others/villageois/img/'.$villagerName.'.jpg" alt="'.$villagerName.'" title="'.$villagerName.'" width="64" height="64"/>';
										else echo $villagerName;
										echo "</td>
												<td class='".$class."'><div>";
										for ($x = 0; $x < $max; $x++){
											echo '<img src="'.$baseurl.'others/villageois/img/Locked_Heart.png" alt="" width="16" height="16"/>';
										}
									}
									echo "</tr>";
								}
							}
						}
							
					?>
				</tbody>
			</table>
		</ul>
	</ul>
</body>
</html>