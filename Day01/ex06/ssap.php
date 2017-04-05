#!/usr/bin/php
<?php

	$i = 1;
	$tab = array();
	if ($argc == 1)
		break;
	while ($i < $argc)
	{
		$argv[$i] = trim($argv[$i]);
		$argv[$i] = preg_replace("/ +/", " ", $argv[$i]);
		$tab = array_merge($tab, explode(" ", $argv[$i]));
		$i++;
	}
	sort($tab);
	foreach ($tab as $var)
		echo $var."\n";

?>
