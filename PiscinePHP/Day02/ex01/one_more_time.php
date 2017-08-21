#!/usr/bin/php
<?php

	if ($argc != 2)
		break;
	$month = array('/[Jj]anvier/', '/[Jf]evrier/', '/[Mm]ars/', '/[Aa]vril/', '/[Mm]ai/', '/[Jj]uin/', '/[Jj]uillet/', '/[Aa]out/', '/[Ss]eptembre/', '/[Oo]ctobre/', '/[Nn]ovembre/', '/[Dd]ecembre/');
	$enmonth = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
	$str = $argv[1];
	if (substr_count($str, " ") != 4)
	{
		echo "Wrong Format\n";	
		break;
	}
	$str = strtolower($str);
	$tab = explode(" ", $str);
	$toto = array_shift($tab);
	foreach ($month as $i=>$mois)	
		$tab[1] = preg_replace($mois, $enmonth[$i], $tab[1]);
	$s = implode(" ", $tab);
	date_default_timezone_set('Europe/Paris');
	$d = strtotime($s);
	print_r($d);
?>
