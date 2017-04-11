<?php
function error()
{
	echo "ERROR\n";
	exit;	
}
if ($_POST['submit'] !== 'OK')
	error();
if (!$_POST['login'] || !$_POST['oldpw'] || !$_POST['newpw'])
	error();
$serialized_path = "../private/";
$serialized_file = $serialized_path . "passwd";
$auth = unserialize(file_get_contents($serialized_file));
$mykey = hash("whirlpool", $_POST['oldpw']);
foreach ($auth as $key => $elem)
{
	if ($elem['login'] === $_POST['login'])
	{
		if ($elem['passwd'] == $mykey)
		{
			$elem['passwd'] = hash("whirlpool", $_POST['newpw']);
			file_put_contents($serialized_file, serialize($elem));
			echo "OK\n";
			exit;
		}
		else
			error();
	}
}
error();
?>
