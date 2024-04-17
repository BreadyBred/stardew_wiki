<?php 
	include '../templates/header.php';
?>
		<title>Connexion</title>
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
		<?php
			if (!empty($_SESSION["connexion"])){
				echo "<p class='fail'>".$_SESSION["connexion"]."</p>";
				unset($_SESSION["connexion"]);
			}
		?>
		<ul>
			<form action='<?= $baseurl ?>upload/index.php' method='POST' class="login">
				<h4 class="connect">Connexion</h4>
				<label for='username'>Entrez votre <u>nom d'utilisateur</u> : </label>
				<input type='text' placeholder='Username' id='username' name='username'>
				<label for='password'>Entrez <u>votre mot de passe</u> : </label>
				<input type='password' placeholder='********' id='password' name='password'>
				<input type='submit' value='Se connecter'>
			</form>
		</ul>
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