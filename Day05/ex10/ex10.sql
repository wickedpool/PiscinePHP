select titre as 'Titre', resum as 'Resume', annee_prod from film natural join genre where genre.nom = "erotic" order by film.annee_prod desc;
