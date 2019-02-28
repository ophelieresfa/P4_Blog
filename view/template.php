<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="public/style.css" />
		<title><?php $title ?></title>
		<!-- Font Awesome CDN -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<!-- Tiny MCE -->
		<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=gx3hkd8a680littsdy0nnyqcg5rzlnpkda583h04kotftzma"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<a href="index.php"><h1 id="titreBlog">Billet simple pour l'Alaska</h1></a>
					
					<div id="connexion">
					<?php
					if(isset($_SESSION['userId'])){
						echo '<p><a href="index.php?action=deconnexion" class="button-connexion">Deconnexion</a></p>';
						echo '<p><a href="index.php?action=connexionAdmin" class="button-connexion">Administration</a></p>';
					}else {
						echo '<form method="POST" action="index.php?action=administration">
						<p><input type="text" name="username" placeholder="Identifiant"/></p>
						<p><input type="password" name="password" placeholder="Mot de passe"/></p>
						<p><input type="submit" value="Connexion"></p>
						</form>';
					}
					?>
					</div>
					
			</div>
			<div id="superwrapper">
				<div id"="contenu">
					<div id="status">
						<?php
							if(isset($_SESSION['userId'])) {
								echo '<p>Vous êtes connecté</p>';
							} else {
								echo '<p>Vous êtes déconnecté</p>';
							}
							?>
					</div>
					<?= $content ?> 
				</div>
			</div>
			<footer id="piedBlog">
				Blog réalisé avec PHP, HTML5 et CSS.
			</footer>
		</div>
	</body>
</html>