<?php
	session_start();
	if ($_SESSION['login'] && $_SESSION['login'] != "")
	{
		echo "	<ul class='topnav'>";
		
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
?>
<?php
//session_start();

	$is_conn = 0;
	$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
	$idmax = mysqli_fetch_assoc(mysqli_query($db, 'SELECT MAX(id) FROM commandes'));
	$iddd = $idmax['MAX(id)'] + 1;
	$montant = $_SESSION['total'];
	$login = $_SESSION['login'];
	$queryid = mysqli_query($db, "SELECT id FROM membres WHERE login = '$login' ");
	$membre = mysqli_fetch_assoc($queryid);
	$idm=$membre['id'];
	// echo ">>>>  id ". $iddd. " montant  " . $montant . " idm  " . $_SESSION['login'];
	$query = mysqli_query($db, "INSERT INTO `commandes`(`id`, `montant`, `id_membre`) VALUES ('$iddd', '$montant', '$idm')");
	$_SESSION['panier'][]= $new_produit;
	foreach ($_SESSION['panier'] as $produit){
		mysqli_query($db, "INSERT INTO `commande_produit`(`id_commande`, `id_produit`, `quantite`) VALUES ('$iddd','$produit[0]','$produit[4]')");
		$stock = mysqli_fetch_assoc(mysqli_query($db, "SELECT stock FROM produits WHERE id = '$produit[0]' "))['stock'] - $produit[4];
		mysqli_query($db, "UPDATE `produits` SET `stock`='$stock' WHERE id = '$produit[0]'");
	}
	unset($_SESSION['panier']);
	echo "<center><h1 style='color:white;border: 2px solid black;font-size:70px;'>Votre commande a bien été enregistrée</h1></center><br>";
	echo "
	<html class='home'>
	<head>
		<meta charset='UTF-8' />
		<link rel='stylesheet' type='text/css' href='style.css'>
		<title>RUSH</title>
	</head>
	";
	echo "<footer>";
	echo "<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>";
	echo "</footer>";
?>
