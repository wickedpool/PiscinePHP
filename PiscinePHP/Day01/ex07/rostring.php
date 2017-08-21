#!/usr/bin/php
<?php

	if ($argc == 1)
		break;
	$tab = array();
	$var = $argv[1];
	$var = preg_replace("/ +/", " ", $var);
	$var = trim($var);
	$tab = explode(" ", $var);
	$last = array_shift($tab);
	foreach ($tab as $lo)
	{
		echo $lo;
		echo " ";
	}
	echo $last."\n";
?>
