<?php
session_start();
// print_r($_POST);
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

$nom = $_POST['nom'];
$description = $_POST['description'];
$image = $_POST['image'];
$prix = $_POST['prix'];
$stock = $_POST['stock'];
// print_r($_POST);
if ($_POST['id'] && $_POST['id'] != "")
{
	$iddd = $_POST['id'];
	$new_nom = $_POST['new_nom'];
	$query = mysqli_query($db, "UPDATE `produits` SET `nom`=$nom,`description`=$description,`prix`=$prix,`image`=$image,`stock`=$stock WHERE id ='$iddd'");
	mysqli_query($db, "DELETE FROM `produit_categorie`  WHERE id_produit ='$iddd'");
}
else {
	$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
	$idmax = mysqli_query($db, 'SELECT MAX(id) FROM produits');
	$id = mysqli_fetch_assoc($idmax);
	$iddd = $id['MAX(id)'] + 1;
	$query = mysqli_query($db, "INSERT INTO `produits`(`id`, `nom`, `description`, `prix`, `image`, `stock`) VALUES ('$iddd','$nom','$description','$prix','$image','$stock')");
}
// if ($_POST['id'] && $_POST['id'] != "" || $query)
// {
if ($_POST['delete'] && $_POST['delete'] != "")
{
	$iddd = $_POST['id'];
	mysqli_query($db, "DELETE FROM `produits`  WHERE id ='$iddd'");
}
else {
	foreach ($_POST as $key=>$value)
	{
		if (substr($key, 0, 4) == "cate")
		{
			$cate = $_POST[$key];
			$query = mysqli_query($db, "INSERT INTO `produit_categorie`(`id_produit`, `id_categorie`) VALUES ('$iddd','$cate')");
		}
	}
	if ($_POST['newc'] && $_POST['newc'] != "")
	{
		$newc = $_POST['newc'];
		$query = mysqli_query($db, "INSERT INTO `produit_categorie`(`id_produit`, `id_categorie`) VALUES ('$iddd','$newc')");

	}
}

// }

if ($_POST['id'] && $_POST['id'] != "" && !$_POST['delete'])
	echo "<br>Le produit " . $nom. " a bien ete modifie.<br>";
else if (!$_POST['delete'])
	echo "Votre produit a bien ete ajoute.<br>";
else {
	echo "Votre produit a bien ete supprime.<br>";
}
?>

<html class='home'>
<head><link rel='stylesheet' type='text/css' href='style.css'></head>
<body>
			<a class='mylink' href="index.php">Revenir a l'accueil</a>
</body>
