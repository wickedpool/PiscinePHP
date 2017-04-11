select nom , prenom from fiche_personne fp where prenom like "%-%" OR nom like "%-%" order by nom,prenom asc;
