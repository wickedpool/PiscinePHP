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
	if ($_POST['nom'] && $_POST['nom'] != "")
	{
		$login = $_POST['nom'];
		$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
		$query = mysqli_query($db, "SELECT * FROM membres WHERE login = '$login' LIMIT 1");
		$user_found = mysqli_fetch_assoc($query);
		// $_POST['id'] = $user_found['id'];
		if ($user_found['admin'])
			$checked = "Admin";
		else {
			$checked = "Non admin";
		}
	}
?>
<?php
echo "
<html class='home'>
<head><link rel='stylesheet' type='text/css' href='style.css'></head>
<body>
<h1>MODIFIER UN COMPTE</h1>
<form class='logform' action=\"adm_upd_membre.php\" method=\"post\">
	<label class='mytext' for=\"nom\">Login du membre a modifier</label><br>
		<input class='mybar' type=\"text\" name=\"nom\" value = \"". $_POST['nom'] . "\"/><br/>
	<input class='mybutton' type=\"submit\" name=\"connexion\" /><br/>
</form>


<form class='logform' action=\"admin_result1.php\" method=\"post\">
	<label class='mytext' for=\"nom\"> Modifier l'utilisateur ". $user_found['login'] ." (".$checked.") </label><br>
		<input class='mybar' type=\"text\" name=\"new_nom\" value = ". $user_found['login'] . "> <br/><br/>
	<label class='mytext' for=\"nom\"> Droits </label>
	<input style=\" display:none;\" type=\"text\" name=\"id\" value=" . $user_found['id'].">  <br>
		<input type=\"radio\" name=\"admin\"  > Admin <br>
    	<input type=\"radio\" name=\"nonadmin\" > Non Admin  <br>
	<input class='mybutton' type=\"submit\" name=\"modifier\" /><br/>
</form>
<br><br>

<h1>SUPPRIMER LE PRODUIT</h1>
<form class='logform' action=\"admin_result1.php\" method=\"post\">
<input style=\" display:none;\" type=\"text\" name=\"id\" value=" . $user_found['id'].">
		<input style=\" display:none;\" type=\"text\" name=\"delete\" value=" .  $user_found['id'].">
			<input class='mybutton' type=\"submit\" /><br/>
</form>

<h1>CREER UN COMPTE</h1>
<form class='logform' action=\"admin_result1.php\" method=\"post\">
	<label class='mytext' for=\"nom1\"> </label><br>
		<input class='mybar' type=\"text\" name=\"nom1\" > <br/><br/>
	<label class='mytext' for=\"mdp1\">	Votre mot de passe</label><br>
		<input class='mybar' type=\"password\" name=\"mdp1\" /><br/>
	<label class='mytext' for=\"nom\"> Droits </label><br>
		<input type=\"radio\" name=\"admin\"  > Admin <br>
    	<input type=\"radio\" name=\"nonadmin\" > Non Admin  <br>
	<input class='mybutton' type=\"submit\" name=\"modifier\" /><br/>
</form>
<a class='mylink' href=\"index.php\">Revenir a l'accueil</a>
</body>
</html>";
?>
