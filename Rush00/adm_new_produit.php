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

	// $idmax = mysqli_query($db, 'SELECT MAX(id) FROM produits');
	// $id = mysqli_fetch_assoc($idmax);
	// $query = mysqli_query($db, 'SELECT id_categorie FROM produit_categorie GROUP BY id_categorie');
	// while ($cate = mysqli_fetch_assoc($query))
	// 	$categories[]=$cate;
?>
<html class='home'>
<head><link rel='stylesheet' type='text/css' href='style.css'></head>
<body>

	<h1>AJOUTER UN NOUVEAU PRODUIT</h1>
<form class='logform' action="admin_result.php" method="post">
	<label class='mytext' for="nom">Nom</label><br>
		<input class='mybar' type="text" name="nom" /><br/>
	<label class='mytext' for="description">Description</label><br>
		<input class='mybar' type="text" name="description" /><br/>
	<label class='mytext' for="image">Nom image</label><br>
		<input class='mybar' type="text" name="image" /><br/>
	<label class='mytext' for="prix">Prix</label><br>
		<input class='mybar' type="text" name="prix" /><br/>
	<label class='mytext' for="stock">Stock</label><br>
		<input class='mybar' type="text" name="stock" /><br/><br>
	<label class='mytext' for="cate">Categories</label><br>
	<?php
	$i=0;
	foreach($categories as $key=>$cate)
	{
		$i++;
		echo "<input type=\"checkbox\" name=\"cate".$i."\" value=".$cate['id_categorie']."> ".$cate['id_categorie']."<br>";
	}
	 ?>
	 <br>
	 <label class='mytext' for="newc">Autre categorie</label><br>
 		<input class='mybar' type="text" name="newc" /><br/><br>
	<input class='mybutton' type="submit" name="connexion" /><br/>
</form>

		<a class='mylink' href="index.php">Revenir a l'accueil</a>
</body>
</html>
