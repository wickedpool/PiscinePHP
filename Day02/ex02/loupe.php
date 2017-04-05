#!/usr/bin/php
<?php

if ($argc != 2)
	break;
if ($argv[1])
{
	$file = $argv[1];
	$handle = fopen($file, "r");
	while ($buff = fgets($handle))
		$string .= $buff;
}
$string = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/si", function($match) {
	$match[0] = preg_replace_callback("/( title=\")(.*?)(\")/mi", function($match) {
	return ($match[1]."".strtoupper($match[2])."".$match[3]);
	}, $match[0]);
	$match[0] = preg_replace_callback("/(>)(.*?)(<)/si", function($match) {
		return ($match[1]."".strtoupper($match[2])."".$match[3]);
	}, $match[0]);	
	return ($match[0]);
}, $string);
echo $string;

?>
