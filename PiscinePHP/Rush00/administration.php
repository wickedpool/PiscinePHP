<?php
	session_start();

	if (!$_SESSION['is_admin'])
		echo "<script>window.location.replace(\"index.php\");</script>";
	if ($_SESSION['login'] && $_SESSION['login'] != "")
	{
		echo "	<ul class='topnav'>";
		if ($_SESSION['panier'] && $_SESSION['panier'] != "")
			echo	"<li style='float:right'><a href='emptybucket.php'>Vider le panier</a></li>";
		if ($_SESSION['is_admin'])
			echo	"<li style='float:right'><a href=\"administration.php\">administration</a></li>";
			echo	"<li style='float:right'><a href=\"deconnexion.php\">déconnexion</a></li>";
		$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
		$query = mysqli_query($db, 'SELECT id_categorie FROM produit_categorie GROUP BY id_categorie');
		while ($cate = mysqli_fetch_assoc($query))
			$categories[]=$cate;
		foreach($categories as $key=>$cate)
			echo	"<li><a href='categorie.php?id=".$cate['id_categorie']."'>".strtoupper($cate['id_categorie'])."</a></li>";
		echo "</ul>";
		// exit();
	}
	else {
		echo "<ul class='topnav'>
				<li style='float:right'><a href='log_form.php'>Connexion</a></li>
				<li style='float:right'><a href='create.php'>Creer un compte</a></li>";
				$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
				$query = mysqli_query($db, 'SELECT id_categorie FROM produit_categorie GROUP BY id_categorie');
				while ($cate = mysqli_fetch_assoc($query))
					$categories[]=$cate;
				foreach($categories as $key=>$cate)
					echo	"<li><a href='categorie.php?id=".$cate['id_categorie']."'>".strtoupper($cate['id_categorie'])."</a></li>";
				echo "</ul>";
	}
	if ($_SESSION['is_admin'])
	{
		echo "<html class='home'>
		<head><link rel='stylesheet' type='text/css' href='style.css'></head>
		<body>
			<ul class='topnav'>
				<li style='float:center'><a href='adm_new_produit.php'>Ajouter un produit</a></li>
					<li style='float:center'><a href='adm_upd_produit.php'>Modifier un produit</a></li>
					<li style='float:center'><a href='adm_upd_membre.php'>Modifier un compte</a></li>
					<li style='float:center'><a href='adm_voir_commandes.php'>Voir les commandes</a></li>
				</ul>
		<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>
		</body>
		</html>";
	}
?>
