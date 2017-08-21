<?php

function	ft_split($str)
{
	$str = trim($str);
	$str = preg_replace("/ +/", " ", $str);
	$tab = explode(" ", $str);
	sort($tab);
	return ($tab);
}

?>
