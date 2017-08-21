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
// print_r($_POST);
$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
$is_admin =-1;
if ($_POST['admin'] && $_POST['admin'] == "on")
	$is_admin = 1;
else if ($_POST['nonadmin'] && $_POST['nonadmin'] == "on")
	$is_admin = 0;
if ($_POST['delete'] && $_POST['delete'] != "")
{
	$iddd = $_POST['id'];
	mysqli_query($db, "DELETE FROM `membres`  WHERE id ='$iddd'");
	echo "<br>L'utilisateur a bien ete supprime.";
}
else if ($_POST['id'] && $_POST['id'] != "")
{
	$iddd = $_POST['id'];
	$new_nom = $_POST['new_nom'];
		// echo ">>>  ".$new_nom."   >> " . $is_admin . ">>  ".$iddd;
	if ($is_admin != -1)
		$query = mysqli_query($db, "UPDATE `membres` SET `login`='$new_nom', `admin`='$is_admin' WHERE id = '$iddd'");
	echo "<br>L'utilisateur " . $new_nom. " a bien ete ajoute.";
}
else {
	$idmax = mysqli_query($db, 'SELECT MAX(id) FROM membres');
	$id = mysqli_fetch_assoc($idmax);
	$iddd = $id['MAX(id)'] + 1;
	$login = $_POST['nom1'];
	$passwd = $_POST['mdp1'];
	// echo ">>>  ".$login."   >> " . $id['MAX(id)'] . ">>  ".$iddd. ">>  ".$is_admin;
	$query = mysqli_query($db, "INSERT INTO `membres`(`id`, `login`, `passwd`, `admin`) VALUES ('$iddd', '$login', '$passwd', '$is_admin')");
	echo "<br>L'utilisateur " . $login. " a bien ete ajoute.";

}
?>
<html class='home'>
<head><link rel='stylesheet' type='text/css' href='style.css'></head>
<body>
	<a class='mylink' href="index.php">Revenir a l'accueil</a>
</body>
