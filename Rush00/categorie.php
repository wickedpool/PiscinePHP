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

if ($_GET['id'] && $_GET['id'] != ""){
	$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
// $query = "SELECT name FROM cat_by_prod, category WHERE id_products = ".$product['id']." AND id_category = id;";
		echo "<html class='home'>
		<link rel='stylesheet' type='text/css' href='style.css'>
		<div class='wrapper'>";
	$id_categorie = $_GET['id'];
	$query = mysqli_query($db, "SELECT * FROM produits as p , produit_categorie as pc WHERE p.id = pc.id_produit AND pc.id_categorie = '$id_categorie'");
	while ($produits = mysqli_fetch_assoc($query))
		$array[]=$produits;
	foreach ($array as $produit){
		echo "
		<div class='block'>
		<img class=\"circle\" width=\"40%\" src =img/".$produit['image']." ><br/>"
		.$produit['description']."<br/>
		<a href=\"addproduct.php?
		categorie=".$id_categorie.
		"&id=".$produit['id'].
		"&nom=".$produit['nom'].
		"&prix=".$produit['prix']."\">Ajouter au produit</a><br/>
		</div>";
	}
		echo '</div><footer>';
		echo "<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>";
		echo '</footer>';
}
?>
