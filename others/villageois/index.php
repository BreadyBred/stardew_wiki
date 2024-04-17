<?php

	include '../../templates/header.php';

	$nom = $prefixVillager[$_GET['id']]['name'];
	$bday = $prefixVillager[$_GET['id']]['birthday'];
	$gifts = $prefixVillager[$_GET['id']]['gifts'];
?>
  <title><?= $nom ?> - Stardew Valley Expanded Wiki</title>
</head>
<body>


	<h1>Stardew Valley Wiki</h1>
	<?php 
		if (file_exists('img/'.$nom.'.webp')){
			echo '<img class="center" src="'.$baseurl.'others/villageois/img/'.$nom.'.webp" alt="" id="'.$_GET['id'].'" width="80" height="80"/>';
		}
		else if (file_exists('img/'.$nom.'.png')){
			echo '<img class="center" src="'.$baseurl.'others/villageois/img/'.$nom.'.png" alt="" id="'.$_GET['id'].'" width="80" height="80"/>';
		}
		else if (file_exists('img/'.$nom.'.jpg')){
			echo '<img class="center" src="'.$baseurl.'others/villageois/img/'.$nom.'.jpg" alt="" id="'.$_GET['id'].'" width="80" height="80"/>';
		}
	?>
	<h2 class="pres"><?= $nom ?></h2>
	
	<div>
		<h3>Meilleurs cadeaux :</h3>
		<ul class="listegifts">
			<?php 
				$count = count($gifts);
				for($i = 0; $i < $count; $i++) {
					$gift = $villagerInfo['gifts'][$gifts[$i]];
					echo '<ul>
							<li>';
							if (file_exists('../gift/'.$gift.'.webp')){
								echo '<img src="'.$baseurl.'others/gift/'.$gift.'.webp" alt="" id="'.$gifts[$i].'" width="48" height="48"/>';
							}
							if (file_exists('../gift/'.$gift.'.png')){
								echo '<img src="'.$baseurl.'others/gift/'.$gift.'.png" alt="" id="'.$gifts[$i].'" width="48" height="48"/>';
							}
							if (file_exists('../gift/'.$gift.'.jpg')){
								echo '<img src="'.$baseurl.'others/gift/'.$gift.'.jpg" alt="" id="'.$gifts[$i].'" width="48" height="48"/>';
							}
					echo '	</li>
						<li>'.$gift.'</li>
					</ul>';
				}

				$lovedGifts = $villagerInfo['lovedGifts'];
				$count = count($lovedGifts);
				$isLoved = true;
				for ($i = 1; $i <= $count; $i++){
					$countExc = count($lovedGifts[$i]['exception']);
					for ($y = 0; $y < $countExc; $y++){
						if ($lovedGifts[$i]['exception'][$y] == $nom){
							$isLoved = false;
						}
					
					}
					if ($isLoved){
						$univGift = $villagerInfo['gifts'][$lovedGifts[$i]['gift']];
						echo '<ul>
								<li>';
								if (file_exists('../gift/'.$univGift.'.webp')){
									echo '<img src="'.$baseurl.'others/gift/'.$univGift.'.webp" alt="" id="'.$lovedGifts[$i]['gift'].'" width="48" height="48"/>';
								}
								if (file_exists('../gift/'.$univGift.'.png')){
									echo '<img src="'.$baseurl.'others/gift/'.$univGift.'.png" alt="" id="'.$lovedGifts[$i]['gift'].'" width="48" height="48"/>';
								}
								if (file_exists('../gift/'.$univGift.'.jpg')){
									echo '<img src="'.$baseurl.'others/gift/'.$univGift.'.jpg" alt="" id="'.$lovedGifts[$i]['gift'].'" width="48" height="48"/>';
								}
					echo '
								</li>
							<li>'.$univGift.'</li>
						</ul>';
					}
					$isLoved = true;
				}
			?>
		</ul>
		<h3>Anniversaire :</h3>
		<ul class="listegifts">
			<li><p><?= $bday ?><br/>(Date : <?= $dateNoYear ?>)</p></li>
		</ul>
	</div>

	<footer>
		<a class="back" href="<?= $baseurl ?>">Retour à l'index</a>
	</footer>

</body>
</html>