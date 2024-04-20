<?php
	include '../templates/header.php';
?>
  	<title>Recettes - Stardew Valley Wiki</title>
</head>
<body>
	<h1 id="accueil">Stardew Valley Wiki</h1>
	<div class="menu">
		<nav id="menunavigation">
				<ul>
					<li><a href="<?= $baseurl ?>">Page principale</a></li>
					<li><a href="<?= $baseurl ?>data">Données</a></li>
					<li><a href="<?= $baseurl ?>data/?player=Grochien">Données de Grochien</a></li>
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
						<th colspan="3">Recettes de cuisines</th>
					</tr>
					<tr>
						<th>Nom</th>
						<th>Ingrédients</th>
						<th>Source</th>
					</tr>
					<?php
						for ($i = 1; $i <= $countRecipes; $i++){
							$nom = $recipes[$i]["name"];
							$ingredients = $recipes[$i]["ingredients"];
							$source = $recipes[$i]["unlock"];
							// Img recette
							echo "<tr>
									<td>
										<div>";
										if (file_exists('../others/recipes/'.$nom.'.webp'))
										echo '<img src="'.$baseurl.'others/recipes/'.$nom.'.webp" alt="'.$nom.'" title="'.$nom.'" id="'.$i+$y.'" width="32" height="32"/>';
										else if (file_exists('../others/recipes/'.$nom.'.png'))
											echo '<img src="'.$baseurl.'others/recipes/'.$nom.'.png" alt="'.$nom.'" title="'.$nom.'" id="'.$i+$y.'" width="32" height="32"/>';
										else if (file_exists('../others/recipes/'.$nom.'.jpg'))
											echo '<img src="'.$baseurl.'others/recipes/'.$nom.'.jpg" alt="'.$nom.'" title="'.$nom.'" id="'.$i+$y.'" width="32" height="32"/>';
									echo "</div>
										<div>" . $nom . "</div>
									</td>";

								// Ingrédients imgs & quantités
								$countIngredient = count($ingredients);
								echo "<td>";
								for ($y = 0; $y < $countIngredient; $y++){
									$nomIngredient = $recipes[$i]["ingredients"][$y]["name"];
									$qteIngredient = $recipes[$i]["ingredients"][$y]["quantity"];
									if (file_exists('../others/recipes/'.$nomIngredient.'.webp'))
									echo '<img src="'.$baseurl.'others/recipes/'.$nomIngredient.'.webp" alt="'.$nomIngredient.'" title="'.$nomIngredient.'" id="'.$i+$y.'" width="32" height="32"/>';
									else if (file_exists('../others/recipes/'.$nomIngredient.'.png'))
										echo '<img src="'.$baseurl.'others/recipes/'.$nomIngredient.'.png" alt="'.$nomIngredient.'" title="'.$nomIngredient.'" id="'.$i+$y.'" width="32" height="32"/>';
									else if (file_exists('../others/recipes/'.$nomIngredient.'.jpg'))
										echo '<img src="'.$baseurl.'others/recipes/'.$nomIngredient.'.jpg" alt="'.$nomIngredient.'" title="'.$nomIngredient.'" id="'.$i+$y.'" width="32" height="32"/>';
									echo "x" . $qteIngredient;
								}
								echo "</td>";
								// Source
								echo "<td>" . $source . "</td>";

							echo '</tr>';
						}	
					?>
				</tbody>
			</table>
		</ul>
	</ul>

</body>
</html>