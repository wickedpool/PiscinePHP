#!/usr/bin/php
<?php

	if ($argc != 4)
	{
		echo "Incorrect Parameters\n";
		break;
	}
	$s1 = trim($argv[1]);
	$sign = trim($argv[2]);
	$s2 = trim($argv[3]);
	if ($sign == "+")
		echo ($s1 + $s2)."\n";
	else if ($sign == "-")
		echo ($s1 - $s2)."\n";
	else if ($sign == "*")
		echo ($s1 * $s2)."\n";
	else if ($sign == "/")
		echo ($s1 / $s2)."\n";
	else if ($sign == "%")
		echo ($s1 % $s2)."\n";
?>
