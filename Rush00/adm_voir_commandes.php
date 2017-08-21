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

	$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
	$id_categorie = $_GET['id'];
	$query = mysqli_query($db, "SELECT * FROM commandes");
	while ($cmds = mysqli_fetch_assoc($query))
		$array[]=$cmds;
	foreach ($array as $cmd){
		unset($array_produits);
		$idc = $cmd['id'];
		echo "
		<html class='home'>
		<link rel='stylesheet' type='text/css' href='style.css'>
		<div class='blockcmd'>";
		echo "	commande : ".$idc ."<br>";
		echo "	montant : ".$cmd['montant'] ."€<br>";
		echo "	id membre : ".$cmd['id_membre'];

			$detail = mysqli_query($db, "SELECT * FROM commande_produit WHERE id_commande = '$idc'");
			while ($cmde = mysqli_fetch_assoc($detail))
				$array_produits[] = $cmde;
				// echo ">>>>>>> ".count($array_produits);
			if(count($array_produits))
			{
				echo "<br><hr><div>";
				foreach ($array_produits as $cmd_detail){
					echo "	id produit : ".$cmd_detail['id_produit'];
					echo "	quantite : ".$cmd_detail['quantite'] ."<br>";
				}
				echo "</div>";
			}
		echo "
		</div>
		<html>";
	}
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
		echo "<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>";

?>
