select titre, resum from film where UPPER(resum) like UPPER("%vincent%") order by id_film asc;
