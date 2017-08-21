#!/usr/bin/php
<?php

	if ($argc != 2)
		break;
	$str = preg_replace("/ +/", " ", $argv[1]);
	$str = trim($str, " ");
	echo $str."\n";
?>
