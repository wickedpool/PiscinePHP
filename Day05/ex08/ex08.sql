SELECT nom, prenom, SUBSTR(date_naissance,1,10) as 'date de naissance' FROM fiche_personne WHERE date_naissance BETWEEN '1989-01-01' AND '1989-12-31';
