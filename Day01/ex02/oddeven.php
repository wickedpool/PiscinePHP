#!/usr/bin/php
<?php

	while (!feof(STDIN))
	{
		echo "Entrez un nombre: ";
		$number = fgets(STDIN);
		$l = rtrim($number, "\n");
		if (is_numeric($l))
		{
			if ($l % 2 == 0)
				echo "Le chiffre " .$l. " est Pair\n";
			else
				echo "Le chiffre " .$l. " est impair\n";
		}
		else if ($number)
			echo "'" .$l. "' n'est pas un chiffre\n";
		else
		{
			echo "^D\n";
			break;
		}
	}

?>
