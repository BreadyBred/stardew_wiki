<?php
	include 'templates/header.php';
?>	
	<meta name="robots" content="all">
	<meta name="keywords" content="romain gerard, romain, gerard, iut rouen, rouen, normandie, developpement web, js, html, css, php, mysql, mmi, dut mmi, but mmi, coder, web, portfolio, stardew valley, stardew valley expanded, sve, sv, ferme, guide, wiki" />
	<meta name="description" content="Un guide amateur le plus complet possible concernant les basiques de Stardew Valley et de son mod Stardew Valley Expanded. Venez découvrir mes ajouts et m'en conseiller !">
	<meta property="og:title" content="Stardew Valley Wiki" />
	<meta property="og:description " content="Un guide amateur le plus complet possible concernant les basiques de Stardew Valley et de son mod Stardew Valley Expanded. Venez découvrir mes ajouts et m'en conseiller !">
	<meta property="og:locale" content="fr_FR">
  	<title>Stardew Valley Wiki</title>
</head>
<body>
	<h1 id="accueil">Stardew Valley Wiki</h1>
	<div class="menu">
		<nav id="menunavigation">
				<ul>
					<li><a href="#">Page principale</a></li>
					<li><a href="<?= $baseurl ?>recipes">Recettes de cuisine</a></li>
					<li><a href="<?= $baseurl ?>data">Données</a></li>
					<li><a href="<?= $baseurl ?>data/?player=Grochien">Données de Grochien</a></li>
				</ul>
		</nav>
		<div id="arrow">
			<img src="<?= $baseurl ?>others/styleImgs/arrow.png">
		</div>
	</div>

	<ul class="liste">
	<?php
		for ($i = 1; $i <= $count; $i++){
			$nom = $prefixVillager[$i]['name'];
			echo '
			<a href="'.$baseurl.'others/villageois/?id='.$i.'">
				<ul>
					<li>';
						if (file_exists('others/villageois/img/'.$nom.'.webp'))
							echo '<img src="'.$baseurl.'others/villageois/img/'.$nom.'.webp" alt="'.$nom.'" title="'.$nom.'" id="'.$i.'" width="80" height="80"/>';
						else if (file_exists('others/villageois/img/'.$nom.'.png'))
							echo '<img src="'.$baseurl.'others/villageois/img/'.$nom.'.png" alt="'.$nom.'" title="'.$nom.'" id="'.$i.'" width="80" height="80"/>';
						else if (file_exists('others/villageois/img/'.$nom.'.jpg'))
							echo '<img src="'.$baseurl.'others/villageois/img/'.$nom.'.jpg" alt="'.$nom.'" title="'.$nom.'" id="'.$i.'" width="80" height="80"/>';
						else echo $nom;
			echo '	</li>
					<li>'
						.$nom.
					'</li>
				</ul>
			</a>';
		}
		?>
	</ul>

	<ul class="listeFriendship tableList">
		<ul>
			<table>
				<tbody>
					<tr>
						<th colspan="7">Quick List</th>
					</tr>
					<tr>
						<th>Perso</th>
						<th>Cadeaux</th>
						<th>Perso</th>
						<th>Cadeaux</th>
						<th>Perso</th>
						<th>Cadeaux</th>
					</tr>
	<?php
		$count = count($prefixVillager);
		for ($i = 1; $i <= $count; $i+=3){
			echo '<tr>';
			for ($y = 0; $y < 3; $y++){
				if ($i+$y <= $count){
					if ($i < ($count)) $nom = $prefixVillager[$i+$y]['name'];
					else $nom = $prefixVillager[$i]['name'];
					
					echo '<td><a href="'.$baseurl.'others/villageois/?id='.$i+$y.'">';
					if (file_exists('others/villageois/img/'.$nom.'.webp'))
						echo '<img src="'.$baseurl.'others/villageois/img/'.$nom.'.webp" alt="'.$nom.'" title="'.$nom.'" id="'.$i+$y.'" width="64" height="64"/>';
					else if (file_exists('others/villageois/img/'.$nom.'.png'))
						echo '<img src="'.$baseurl.'others/villageois/img/'.$nom.'.png" alt="'.$nom.'" title="'.$nom.'" id="'.$i+$y.'" width="64" height="64"/>';
					else if (file_exists('others/villageois/img/'.$nom.'.jpg'))
						echo '<img src="'.$baseurl.'others/villageois/img/'.$nom.'.jpg" alt="'.$nom.'" title="'.$nom.'" id="'.$i+$y.'" width="64" height="64"/>';
					else echo $nom;
					echo '</a></td><td>';
					if ($i < ($count)) $gifts = $prefixVillager[$i+$y]['gifts'];
					else $gifts = $prefixVillager[$i]['gifts'];
					
					$countGift = count($gifts) > 4 ? 4 : count($gifts);
					for($x = 0; $x < $countGift; $x++) {
						$gift = $villagerInfo['gifts'][$gifts[$x]];
						if (file_exists('others/gift/'.$gift.'.webp'))
							echo '<img src="'.$baseurl.'others/gift/'.$gift.'.webp" alt="'.$gift.'" title="'.$gift.'" id="'.$gifts[$x].'" width="32" height="32"/>';
						else if (file_exists('others/gift/'.$gift.'.png'))
							echo '<img src="'.$baseurl.'others/gift/'.$gift.'.png" alt="'.$gift.'" title="'.$gift.'" id="'.$gifts[$x].'" width="32" height="32"/>';
						else if (file_exists('others/gift/'.$gift.'.jpg'))
							echo '<img src="'.$baseurl.'others/gift/'.$gift.'.jpg" alt="'.$gift.'" title="'.$gift.'" id="'.$gifts[$x].'" width="32" height="32"/>';
						else echo $gift;
					}
					  echo '</td>';
				}
			}
			echo '</tr>';
		}	
	?>
				</tbody>
			</table>
		</ul>
	</ul>

	<h1 id="todo">To-Do</h1>
	<ul class="listeFriendship tableList">
		<ul>
			<table>
				<tbody>
					<tr>
						<th colspan="3">Perfection</th>
					</tr>
					<tr>
						<th>Libellé</th>
						<th>Pré-requis</th>
						<th>Complétion</th>
					</tr>
	<?php
		$perfection = $villagerInfo['toDoList']['perfection'];
		$count = count($perfection);
		for ($i = 1; $i <= $count; $i++){
			if (!$perfection[$i]['requirement']) $class = "none";
			else $class = "";
			if ($perfection[$i]['progression'] == "Complet") $classProgression = "done";
			else $classProgression = "";
			echo '<tr>
					<td class="'.$classProgression.'">'.$perfection[$i]['libelle'].'</td>
					<td class="'.$classProgression.' '.$class.'">'.$perfection[$i]['requirement'].'</td>
					<td class="'.$classProgression.'">'.$perfection[$i]['progression'].'</td>
				</tr>';
		}
	
		$story = $villagerInfo['toDoList']['story'];
		$count = count($story);
		if ($count>0){
	?>
					<tr>
						<th colspan="3">Histoire</th>
					</tr>
					<tr>
						<th>Libellé</th>
						<th>Pré-requis</th>
						<th>Complétion</th>
					</tr>
		<?php
			for ($i = 1; $i <= $count; $i++){
				if (!$story[$i]['requirement']) $class = "none";
				else $class = "";
				echo '<tr>
						<td>'.$story[$i]['libelle'].'</td>
						<td class="'.$class.'">'.$story[$i]['requirement'].'</td>
						<td>'.$story[$i]['progression'].'</td>
					</tr>';
			}
		}
		?>
				</tbody>
			</table>
		</ul>
	</ul>

	<h1 id="crafts">Crafts</h1>
	<ul class="listeFriendship tableList craft">
		<ul>
			<table>
				<tbody>
					<?php
						$craftRequirement = $villagerInfo['craftRequirement']['craftUnlock'];
						$count = count($craftRequirement);
						if ($count > 0){
							echo "
							<tr>
								<th colspan='1'>Craft Unlocking Prerequisite</th>
							</tr>
							<tr>
								<th>Prérequis</th>
							</tr>";
							for ($i = 0; $i < $count; $i++){
								echo "<tr><td>".$craftRequirement[$i]."</td></tr>";
							}
						}
					?>
				</tbody>
			</table>
		</ul>
	</ul>

	<h1 id="collection">Collection</h1>
	<ul class="listeFriendship tableList">
		<ul>
			<table>
				<tbody>
						<?php
							$fishes = $villagerInfo['collection']['fish'];
							$countFishes = count($fishes);
							if ($countFishes > 0){
								echo "<tr>
										<th colspan='4'>Poissons</th>
									</tr>	
									<tr>
										<th>Poisson</th>
										<th>Endroits</th>
										<th>Saisons</th>
										<th>Temps</th>
									</tr>";
								for ($i = 1; $i <= $countFishes; $i++){
									$name = $fishes[$i]["name"];
									$place = $fishes[$i]["place"];
									$seasons = $fishes[$i]["seasons"];
									$time = $fishes[$i]["time"];
									echo "<tr>";
										echo "<td>";
											if (file_exists('others/collection/'.$name.'.webp'))
											echo '<img src="'.$baseurl.'others/collection/'.$name.'.webp" alt="'.$name.'" title="'.$name.'" width="32" height="32"/>';
											else if (file_exists('others/collection/'.$name.'.png'))
												echo '<img src="'.$baseurl.'others/collenamection/'.$name.'.png" alt="'.$name.'" title="'.$name.'" width="32" height="32"/>';
											else if (file_exists('others/collection/'.$name.'.jpg'))
												echo '<img src="'.$baseurl.'others/collection/'.$name.'.jpg" alt="'.$name.'" title="'.$name.'" width="32" height="32"/>';
											else echo $name;
										echo "</td>";
										echo "<td>";
											for ($y = 0; $y < count($place); $y++)
												echo $place[$y]."<br>";
										echo "</td>";
										echo "<td>";
											for ($y = 0; $y < count($seasons); $y++)
												echo $seasons[$y]."<br>";
										echo "</td>";
										echo "<td>De ".$time[0].":00 à ".$time[1].":00</td>";
									echo "</tr>";
								}
							}

							$expedition = $villagerInfo['collection']['expedition'];
							$countExpedition = count($expedition);
							if ($countExpedition > 0){
								echo "<tr>
									<th colspan='4'>Expéditions</th>
								</tr>
								<tr>
									<th>Objet</th>
									<th>Type d'objet</th>
									<th>Endroits</th>
									<th>Saisons</th>
								</tr>";
								for ($i = 1; $i <= $countExpedition; $i++){
									$name = $expedition[$i]["name"];
									$type = $expedition[$i]["type"];
									$place = $expedition[$i]["place"];
									$seasons = $expedition[$i]["seasons"];
									echo "<tr>";
										echo "<td>";
											if (file_exists('others/collection/'.$name.'.webp'))
											echo '<img src="'.$baseurl.'others/collection/'.$name.'.webp" alt="'.$name.'" title="'.$name.'" width="32" height="32"/>';
											else if (file_exists('others/collection/'.$name.'.png'))
												echo '<img src="'.$baseurl.'others/collenamection/'.$name.'.png" alt="'.$name.'" title="'.$name.'" width="32" height="32"/>';
											else if (file_exists('others/collection/'.$name.'.jpg'))
												echo '<img src="'.$baseurl.'others/collection/'.$name.'.jpg" alt="'.$name.'" title="'.$name.'" width="32" height="32"/>';
											else echo $name;
										echo "</td>";
										echo "<td>".$type."</td>";
										echo "<td>";
											for ($y = 0; $y < count($place); $y++)
												echo $place[$y]."<br>";
										echo "</td>";
										echo "<td>";
											for ($y = 0; $y < count($seasons); $y++)
												echo $seasons[$y]."<br>";
										echo "</td>";
									echo "</tr>";
								}
							}
						?>
				</tbody>
			</table>
		</ul>
	</ul>

</body>
</html>