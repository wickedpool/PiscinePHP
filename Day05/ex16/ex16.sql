SELECT count(*) as film WHERE (date_debut_affiche AND date_fin_affiche BETWEEN '2006-10-30' AND '2007-07-27' OR '%-24-12' BETWEEN date_debut_affiche AND date_fin_affiche);
