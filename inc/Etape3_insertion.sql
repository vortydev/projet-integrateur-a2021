<<<<<<< HEAD

/************************/
/* INSERTION DE DONNÉES */
/************************/

USE ConfigurationSupreme;

INSERT INTO Fabricant(nom)
Values ('Asus'),
('MSI'),
('ASRock'),
('Gigabyte'),
('Intel'),
('Noctua'),
('NZXT'),
('Corsair'),
('Silverstone'),
('ZALMAN'),
('Swiftech'),
('T-Force'),
('OWC'),
('Richer-R'),
('G.SKILL'),
('Crucial'),
('Seagate'),
('Samsung'),
('Western Digital'),
('DELL'),
('HP'),
('NVIDIA'),
('EVGA'),
('Zotac'),
('Lian Li'),
('Phanteks'),
('Cooler Master'),
('BitFenix'),
('Thermaltake'),
('Fractal Design'),
('PowerColor'),
('Kingston Technologies'),
('Gigastone'),
('PNY'),
('bequiet'),
('AMD');

INSERT INTO Socket(nom)
VALUES ('AM4'),
('LGA1150'),
('LGA1151'),
('AM3+'),
('FCBGA1528'),
('SP3'),
('sTR4'),
('FCLGA1200'),
('PGA988A'),
('FCBGA1449'),
('F(1207)'),
('LGA2011-0'),
('LGA2011-3'),
('LGA1156'),
('LGA1155'),
('AM2'),
('AM2+'),
('AM3'),
('FM1'),
('FM2'),
('FM2+'),
('LGA1200'),
('LGA1366'),
('LGA2066'),
('LGA775'),
('LGA2011'),
('LGA115X'),
('LGA2011-V3'),
('FCLGA1150');

INSERT INTO SupportUSB(nom)
VALUES ('USB 3.2 GEN 1, USB 3.2 GEN 2, USB 2.0'),
('USB 3.2 GEN 1, USB 2.0'),
('USB 3.2 Gen 2 Type-C, USB 3.2 Gen 1 Type-A'),
('USB 3.2 Gen 1 Type-A, USB 2.0 Type-A'),
('USB 3.2 Gen 1 Type-A'),
('USB 3.2 Gen 1'),
('USB 3.2 GEN 2'),
('USB 2.0'),
('USB 3.2 GEN 2 Type-A'),
('USB 3.2 GEN 2 Type-C');

INSERT INTO TypeMemoire(nom)
VALUES ('DDR2'),
('DDR3'),
('DDR4'),
('DDR5'),
('DDR6'),
('GDDR5X'),
('GDDR6'),
('GDDR6X'),
('GDDR3'),
('GDDR4'),
('GDDR5');

INSERT INTO TypeBoitier(nom)
VALUES ('ATX Mid Tower'),
('ATX Full Tower'),
('Micro ATX Mini Tower'),
('Mini ITX Tower'),
('Mini ITX Test Bench'),
('MicroATX Slim'),
('HTPC'),
('MicroATX Desktop'),
('ATX Desktop'),
('ATX Test Bench');

INSERT INTO FormeCarteMere(nom)
VALUES('ATX'),
('Micro ATX'),
('Mini ITX'),
('EATX'),
('HPTX'),
('Thin Mini ITX'),
('Mini DTX'),
('SSI CEB'),
('SSI EEB'),
('XL ATX');

INSERT INTO Connecteur(nom)
VALUES ('PCI x16'),
('DIMM'),
('SO-DIMM'),
('SATA'),
('M.2'),
('SAS2'),
('NVME.2'),
('PCI-EX16'),
('PCI-E X1'),
('PCI-EX16, PCI-E X1'),
('M.2, SATA 6GB/s'),
('PCIe x16');

INSERT INTO Client(prenom, nom,courriel, motDePasse, dateNaissance, adresse)
values  ('Alberto','Oviedo','alboviedo@hotmail.com','alboviedo','1995-02-11','168 Rue Mont-Plaisant'),
('Etienne','Menard','etimenard@hotmail.com','etimenard','2001-01-11','199 Rue Sarah'),
('Pier-Olivier','Corriveau','pocorriveau@hotmail.com','pocorriveau','2002-09-01','01 Bacon'),
('Camilo','Torres','camtorres@hotmail.com','camtorres','1992-10-11','05 Des boises'),
('Karen','Torres','kartorres@hotmail.com','kartorres','1995-12-28','16 Rue Darche'),
('Samuel','Gagnon','samgagnon@hotmail.com','samgagnon','2005-10-12','34 vaisseau dor'),
('Shelane','Kathe','shekate@hotmail.com','shekate','1999-05-05','4 Rue Montreal'),
('Francis','Perron','fraperron@hotmail.com','fraperron','1994-02-18','50 Rue Evageline'),
('Jimmy','Peterson','jimpeterson@hotmail.com','jimpeterson','1984-11-06','19 La cantera'),
('Charlotte','Thevenin','chathevenin@hotmail.com','chathevenin','1993-11-19','168 Rue Mont-Plaisant');

INSERT INTO Boitier(idFabricant,modele,typeBoitier,typeFenetre,psuShroud,psuInclus,idSupportUSB,idFormeCarteMere)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'NZXT'),'H510',(SELECT id FROM TypeBoitier WHERE nom = 'ATX Mid Tower'),'Verre tempéré',1,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 2 Type-C, USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='ATX')),
((SELECT id FROM Fabricant WHERE nom = 'Corsair'),'4000D Airflow',(SELECT id FROM TypeBoitier WHERE nom = 'ATX Mid Tower'),'Verre tempéré tinté',1,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 2 Type-C, USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='ATX')),
((SELECT id FROM Fabricant WHERE nom = 'Lian Li'),'PC-O11 Dynamic',(SELECT id FROM TypeBoitier WHERE nom = 'ATX Full Tower'),'Verre tempéré',1,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 2 Type-C, USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='EATX')),
((SELECT id FROM Fabricant WHERE nom = 'Phanteks'),'Eclipse P300',(SELECT id FROM TypeBoitier WHERE nom = 'ATX Mid Tower'),'Verre tempéré tinté',1,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='ATX')),
((SELECT id FROM Fabricant WHERE nom = 'Cooler Master'),'MasterBox Q300L',(SELECT id FROM TypeBoitier WHERE nom = 'Micro ATX Mini Tower'),'Acrylique',0,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='Micro ATX')),
((SELECT id FROM Fabricant WHERE nom = 'Silverstone'),'SG13 V2',(SELECT id FROM TypeBoitier WHERE nom = 'Mini ITX Tower'),'Non',0,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='Mini ITX')),
((SELECT id FROM Fabricant WHERE nom = 'BitFenix'),'Prodigy',(SELECT id FROM TypeBoitier WHERE nom = 'Mini ITX Tower'),'Non',0,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='Mini ITX')),
((SELECT id FROM Fabricant WHERE nom = 'Thermaltake'),'Core P3',(SELECT id FROM TypeBoitier WHERE nom = 'ATX Mid Tower'),'Verre tempéré',0,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A, USB 2.0 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='ATX')),
((SELECT id FROM Fabricant WHERE nom = 'Thermaltake'),'Level 20',(SELECT id FROM TypeBoitier WHERE nom = 'ATX Full Tower'),'Verre tempéré',0,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='EATX')),
((SELECT id FROM Fabricant WHERE nom = 'Fractal Design'),'Focus G Mini',(SELECT id FROM TypeBoitier WHERE nom = 'Micro ATX Mini Tower'),'Acrylique',0,0,(SELECT id FROM SupportUSB WHERE nom = 'USB 3.2 Gen 1 Type-A, USB 2.0 Type-A'),(SELECT id FROM FormeCarteMere WHERE nom ='Micro ATX'));

INSERT INTO CarteGraphique (idFabricant,modele,chipset,capacite,typeMemoire,frequence,frameSync,idConnecteur)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'Corsair'),'GeForce RTX 3080','GeForce RTX 3080',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6X'),1440,'G-Sync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'EVGA'),'GeForce GTX 1650','GeForce GTX 1650',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6'),1410,'G-Sync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'Zotac'),'GeForce GTX 1070 Ti','GeForce GTX 1070 Ti',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR5'),1607,'G-Sync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'Asus'),'GeForce RTX 3090','GeForce RTX 3090',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6X'),1395,'G-Sync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'MSI'),'GeForce GTX 1660 Super','GeForce GTX 1660 Super',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6'),1530,'G-Sync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'MSI'),'GeForce RTX 3060','GeForce RTX 3060',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6'),1320,'G-Sync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'PowerColor'),'Radeon RX 6900 XT','Radeon RX 6900 XT',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6'),1825,'FreeSync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'MSI'),'Radeon RX 6700 XT','Radeon RX 6700 XT',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6'),2321,'FreeSync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'MSI'),'Radeon RX 580','Radeon RX 580',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR5'),1257,'FreeSync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16')),
((SELECT id FROM Fabricant WHERE nom = 'Gigabyte'),'Radeon RX 5700 XT','Radeon RX 5700 XT',10,(SELECT id FROM TypeMemoire WHERE nom ='GDDR6'),1650,'FreeSync',(SELECT id FROM Connecteur WHERE nom ='PCIe x16'));


INSERT INTO SupportStockage (idFabricant, modele, typeStockage, capacite, rpm, idConnecteur, tauxTransfert)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'Seagate'),'BarraCuda ST 2000DM008','HDD',2048,7200,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 190),
((SELECT id FROM Fabricant WHERE nom = 'Samsung'),'Samsung 970 Evo Plus','SSD',1024,0,(SELECT id FROM Connecteur WHERE nom = 'M.2'), 850),
((SELECT id FROM Fabricant WHERE nom = 'Western Digital'),'Caviar Blue','HDD',1024,7200,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 300),
((SELECT id FROM Fabricant WHERE nom = 'Samsung'),'Samsung 86- Evo ','SSD',1024,0,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 520),
((SELECT id FROM Fabricant WHERE nom = 'Western Digital'),'WD Blue','SSD',500,0,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 525),
((SELECT id FROM Fabricant WHERE nom = 'Seagate'),'Fire Cuda 530','SSD',4096,0,(SELECT id FROM Connecteur WHERE nom = 'M.2'), 7300),
((SELECT id FROM Fabricant WHERE nom = 'Seagate'),'ST3500312CS','HDD',500,5900,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 300),
((SELECT id FROM Fabricant WHERE nom = 'DELL'),' 342-5358 Dell','HDD',2048,7200,(SELECT id FROM Connecteur WHERE nom = 'SAS2'), 750),
((SELECT id FROM Fabricant WHERE nom = 'Kingston Technologies'),'SA400S37','SSD',250,0,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 500),
((SELECT id FROM Fabricant WHERE nom = 'HP'),'461203-B21 HP','SSD',64,0,(SELECT id FROM Connecteur WHERE nom = 'SATA'), 1500),
((SELECT id FROM Fabricant WHERE nom = 'Western Digital'),'SSN 550','SSD',1024,0,(SELECT id FROM Connecteur WHERE nom = 'M.2'), 2400);


INSERT INTO MemoireVive (idFabricant,modele,capacite,nbBarrettes,frequence,idConnecteur,typeMemoire)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'Corsair'),'Vengeance LPX 16gb CMK16GX4M2B3200C16',16,2,2133,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'Corsair'),'Vengeance RGB Pro 32gb',32,2,3600,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'T-FORCE'),'VULCAN Z 16 GB TLZGD416G3200HC16CDC01',16,2,3200,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'OWC'),'Owc1333d3',16,2,1333,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR3')),
((SELECT id FROM Fabricant WHERE nom = 'Gigastone'),'SO2666CL19-16GB-1PK',16,1,2666,(SELECT id FROM Connecteur WHERE nom = 'SO-DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'Richer-R'),'Richer-Rri067v25g4',4,1,800,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR2')),
((SELECT id FROM Fabricant WHERE nom = 'G.SKILL'),'Trident Z Neo F4-3600C16D-32GTZNC',16,2,3600,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'G.SKILL'),'Aegis F4-3000C16S-8GISB',8,1,3000,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'Corsair'),'Vengeance LPX 64GB CMK64GX4M2Z4000C18',64,2,4000,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'Crucial'),'',16,2,3000,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4')),
((SELECT id FROM Fabricant WHERE nom = 'PNY'),'XLR8 MD16GK2D4320016AXR',16,2,3200,(SELECT id FROM Connecteur WHERE nom = 'DIMM'),(SELECT id FROM TypeMemoire WHERE nom ='DDR4'));

INSERT INTO SystemeRefroidissement (idFabricant,modele,dimension)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'Noctua'),'NH-U9S','120'),
((SELECT id FROM Fabricant WHERE nom = 'NZXT'),'Kraken XX53','138.4x27.0x312.5'),
((SELECT id FROM Fabricant WHERE nom = 'NZXT'),'Kraken X40','138.4x27.0x172.5'),
((SELECT id FROM Fabricant WHERE nom = 'Corsair'),'H100i','240'),
((SELECT id FROM Fabricant WHERE nom = 'Silverstone'),'HE-01','140x140x38'),
((SELECT id FROM Fabricant WHERE nom = 'bequiet'),'Dark Rock 2','87x121x155'),
((SELECT id FROM Fabricant WHERE nom = 'ZALMAN'),'Reserator 3 Max','120x145x79'),
((SELECT id FROM Fabricant WHERE nom = 'Swiftech'),'H220','269x128x29'),
((SELECT id FROM Fabricant WHERE nom = 'Silverstone'),'Tundra TD03','154x120x32'),
((SELECT id FROM Fabricant WHERE nom = 'Silverstone'),'Tundra TD02','2730x1200x220');


INSERT INTO Processeur (idFabricant,modele,nbCoeurs,frequence,idSocket)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'Intel'),'Core i5-10210U',4,1.6,(SELECT id FROM Socket WHERE nom ='FCBGA1528')),
((SELECT id FROM Fabricant WHERE nom = 'Intel'),'Core i7-4765T',4,2,(SELECT id FROM Socket WHERE nom ='FCLGA1150')),
((SELECT id FROM Fabricant WHERE nom = 'Intel'),'Core i7-1195G7',4,2.9,(SELECT id FROM Socket WHERE nom ='FCBGA1449')),
((SELECT id FROM Fabricant WHERE nom = 'AMD'),'EPYC 7763',64,2.5,(SELECT id FROM Socket WHERE nom ='SP3')),
((SELECT id FROM Fabricant WHERE nom = 'AMD'),'Ryzen Threadripper 2950X',16,3.5,(SELECT id FROM Socket WHERE nom ='sTR4')),
((SELECT id FROM Fabricant WHERE nom = 'Intel'),'Core i9-10900KF',10,3.7,(SELECT id FROM Socket WHERE nom ='FCLGA1200')),
((SELECT id FROM Fabricant WHERE nom = 'Intel'),'Core i5-450M',2,2.4,(SELECT id FROM Socket WHERE nom ='PGA988A')),
((SELECT id FROM Fabricant WHERE nom = 'Intel'),'Core i3-6100T',2,3.2,(SELECT id FROM Socket WHERE nom ='LGA1151')),
((SELECT id FROM Fabricant WHERE nom = 'AMD'),'EPYC 7413',24,2.7,(SELECT id FROM Socket WHERE nom ='SP3')),
((SELECT id FROM Fabricant WHERE nom = 'AMD'),'Opteron 2384',4,2.7,(SELECT id FROM Socket WHERE nom ='F(1207)'));



INSERT INTO CarteMere(idFabricant,modele,idForme,idSocket,chipset,capaciteRam,typeMemoire,nbConnecteurRam,wifi,idSupportUSB)
VALUES ((SELECT id FROM Fabricant WHERE nom = 'MSI'),'MEG X570 UNIFY',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'AM4'),'AMD X570',128,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),4,'WI-FI 6',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 3.2 GEN 2, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'Asus'),'MAXIMUS VII HERO ATX LGA1150',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'LGA1150'),'Intel z97',32,(SELECT id FROM TypeMemoire WHERE nom ='DDR3'),4,'Non',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'Asus'),'PRIME Z270-A ATX LGA1151',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'LGA1151'),'Intel Z270',64,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),4,'Non',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'MSI'),'B450M MORTAR Micro',(SELECT id FROM FormeCarteMere WHERE nom = 'Micro ATX'),(SELECT id FROM Socket WHERE nom = 'AM4'),'AMD B450',64,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),4,'Non',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'Asus'),'Z170I PRO GAMING',(SELECT id FROM FormeCarteMere WHERE nom = 'Mini ITX'),(SELECT id FROM Socket WHERE nom = 'LGA1151'),'Intel Z170',32,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),2,'WI-FI 5',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'ASRock'),'990FX Killer',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'AM3+'),'AMD 990FX',64,(SELECT id FROM TypeMemoire WHERE nom ='DDR3'),4,'Non',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'Gigabyte'),'Z390 AORUS PRO ',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'LGA1151'),'Intel Z390',128,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),4,'WI-FI 5',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 3.2 GEN 2, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'Asus'),'Z370-A LGA1151',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'LGA1151'),'Z370',64,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),4,'Non',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'MSI'),'Z97 MPOWER ',(SELECT id FROM FormeCarteMere WHERE nom = 'ATX'),(SELECT id FROM Socket WHERE nom = 'LGA1150'),'Intel Z97',32,(SELECT id FROM TypeMemoire WHERE nom ='DDR3'),4,'Non',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0')),
((SELECT id FROM Fabricant WHERE nom = 'ASRock'),'Fatal1ty Gaming',(SELECT id FROM FormeCarteMere WHERE nom = 'Mini ITX'),(SELECT id FROM Socket WHERE nom = 'AM4'),'AMD B450',64,(SELECT id FROM TypeMemoire WHERE nom ='DDR4'),2,'WI-FI 6',(SELECT id FROM SupportUSB WHERE nom ='USB 3.2 GEN 1, USB 2.0'));

INSERT INTO Config(idClient,idCarteMere,idProcesseur,idCooler,idMemoireVive,idCarteGraphique,idBoitier,dateCreation)
VALUES((SELECT id FROM Client WHERE prenom = 'Alberto'),(SELECT id FROM CarteMere WHERE modele = '990FX Killer'),(SELECT id FROM Processeur WHERE modele = 'Core i7-1195G7'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'Kraken X40'),(SELECT id FROM MemoireVive WHERE modele = 'Owc1333d3'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1650'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Etienne'),(SELECT id FROM CarteMere WHERE modele = 'PRIME Z270-A ATX LGA1151'),(SELECT id FROM Processeur WHERE modele = 'Core i7-1195G7'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'H220'),(SELECT id FROM MemoireVive WHERE modele = 'Vengeance RGB Pro 32gb'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce RTX 3060'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Pier-Olivier'),(SELECT id FROM CarteMere WHERE modele = '990FX Killer'),(SELECT id FROM Processeur WHERE modele = 'Core i9-10900KF'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'Tundra TD02'),(SELECT id FROM MemoireVive WHERE modele = 'Owc1333d3'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1650'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Camilo'),(SELECT id FROM CarteMere WHERE modele = 'Z370-A LGA1151'),(SELECT id FROM Processeur WHERE modele = 'Core i7-1195G7'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'H220'),(SELECT id FROM MemoireVive WHERE modele = 'SO2666CL19-16GB-1PK'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1070 Ti'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Karen'),(SELECT id FROM CarteMere WHERE modele = 'Fatal1ty Gaming'),(SELECT id FROM Processeur WHERE modele = 'Core i3-6100T'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'Kraken X40'),(SELECT id FROM MemoireVive WHERE modele = 'Vengeance RGB Pro 32gb'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1650'),(SELECT id FROM Boitier WHERE modele = 'Focus G Mini'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Samuel'),(SELECT id FROM CarteMere WHERE modele = 'PRIME Z270-A ATX LGA1151'),(SELECT id FROM Processeur WHERE modele = 'Core i9-10900KF'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'NH-U9S'),(SELECT id FROM MemoireVive WHERE modele = 'XLR8 MD16GK2D4320016AXR'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce RTX 3060'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Shelane'),(SELECT id FROM CarteMere WHERE modele = 'Fatal1ty Gaming'),(SELECT id FROM Processeur WHERE modele = 'Core i5-10210U'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'H100i'),(SELECT id FROM MemoireVive WHERE modele = 'Owc1333d3'),(SELECT id FROM CarteGraphique WHERE modele = 'Radeon RX 580'),(SELECT id FROM Boitier WHERE modele = 'Prodigy'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Francis'),(SELECT id FROM CarteMere WHERE modele = 'PRIME Z270-A ATX LGA1151'),(SELECT id FROM Processeur WHERE modele = 'Opteron 2384'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'NH-U9S'),(SELECT id FROM MemoireVive WHERE modele = 'Vengeance RGB Pro 32gb'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1650'),(SELECT id FROM Boitier WHERE modele = 'MasterBox Q300L'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Jimmy'),(SELECT id FROM CarteMere WHERE modele = 'Z370-A LGA1151'),(SELECT id FROM Processeur WHERE modele = 'Core i3-6100T'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'Tundra TD02'),(SELECT id FROM MemoireVive WHERE modele = 'XLR8 MD16GK2D4320016AXR'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1070 Ti'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE()),
((SELECT id FROM Client WHERE prenom = 'Charlotte'),(SELECT id FROM CarteMere WHERE modele = 'Z370-A LGA1151'),(SELECT id FROM Processeur WHERE modele = 'Core i5-10210U'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'H100i'),(SELECT id FROM MemoireVive WHERE modele = 'SO2666CL19-16GB-1PK'),(SELECT id FROM CarteGraphique WHERE modele = 'Radeon RX 580'),(SELECT id FROM Boitier WHERE modele = 'H510'),CURDATE());




=======

/****************************/
/* REQUÊTES DE PIER-OLIVIER */
/****************************/



/**********************/
/* REQUÊTES D'ALBERTO */
/**********************/
SELECT id FROM Socket WHERE nom ='FCBGA1528'

SELECT co.id, ca.modele, so.nom  FROM 
Config co
INNER JOIN CarteMere ca ON ca.id = co.idCarteMere
INNER JOIN Socket so ON so.id = ca.idSocket

SELECT * FROM Client 
ORDER BY prenom;

SELECT modele FROM memoirevive 
WHERE capacite > 12 
AND nbBarrettes = 1;

INSERT INTO Config(idClient,idCarteMere,idProcesseur,idCooler,idMemoireVive,idCarteGraphique,idBoitier,dateCreation)
VALUES((SELECT id FROM Client WHERE prenom = 'Alberto'),(SELECT id FROM CarteMere WHERE modele = '990FX Killer'),(SELECT id FROM Processeur WHERE modele = 'Core i7-1195G7'),(SELECT id FROM SystemeRefroidissement WHERE modele = 'Kraken X40'),(SELECT id FROM MemoireVive WHERE modele = 'Owc1333d3'),(SELECT id FROM CarteGraphique WHERE modele = 'GeForce GTX 1650'),(SELECT id FROM Boitier WHERE modele = '4000D Airflow'),CURDATE())

Select AVG(frequence) FROM processeur;

CREATE VIEW viewALB AS
SELECT prenom, nom
FROM client;

UPDATE config
SET dateCreation = CURDATE()
WHERE idClient = (SELECT id FROM Client WHERE prenom = 'Alberto');

SELECT COUNT(*) FROM client;


UPDATE client
set nom = 'Albarracin Oviedo'
WHERE prenom = 'Alberto';





/**********************/
/* REQUÊTES D'ÉTIENNE */
/**********************/
SELECT * FROM Config WHERE id = 1

SELECT idStockage FROM JointureConfigStockage WHERE idConfig = 1

INSERT INTO Config (idClient, idCarteMere, idProcesseur, idCooler, idMemoireVive, idCarteGraphique, idBoitier, dateCreation)
VALUES (1, 1, 1, 1, 1, 1, 1, '2021-12-07')

INSERT INTO JointureConfigStockage (idConfig, idStockage)
VALUES (1, 1)
    
DELETE FROM Config WHERE id = 1

DELETE FROM JointureConfigStockage
WHERE idConfig = 1
    
SELECT con.id, CONCAT(cli.prenom, ' ', cli.nom) AS utilisateur
FROM Config con
INNER JOIN Client cli ON cli.id = con.idClient
INNER JOIN CarteGraphique cg ON cg.id = con.idCarteGraphique
WHERE cg.idFabricant = (SELECT DISTINCT fab.id FROM Fabricant fab WHERE fab.nom = 'AMD')
ORDER BY dateCreation DESC
GO

CREATE VIEW V_ConfigurationsDate AS
	SELECT c.id, c.idClient, c.dateCreation
	FROM Config c
GO

UPDATE Fabricant 
SET nom = 'Advanced Micro Devices'
WHERE nom = 'AMD'

UPDATE Client
SET motDePasse = 'abc123'
WHERE courriel = 'alboviedo@hotmail.com'

GO
CREATE FUNCTION F_ConfigurationClient(@idClient INT)
RETURNS TABLE
AS
	RETURN (SELECT c.id, c.dateCreation
			FROM Config c
			WHERE c.idClient = @idClient)
GO
>>>>>>> cb0f8cb46fcddb16f3de69372accd7cfe8b62618
