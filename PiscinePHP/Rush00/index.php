<?php
	session_start();
// print_r($_SESSION);
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
<html class="home">
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>RUSH</title>
	</head>
	<body>
		<div class="ban">
			<img src="img/RTB2.png" class="BAN" />
		</div>
		<br/>
		<br/>
		<div class="imgindex">
			<a alt="tech" href="categorie.php?id=tech">
				<img class="indexo" src="img/IMG_20170408_154053.jpg"/>
			</a><br/>
			<a alt="mobilier" href="categorie.php?id=mobilier">
				<img class="indexo" src="img/IMG_20170408_153250.jpg"/>
			</a><br/>
			<a alt="art" href="categorie.php?id=art">
				<img class="indexo" src="img/IMG_20170408_153614.jpg"/>
			</a><br/>
		</div>
		<footer>
			<!-- <a class="mylink" href='emptybucket.php'>vider le panier</a> -->
		</footer>
	</body>
</html>
