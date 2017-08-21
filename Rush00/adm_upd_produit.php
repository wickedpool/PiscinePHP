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
	// $db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
	// $query = mysqli_query($db, 'SELECT id_categorie FROM produit_categorie GROUP BY id_categorie');
	// while ($cate = mysqli_fetch_assoc($query))
	// 	$categories[]=$cate;
	if ($_POST['nom'] && $_POST['nom'] != "")
	{
		$nom = $_POST['nom'];
		// echo $nom;
		$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
		$query = mysqli_query($db, "SELECT * FROM produits WHERE nom = '$nom' LIMIT 1");
		$product = mysqli_fetch_assoc($query);
		// print_r($product);
	}
echo"
<html class='home'>
<head><link rel='stylesheet' type='text/css' href='style.css'></head>
<body>

<h1>MODIFIER UN PRODUIT</h1>

<form class='logform' action=\"adm_upd_produit.php\" method=\"post\">
	<label class='mytext' for=\"nom\">Nom du produit a modifier</label><br>
		<input class='mybar' type=\"text\" name=\"nom\" value = \"". $_POST['nom'] . "\"/><br/>
	<input class='mybutton' type=\"submit\" name=\"connexion\" /><br/>
</form>


<form class='logform' action=\"admin_result.php\" method=\"post\">
	<label class='mytext' for=\"nom\">Nom</label><br>
		<input class='mybar' type=\"text\" name=\"nom\" value=" . $product['nom']."><br/>
	<label class='mytext' for=\"description\">Description</label><br>
		<input class='mybar' type=\"text\" name=\"description\" value=" . $product['description']."><br/>
	<label class='mytext' for=\"image\">Nom image</label><br>
		<input class='mybar' type=\"text\" name=\"image\" value=" . $product['image']."><br/>
	<label class='mytext' for=\"prix\">Prix</label><br>
		<input class='mybar' type=\"text\" name=\"prix\" value=" . $product['prix']."><br/>
	<label class='mytext' for=\"stock\">Stock</label><br>
		<input class='mybar' type=\"text\" name=\"stock\" value=" . $product['stock']."><br/><br>

		<input style=\" display:none;\" type=\"text\" name=\"id\" value=" . $product['id'].">

	<label class='mytext' for=\"cate\">Categories</label><br>";

	$i=0;
	foreach($categories as $key=>$cate)
	{
		$i++;
		echo "<input type=\"checkbox\" name=\"cate".$i."\" value=".$cate['id_categorie']."> ".$cate['id_categorie']."<br>";
	}
	echo "<br><label class='mytext' for=\"newc\">Autre categorie</label><br>
 		<input class='mybar' type=\"text\" name=\"newc\" /><br/><br>
	<input class='mybutton' type=\"submit\" name=\"connexion\" /><br/>
</form>

<h1>SUPPRIMER LE PRODUIT</h1>
<form class='logform' action=\"admin_result.php\" method=\"post\">
		<input style=\" display:none;\" type=\"text\" name=\"delete\" value=" . $product['id'].">
		<input style=\" display:none;\" type=\"text\" name=\"id\" value=" . $product['id'].">
			<input class='mybutton' type=\"submit\" /><br/>
</form>


		<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>
</body>
</html>";
?>
