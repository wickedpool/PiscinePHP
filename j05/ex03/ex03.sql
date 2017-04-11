INSERT INTO FT_TABLE (login, groupe, date_de_creation)
SELECT nom, 'other', date_naissance FROM fiche_personne WHERE LENGTH(nom) < 9 AND nom like "%a%" ORDER BY nom ASC LIMIT 11;
