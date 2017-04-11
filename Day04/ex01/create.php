<?php
	function error()
	{
		echo "ERROR\n";
		exit;
	}
	if ($_POST['submit'] !== "OK")
		error();
	if (!$_POST["login"] || !$_POST["passwd"])
		error();
	$serialized_path = "../private/";
	$serialized_file = $serialized_path . "passwd";
	if (file_exists($serialized_file))
		$auth = unserialize(file_get_contents($serialized_file));
	$largest_key = 0;
	foreach ($auth as $key => $element)
	{
		if ($element["login"] === $_POST["login"])
			error();
		if ($key > $largest_key)
			$largest_key = $key;
	}
	$auth[$largest_key + 1]["login"] = $_POST["login"];
	$auth[$largest_key + 1]["passwd"] = hash("whirlpool", $_POST["passwd"]);
	var_dump($auth);
	mkdir($serialized_path);
	file_put_contents($serialized_file, serialize($auth));
	echo "OK\n";
?>
