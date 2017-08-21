<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'thgiraud';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);

if(! $conn ) {
	die('Could not connect: ' . mysql_error());
}

echo 'Connected successfully';

$sql = 'CREATE Database toto';
$retval = mysql_query( $sql, $conn);

if(! $retval ) {
	die('Could not create database: ' . mysql_error());
}

echo "Database toto created successfully\n";

   $sql = 'CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1';
   mysql_select_db('rush00');
   $retval = mysql_query( $sql, $conn );

   if(! $retval ) {
      die('Could not create table: ' . mysql_error());
   }

   echo "Table commandes created successfully\n";

	$sql = 'CREATE TABLE `commande_produit` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT';
	mysql_select_db('rush00');
	$retval1 = mysql_query( $sql, $conn);

	if (! $retval1 ) {
		die('Could not create table: ' . mysql_error());
	}

	echo "Table commande_produit created successfully\n";

	$sql =	'CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT "0"
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

	mysql_select_db('rush00');
	$retval2 = mysql_query( $sql, $conn);

	if (! $retval2 ) {
		die('Could not create table: ' . mysql_error());
	}

	echo "Table membre created succesfully\n";

	$sql = 'INSERT INTO `membres` (`id`, `login`, `passwd`, `admin`) VALUES
	(1, "toto", "0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c", 0),
	(2, "marine", "1fd1b4516473c36c8fb30bbf7c4490fc20419a10", 1),
	(3, "alcool", "eaf9056c166c50453e1bd27e9db7f48cd0067996", 0),
	(4, "ALBERTO", "5114d072e4e50a4494e3ed6d8ca849d3e06c3643", 0)';

	mysql_select_db('rush00');
	$retval2 = mysql_query( $sql, $conn);

	if (! $retval2 ) {
		die('Could not create table: ' . mysql_error());
	}

	$sql = 'CREATE TABLE `produit_categorie` (
  `id_produit` int(11) NOT NULL,
  `id_categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT';

	mysql_select_db('rush00');
	$retval = mysql_query( $sql, $conn);

	if (! $retval ) {
		die('Could not create table: ' . mysql_error());
	}

	echo "Table produit_categorie create succesfully\n";


$sql = 	'INSERT INTO `produit_categorie` (`id_produit`, `id_categorie`) VALUES
	(1, "tech"),
	(2, "tech"),
	(3, "mobilier")';

	mysql_select_db('rush00');
	$retval2 = mysql_query( $sql, $conn);

	if (! $retval2 ) {
		die('Could not create table: ' . mysql_error());
	}

	$sql = 'CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(300) NOT NULL,
  `prix` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1';

	mysql_select_db('rush00');
	$retval = mysql_query( $sql, $conn);

	if (! $retval ) {
		die('Could not create table: ' . mysql_error());
	}

	echo "Table produit create succesfully\n";

	$sql = 'INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `image`, `stock`) VALUES
(1, "iMAC", "27-inch, Late 2012", 200, "IMG_20170408_154000.jpg", 994),
(2, "SOURIS", "-", 10, "IMG_20170408_154033.jpg", 998),
(3, "Chaise", "sans accoudoir couleur rouge", 12, "IMG_20170408_152956.jpg", 45)';

mysql_select_db('rush00');
	$retval2 = mysql_query( $sql, $conn);

	if (! $retval2 ) {
		die('Could not create table: ' . mysql_error());
	}

mysql_close($conn);
?>
