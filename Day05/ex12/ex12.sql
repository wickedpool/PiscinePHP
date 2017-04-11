SELECT nom, prenom FROM fiche_personne fp WHERE prenom LIKE "%-%" OR nom LIKE "%-%" ORDER BY nom, prenom ASC;
