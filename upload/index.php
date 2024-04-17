<?php
	include '../templates/header.php';

	if (!isset($_SESSION["status"])){
		if (!empty($_POST)){
			if (($_POST["username"] == "***") && ($_POST["password"] == "***")){
				$_SESSION["status"] = "CONNECTED";
			}
			else{
				if (!empty($_POST)) $_SESSION["connexion"] = "Nom d'utilisateur ou mot de passe erroné";
				header("Location: ".$baseurl."script/login.php");
			}
		}
		else{
			header("Location: ".$baseurl."script/login.php");
		}
	}

?>
  	<title>Upload - Stardew Valley Wiki</title>
</head>
<body>
	<h1>Upload une sauvegarde</h1>
	<div class="menu desk">
		<nav id="menunavigation">
				<ul>
					<li><a href="<?= $baseurl ?>">Page principale</a></li>
					<li><a href="<?= $baseurl ?>recipes">Recettes de cuisine</a></li>
					<li><a href="<?= $baseurl ?>data">Données</a></li>
					<li><a href="<?= $baseurl ?>data/?player=Grochien">Données de Grochien</a></li>
				</ul>
		</nav>
		<div id="arrow">
			<img src="<?= $baseurl ?>others/styleImgs/arrow.png">
		</div>
	</div>
	
	<ul class="listeFriendship">
		<ul>
			<!-- <h4>Upload une sauvegarde</h4> -->
			<form method="POST" class="upload" enctype="multipart/form-data" action="<?= $baseurl ?>script/uploadxml.php">
				<label for="file">Uniquement fichier XML accepté. (NomDeLaFerme, pas SaveGameInfo)</label>
				<div>
					<input type="file" name="file" id="file" required>
					<input type="submit">
				</div>
			</form>
		</ul>
		<?php
			if (!empty($_SESSION["result"])){
				if ($_SESSION["result"] == "Success") $class = "success";
				else $class = "fail";
				
				echo "<p class='".$class."'>".$_SESSION["result"]."</p>";
				unset($_SESSION["result"]);
			}
		?>
	</ul>

	<div class="phone">
		<nav id="menunavigation">
				<ul>
					<li><a href="<?= $baseurl ?>">Page principale</a></li>
					<li><a href="<?= $baseurl ?>recipes">Recettes de cuisine</a></li>
					<li><a href="<?= $baseurl ?>data">Données</a></li>
					<li><a href="<?= $baseurl ?>data/?player=Grochien">Données de Grochien</a></li>
				</ul>
		</nav>
		<div id="arrow">
			<img src="<?= $baseurl ?>others/styleImgs/arrow.png">
		</div>
	</div>

</body>
</html>