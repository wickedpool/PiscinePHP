SELECT count(*) as nb_abo, ROUND(AVG(prix) -1, 0) as moy_abo, SUM(duree_abo) % 42 as ft from abonnement;
