<?php

function	ft_is_sort($tab)
{
	$tmp = $tmp2 = $tab;
	sort($tab);
	$result = array_diff_assoc($tmp, $tab);
	if (!$result)
		return (1);
	rsort($tmp2);
	$res = array_diff_assoc($tmp, $tmp2);
	if (!$res)
		return (1);
	else
		return (0);
}

?>
