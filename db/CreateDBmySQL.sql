create database kopterbygger;
	USE kopterbygger;

create table Spesifikasjoner
	(
		SpesifikasjonID int not null,
		Rekkevidde nchar(10),
		Videoopptak nchar(10),
		GPS nchar(10),
		PRIMARY KEY (SpesifikasjonID)
	);

create table ESC
	(
		ESCID int not null,
		Ampere int not null,
		CE_max int not null,
		CE_min int not null,
		Pris int,
		Navn nchar(50),
		PRIMARY KEY (ESCID)
	);

create table Batteri
	(
		BatteriID int not null,
		C_max int not null,
		mah int  not null,
		Celler int not null,
		Pris int,
		PRIMARY KEY (BatteriID)
	);

create table Motor
	(
		MotorID int not null,
		kV int not null,
		Amps int,
		Pris int,
		Prop_dia int,
		Prop_vin int,
		CE_MAX int not null,
		CE_MIN int not null,
		Navn nchar(50),
		PRIMARY KEY (MotorID)
	);

create table Propeller
	(
		PropellID int not null,
		Prop_dia int not null,
		Prop_vin int not null,
		Pris int,
		Navn nchar(50),
		PRIMARY KEY (PropellID)
	);

create table Kontrollbrett
	(
		KontrollbrettID int not null,
		Rotor_min int not null,
		Rotor_max int not null,
		GPS nchar(50),
		Pris int,
		Navn nchar(50),	
		PRIMARY KEY (KontrollbrettID)
	);

create table Komponenter
	(
		KomponenterID int not null,
		BatteriID int not null,
		KontrollbrettID int not null,
		PropellID int not null,
		MotorID int not null, 
		ESCID int not null,
		PRIMARY KEY (KomponenterID),
		FOREIGN KEY (BatteriID) REFERENCES Batteri(BatteriID),
		FOREIGN	KEY (KontrollbrettID) REFERENCES Kontrollbrett(KontrollbrettID),
		FOREIGN KEY (PropellID) REFERENCES Propeller(PropellID),
		FOREIGN KEY (MotorID) REFERENCES Motor(MotorID),
		FOREIGN KEY (ESCID) REFERENCES ESC(ESCID)
	);

create table Oppskrift
	(
		OppskriftID int not null, 
		SpesifikasjonID int not null,
		KomponenterID int not null,
		Beskrivelse nchar(250),
		PRIMARY	KEY (OppskriftID),
		FOREIGN KEY (SpesifikasjonID) REFERENCES Spesifikasjoner(SpesifikasjonID),
		FOREIGN	KEY (KomponenterID) REFERENCES Komponenter(KomponenterID)
	);

create table users
	(
		username nchar(50) not null,
		password nchar(50) not null,
		PRIMARY KEY (username)
	);