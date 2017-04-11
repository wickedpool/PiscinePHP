select etage_salle as etage, SUM(nbr_siege) as sieges from salle group by etage_salle order by sieges desc;
