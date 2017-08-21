<?php
	require_once("session.php");

	if ($_SESSION['panier']) {
		unset($_SESSION['panier']);
		unset($_SESSION['total']);
		header("location:index.php");
	}
	else {
		echo "echec...";
	}
?>
