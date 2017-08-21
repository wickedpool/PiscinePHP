SELECT titre as 'Titre', resum as 'Resume', annee_prod FROM film natural JOIN genre WHERE genre.nom = "erotic" ORDER BY film.annee_prod DESC;
