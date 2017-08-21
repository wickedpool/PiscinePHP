<?php
session_start();
$is_conn = 1;
if ((!$_POST['login'] || $_POST['login'] == "") && !($_SESSION['login'] && $_SESSION['login'] != ""))
{
	echo "<html class='home'>
		<link rel='stylesheet' type='text/css' href='style.css'>
		<div class=nav>
			<form class='logform' action=\"valid_and_conn.php\" method=\"post\">
				<label class='mytext' for=\"login\">	Login</label><br>
				<input class='mybar' type=\"text\" name=\"login\" /><br/>
				<label class='mytext' for=\"passwd\">	Mot de passe</label><br>
				<input class='mybar' type=\"password\" name=\"passwd\" /><br/>
				<input class='mybutton' type=\"submit\" name=\"connexion\" /><br/>
			</form>
		</div>
		</html>";
}
else {
	header("location: valid.php");
}
if ($_POST['login'] && $_POST['login'] !== "" && $_POST['passwd'] !== "") {
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	// echo "ok";
	//CONNEXION SQL
	$db = mysqli_connect("localhost", "root", "thgiraud", "rush00");
	// if (!$db)
		// echo "fuck";
	$login = preg_replace("[^A-Za-z0-9]","",$login);
	$passwd = preg_replace("[^A-Za-z0-9]","",$passwd);
	//crypt
	//SQL request
	$query = mysqli_query($db, "SELECT * FROM membres WHERE login = '$login' LIMIT 1");
	$user_found = mysqli_fetch_assoc($query);
	// echo $user_found['login'];
	if(!$user_found) {
		echo "L'utilisateur n'existe pas reessayez ou creez un compte!";
		echo "<a class='mylink' href=\"valid.php\">Reesayer</a>";
		echo "<a class='mylink' =\"create.php\">Creer un compte</a>";
	}
	else {
		$passwd = sha1($passwd);
		// echo "passwd: ".$passwd."<br>";
		$query2 = mysqli_query($db, "SELECT * FROM membres WHERE login='$login' AND passwd='$passwd' LIMIT 1");
		$user_found2 = mysqli_fetch_assoc($query2);
		// print_r($user_found2);
		if(!$user_found2) {
			// echo "Le mot de passe ne correspond pas";
			// exit();
		}
		else {
			$_SESSION['login']=$login;
			$_SESSION['is_admin']=$user_found2['admin'];
			// echo "connecte";
			// header("location: index.php");
		}
	}
}
else {
}
?>
