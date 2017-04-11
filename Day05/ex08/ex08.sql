select nom,prenom,SUBSTR(date_naissance,1,10) as 'date de naissance' from fiche_personne where date_naissance BETWEEN '1989-01-01' AND '1989-12-31';
