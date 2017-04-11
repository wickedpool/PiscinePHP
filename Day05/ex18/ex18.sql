select nom from distrib where id_distrib IN (42,62,63,64,65,66,67,68,69,71,88,89,90) OR UPPER(CHAR_LENGTH(nom)) - UPPER(CHAR_LENGTH(REPLACE(nom, 'y', ''))) = 2 LIMIT 2,5;
