SELECT titre, resum FROM film WHERE UPPER(resum) like UPPER("%vincent%") ORDER BY id_film asc;
