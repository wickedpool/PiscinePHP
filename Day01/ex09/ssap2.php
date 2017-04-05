#!/usr/bin/php
<?php

function	my_sort($a, $b)
{
	$array = "abcdefghijklmnopqrstuvwxyz0123456789 !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
	$a = strtolower($a);
	$b = strtolower($b);
	$i = 0;
	while ($a[$i] && $b[$i])
	{
		$pa = strpos($array, $b[$i]);
		$pb = strpos($array, $a[$i]);
		if ($pa != $pb)
			return ($pb - $pa);
		$i++;
	}
}

$i = 1;
$tab = array();
$result;
if ($argc == 1)
	break;
while ($i < $argc)
{
	$argv[$i] = trim($argv[$i]);
	$argv[$i] = preg_replace("/ +/", " ", $argv[$i]);
	$tab = array_merge($tab, explode(" ", $argv[$i]));
	$i++;
}
usort($tab, "my_sort");
foreach ($tab as $var)
	echo $var."\n";

?>
