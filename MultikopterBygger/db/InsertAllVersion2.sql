USE kopterbygger;

INSERT INTO `batteri`
(
	`BatteriID`, 
	`C_max`, 
	`mah`, 
	`Celler`, 
	`Pris`
) 

VALUES 
	(1,20,2200,3,295),
	(2,25,2200,3,189),
	(3,40,3000,3,369),
	(4,25,3300,3,465),
	(5,30,3300,3,329),
	(6,25,4000,3,717),
	(7,25,3300,4,600),
	(8,25,4000,4,703),
	(9,25,2200,4,325),
	(10,25,2500,4,455),
	(11,45,2600,4,714),
	(12,40,3000,4,485);


INSERT INTO `motor`
(
	`MotorID`,
	`kV`, 
	`Amps`, 
	`Pris`, 
	`Prop_dia`, 
	`Prop_vin`, 
	`CE_MAX`, 
	`CE_MIN`, 
	`Navn`
)

VALUES 
	(1,750,16,352,null,null,4,2,'T-Motor MT2212-16 750KV'),
	(2,900,20,415,null,null,4,3,'T-Motor MT2216-11 900KV'),
	(3,380,30,630,null,null,6,3,'T-Motor MT2826-11 380KV'),
	(4,1100,20,88,9,6,4,3,'NTM 2826 1100KV'),
	(5,1200,17,92,8,6,4,3,'NTM Prop Drive Series 28-26A 1200kv'),
	(6,1900,5,82,null,null,3,2,'Turnigy Multistar 1704-1900Kv'),
	(7,2300,8,59,5,3,3,2,'DYS BE1806-13');


INSERT INTO `kontrollbrett`
(
	`KontrollbrettID`,
	 `Rotor_min`, 
	 `Rotor_max`, 
	 `GPS`, 
	 `Pris`, 
	 `Navn`
)

VALUES 
	(1,3,8,'ja',null,'Ardupilot'),
	(2,3,8,'nei',160,'KK2.1.5'),
	(3,3,6,'ja',1325,'DJI Naza-M Lite');


INSERT INTO `esc`
(
	`ESCID`, 
	`Ampere`, 
	`CE_max`, 
	`CE_min`, 
	`Pris`, 
	`Navn`
)

VALUES 
	(1,30,4,2,239,'T-Motor 30A ESC for Multicopter'),
	(2,40,6,2,330,'T-Motor 40A ESC for Multicopter'),
	(3,30,4,2,86,'Afro ESC 30 AMP w/SimonK'),
	(4,20,4,2,82,'Afro Slim 20A w/SimonK'),
	(5,12,4,2,56,'Afro ESC 12A w/SimonK'),
	(6,6,3,2,49,'Turnigy Plush 6A'),
	(7,25,4,2,80,'Turnigy Plush 25A');

INSERT INTO `propeller`
(
	`PropellID`, 
	`Prop_dia`, 
	`Prop_vin`, 
	`Pris`, 
	`Navn`
)

VALUES 
	(1,9,5,null,'En propell'),
	(2,11,5,null,'yes');

INSERT INTO `spesifikasjoner`
(
	`SpesifikasjonID`,
	`Videoopptak`, 
	`Rekkevidde`, 
	`GPS`
)

VALUES 
	(1,'enkel','basic','ja'),
	(2,'enkel','basic','nei'),
	(3,'enkel','tid','ja'),
	(4,'enkel','tid','nei'),
	(5,'enkel','distanse','ja'),
	(6,'enkel','distanse','nei'),
	(7,'gimbal','basic','ja'),
	(8,'gimbal','basic','nei'),
	(9,'gimbal','tid','ja'),
	(10,'gimbal','tid','nei'),
	(11,'gimbal','distanse','ja'),
	(12,'gimbal','distanse','nei'),
	(13,'nei','basic','ja'),
	(14,'nei','basic','nei'),
	(15,'nei','tid','ja'),
	(16,'nei','tid','nei'),
	(17,'nei','distanse','ja'),
	(18,'nei','distanse','nei');

INSERT INTO `komponenter`
(
	`KomponenterID`, 
	`BatteriID`, 
	`KontrollbrettID`, 
	`PropellID`, 
	`MotorID`, 
	`ESCID`
)

VALUES 
(1,1,1,1,1,1),
(2,5,2,1,2,2),
(3,3,2,2,3,3),
(4,9,2,1,4,4),
(5,12,3,2,5,5),
(6,11,3,1,6,6),
(7,8,1,2,7,7),
(8,7,1,1,6,6),
(9,7,3,2,5,7),
(10,2,2,1,4,6),
(11,2,3,2,3,5),
(12,8,2,1,2,4),
(13,6,1,2,1,3),
(14,9,1,1,1,2),
(15,10,3,2,3,1),
(16,1,3,1,4,1),
(17,5,2,2,5,3),
(18,4,2,1,6,3);


INSERT INTO `oppskrift`
(
	`OppskriftID`, 
	`SpesifikasjonID`, 
	`KomponenterID`, 
	`Beskrivelse`
) 

VALUES 
(1,1,1,'Dette er en god modell for nybegynnere '),
(2,2,2,'Passer bedre for avanserte brukere '),
(3,3,3,'Passer for små barn '),
(4,4,4,'Egnet for husmødre '),
(5,5,5,'Gode akrobatiske egenskaper '),
(6,6,6,'Lett å modifisere '),
(7,7,7,'Kjapp å lære '),
(8,8,8,'Egnes godt i undervisning '),
(9,9,9,'Ulovlig i EU '),
(10,10,10,'Brukes av NASA '),
(11,11,11,'Passer den eldre garden '),
(12,12,12,'Veldig lang rekkevidde '),
(13,13,13,'Egnes godt for videoopptak '),
(14,14,14,'Perfekt for å spionere på naboen '),
(15,15,15,'Leverer alltid '),
(16,16,16,'Made in North Korea '),
(17,17,17,'Vanskelig å kontrollere '),
(18,18,18,'Anbefales ikke ');

DELIMITER ;;
CREATE TRIGGER CHECK_COMPATIBILITY BEFORE INSERT ON komponenter
FOR EACH ROW
BEGIN
IF (new.MotorID != new.ESCID)
THEN
SET @x = (SELECT `Ampere` FROM `esc` WHERE `ESCID` = new.ESCID);
SET @y =(SELECT `Amps` FROM `motor` WHERE `MotorID` = new.MotorID);
end if;
IF (@y < @x)
THEN        
SIGNAL SQLSTATE '45000'
  SET MESSAGE_TEXT = ' Motoren er ikke kompitabel med ESC, vennnligst prov igjen';
  end if;
  end;
  ;;