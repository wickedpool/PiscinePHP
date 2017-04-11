create table ft_table(
	ID int auto_increment primary key,
	LOGIN varchar(7) DEFAULT 'toto',
	GROUPE ENUM('staff','student','other') NOT NULL,
	DATE_DE_CREATION TIMESTAMP NOT NULL
);
