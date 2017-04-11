<?php
session_start();
if(isset($_GET['submit'])) {
	if($_GET['submit'] == "OK") {
		if (isset($_GET['login']))
			$_SESSION['login'] = $_GET['login'];
		if (isset($_GET['passwd']))
			$_SESSION['passwd'] = $_GET['passwd'];
	}
} 
?>
<html><body>
		<form action="index.php" method="get">
			Identifiant: <input type="text" name="login" value="<?php echo $_SESSION['login']?>">
		 <br />
			Mot de passe: <input type="passwd" name="passwd" value="<?php echo $_SESSION['passwd']?>">
			<input type="submit" name="submit" value="OK">
		</form>
</body></html>
