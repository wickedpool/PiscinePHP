<?php
	session_start();

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
?>
<?php
	require_once('session.php');
	if (!$_GET['id'] || !$_GET['nom'] || !$_GET['prix'] || !$_GET['categorie'])
		exit;
	if (!$_SESSION['panier'] || count($_SESSION['panier']) == 0) {
		$_SESSION['panier'] = array();
	}
	$new_produit=array($_GET['id'],$_GET['nom'],$_GET['prix'],$_GET['categorie'], 1);
	$is_in = 0;
	for ($i = 0; $i < count($_SESSION['panier']); $i++) {
		if($_SESSION['panier'][$i][0] == $_GET['id'])
		{
			$_SESSION['panier'][$i][4] = $_SESSION['panier'][$i][4] + 1;
			$is_in = 1;
		}
	}
	echo "
			<html class='home'>
	<head>
		<meta charset='UTF-8' />
		<link rel='stylesheet' type='text/css' href='style.css'>
		<title>RUSH</title>
	</head>
		<center><table>
		<tr>
			<th>Nom</th>
			<th>Prix</th>
			<th>quantite</th>
		</tr>";
	if (!$is_in)
		$_SESSION['panier'][]= $new_produit;
	foreach ($_SESSION['panier'] as $produit){
		$total +=$produit[2] * $produit[4];
		echo "
		<tr>
		<td>". $produit[1]."</td>
		<td>". $produit[2]."</td>
		<td>". $produit[4]."</td>
		</tr>";
	}
	echo "</table></center>
			</html>";
	$_SESSION['total']= $total;
	echo "<center class='total'> total = ".$total." euros</center><br>";
	if ($_SESSION['login'] && $_SESSION['login'] != "")
		echo "<center><a class='linkbutton' href=\"valid.php\">ORDER</a></center>";
	else {
		echo "<center><a class='linkbutton' href=\"valid_and_conn.php\">ORDER</a></center>";

	}
	echo "<footer>";
	echo "<a class='mylink' href=\"categorie.php?id=".$_GET['categorie']."\">Revenir a la selection de produits</a><br>";
	echo "<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>";
	echo "</footer>";
?>
