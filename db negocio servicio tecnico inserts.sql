use servicio_tecnico_db;

INSERT INTO localidad VALUES 
(1,'Argentina','Buenos Aires','La Plata','Centro'),
(2,'Argentina','Buenos Aires','La Plata','Tolosa'),
(3,'Argentina','Buenos Aires','La Plata','Gonnet'), 
(4,'Argentina','Buenos Aires','Mar del Plata','Puerto'), 
(5,'Argentina','Cordoba','Cordoba','Nueva Cordoba'), 
(6,'Argentina','Santa Fe','Rosario','Pichincha'),
(7,'Argentina','Mendoza','Mendoza','Godoy Cruz'), 
(8,'Argentina','Buenos Aires','Bahia Blanca','Centro'), 
(9,'Argentina','Salta','Salta','Tres Cerritos'),
(10,'Argentina','Neuquen','Neuquen','Centro');

INSERT INTO garantia_servicio VALUES 
(1,'30 dias','Basica'),
(2,'60 dias','Extendida'),
(3,'30 dias','Basica'),
(4,'90 dias','Premium'),
(5,'60 dias','Extendida'),
(6,'30 dias','Basica'),
(7,'90 dias','Premium'),
(8,'60 dias','Extendida'),
(9,'30 dias','Basica'),
(10,'90 dias','Premium');


INSERT INTO pago VALUES
(1,'Banco Nacion','001234567','COMP001'), 
(2,'Banco Provincia','002345678','COMP002'), 
(3,'Santander','003456789','COMP003'),
(4,'BBVA','004567890','COMP004'),
(5,'Galicia','005678901','COMP005'),
(6,'HSBC','006789012','COMP006'),
(7,'ICBC','007890123','COMP007'),
(8,'Macro','008901234','COMP008'),
(9,'Credicoop','009012345','COMP009'),
(10,'Patagonia','010123456','COMP010');

INSERT INTO articulo_reparar VALUES 
(1,'Samsung A50','Celular','Pantalla rota'), 
(2,'iPhone 11','Celular','Bateria dañada'), 
(3,'Motorola G20','Celular','No carga'), 
(4,'Xiaomi Redmi Note','Celular','Camara rota'), 
(5,'Tablet Lenovo','Tablet','Pantalla rota'), 
(6,'iPad Air','Tablet','No enciende'), 
(7,'Notebook HP','Notebook','Teclado falla'),
(8,'Notebook Dell','Notebook','Sobrecalentamiento'), 
(9,'Smartwatch Samsung','Reloj','No sincroniza'), 
(10,'iPhone 13','Celular','Vidrio roto');

INSERT INTO precio VALUES 
(1,5000,20000),
(2,4000,15000),
(3,4500,12000),
(4,6000,30000),
(5,3000,5000),
(6,3500,4000),
(7,3200,3500),
(8,2800,2000),
(9,2600,1800),
(10,3000,2500);

INSERT INTO impuestos VALUES 
(1,'IVA',21),
(2,'IVA',21),
(3,'IVA',21),
(4,'IVA',21),
(5,'IVA',21),
(6,'IVA',21),
(7,'IVA',21),
(8,'IVA',21),
(9,'IVA',21),
(10,'IVA',21);

INSERT INTO sueldo VALUES
(1,2000,2500,'Transferencia'), 
(2,2100,2600,'Transferencia'), 
(3,2200,2700,'Efectivo'),
(4,2300,2800,'Transferencia'), 
(5,2400,2900,'Transferencia'), 
(6,2000,2500,'Efectivo'),
(7,2100,2600,'Transferencia'), 
(8,2200,2700,'Transferencia'), 
(9,2300,2800,'Efectivo'),
(10,2400,2900,'Transferencia');

INSERT INTO seguro VALUES
(1,'Laboral','La Caja',50000),
(2,'Laboral','Sancor',45000), 
(3,'Laboral','Federacion Patronal',55000), 
(4,'Laboral','Provincia Seguros',60000), 
(5,'Laboral','Mapfre',48000),
(6,'Laboral','Zurich',52000),
(7,'Laboral','Allianz',51000), 
(8,'Laboral','HSBC Seguros',49500), 
(9,'Laboral','BBVA Seguros',47000), 
(10,'Laboral','Mercantil Andina',53000);


INSERT INTO factura_servicio VALUES
(1,'2024-02-01',1,1),
(2,'2024-02-02',2,2),
(3,'2024-02-03',3,3),
(4,'2024-02-04',4,4),
(5,'2024-02-05',5,5),
(6,'2024-02-06',6,6),
(7,'2024-02-07',7,7),
(8,'2024-02-08',8,8),
(9,'2024-02-09',9,9),
(10,'2024-02-10',10,10);

INSERT INTO repuestos VALUES 
(1,'Pantalla Samsung','Pantalla',1), 
(2,'Bateria iPhone','Bateria',2),
(3,'Modulo Camara','Camara',3),
(4,'Placa Base','Placa',4),
(5,'Conector Carga','Conector',5),
(6,'Altavoz','Audio',6),
(7,'Microfono','Audio',7),
(8,'Flex Boton','Flex',8),
(9,'Vibrador','Motor',9),
(10,'Lente Camara','Camara',10);

INSERT INTO contrato_empleado VALUES (1,'2023-01-01','Mañana',1),
(2,'2023-02-01','Mañana',2),
(3,'2023-03-01','Mañana',3),
(4,'2023-04-01','Mañana',4),
(5,'2023-05-01','Mañana',5),
(6,'2023-06-01','Mañana',6),
(7,'2023-07-01','Mañana',7),
(8,'2023-08-01','Mañana',8),
(9,'2023-09-01','Mañana',9),
(10,'2023-10-01','Mañana',10);

INSERT INTO inventario_productos VALUES 
(1,6,1),
(2,7,2),
(3,8,3),
(4,9,4),
(5,10,5),
(6,11,6),
(7,12,7),
(8,13,8),
(9,14,9),
(10,15,10);

INSERT INTO direccion_proveedor VALUES 
(1,'Ruta 2',1200,1900,1),
(2,'Ruta 36',400,1901,2),
(3,'Av 520',700,1902,3),
(4,'Ruta 11',2000,7600,4),
(5,'Av Fuerza Aerea',800,5000,5), 
(6,'Av Circunvalacion',1500,2000,6), 
(7,'Carril Rodriguez',300,5500,7), 
(8,'Ruta 3',600,8000,8),
(9,'Ruta 9',900,4400,9),
(10,'Ruta 22',450,8300,10);

INSERT INTO direccion_sucursal VALUES 
(1,'Av 7',1200,1900,1),
(2,'Av 44',800,1901,2),
(3,'Camino Centenario',1500,1902,3), 
(4,'Av Independencia',2300,7600,4), 
(5,'Av Sabattini',400,5000,5),
(6,'Av Pellegrini',900,2000,6), 
(7,'Av San Juan',1100,5500,7),
(8,'Av Alem',300,8000,8),
(9,'Av Bolivia',500,4400,9), 
(10,'Av Argentina',1000,8300,10);

INSERT INTO direccion_cliente VALUES 
(1,'Calle 50',100,1900,1),
(2,'Calle 51',200,1901,2),
(3,'Calle 52',300,1902,3),
(4,'Av Colon',1200,7600,4),
(5,'Av Olmos',500,5000,5),
(6,'San Lorenzo',400,2000,6),
(7,'Av San Martin',650,5500,7),
(8,'Brown',890,8000,8),
(9,'Balcarce',230,4400,9),
(10,'Perito Moreno',150,8300,10);

INSERT INTO direccion_empleado VALUES 
(1,'Calle 12',123,1900,1),
(2,'Calle 44',456,1901,2),
(3,'Calle 7',789,1902,3),
(4,'Av Siempre Viva',742,7600,4), 
(5,'San Martin',1200,5000,5),
(6,'Belgrano',300,2000,6),
(7,'Mitre',890,5500,7),
(8,'Rivadavia',450,8000,8),
(9,'Alberdi',670,4400,9),
(10,'Sarmiento',150,8300,10);

INSERT INTO presupuestos VALUES 
(1,21000,1),
(2,22000,2),
(3,23000,3),
(4,24000,4),
(5,25000,5),
(6,26000,6),
(7,27000,7),
(8,28000,8),
(9,29000,9),
(10,30000,10);


INSERT INTO inventario_repuestos VALUES 
(1,21,1),
(2,22,2),
(3,23,3),
(4,24,4),
(5,25,5),
(6,26,6),
(7,27,7),
(8,28,8),
(9,29,9),
(10,30,10);

INSERT INTO proveedor VALUES
(1,'Proveedor 1',1,1),
(2,'Proveedor 2',2,2),
(3,'Proveedor 3',3,3),
(4,'Proveedor 4',4,4),
(5,'Proveedor 5',5,5),
(6,'Proveedor 6',6,6),
(7,'Proveedor 7',7,7),
(8,'Proveedor 8',8,8),
(9,'Proveedor 9',9,9), 
(10,'Proveedor 10',10,10);

INSERT INTO sucursales VALUES 
(1,11,105,1,1,1,1),
(2,12,110,2,2,2,2),
(3,13,115,3,3,3,3),
(4,14,120,4,4,4,4),
(5,15,125,5,5,5,5),
(6,16,130,6,6,6,6),
(7,17,135,7,7,7,7),
(8,18,140,8,8,8,8),
(9,19,145,9,9,9,9),
(10,20,150,10,10,10,10);

INSERT INTO sucursales_proveedor VALUES 
(1,1),
(2,2),
(3,3),
(4,4),
(5,5),
(6,6),
(7,7),
(8,8),
(9,9),
(10,10);

INSERT INTO empleado VALUES 
(1,'Empleado1','Apellido1',30000001,'2216000001',160,10,1,1,1,1), 
(2,'Empleado2','Apellido2',30000002,'2216000002',160,10,2,2,2,2), 
(3,'Empleado3','Apellido3',30000003,'2216000003',160,10,3,3,3,3), 
(4,'Empleado4','Apellido4',30000004,'2216000004',160,10,4,4,4,4), 
(5,'Empleado5','Apellido5',30000005,'2216000005',160,10,5,5,5,5), 
(6,'Empleado6','Apellido6',30000006,'2216000006',160,10,6,6,6,6), 
(7,'Empleado7','Apellido7',30000007,'2216000007',160,10,7,7,7,7), 
(8,'Empleado8','Apellido8',30000008,'2216000008',160,10,8,8,8,8), 
(9,'Empleado9','Apellido9',30000009,'2216000009',160,10,9,9,9,9), 
(10,'Empleado10','Apellido10',30000010,'2216000010',160,10,10,10,10,10);

INSERT INTO orden_servicio VALUES 
(1,'2024-01-01','2024-01-06',1,1,1),
(2,'2024-01-02','2024-01-07',2,2,2),
(3,'2024-01-03','2024-01-08',3,3,3),
(4,'2024-01-04','2024-01-09',4,4,4),
(5,'2024-01-05','2024-01-10',5,5,5),
(6,'2024-01-06','2024-01-11',6,6,6),
(7,'2024-01-07','2024-01-12',7,7,7),
(8,'2024-01-08','2024-01-13',8,8,8),
(9,'2024-01-09','2024-01-14',9,9,9),
(10,'2024-01-10','2024-01-15',10,10,10);


INSERT INTO cliente VALUES 
(1,'Juan','Perez',30111222,'2214567890',1,1),
(2,'Maria','Gomez',28999111,'2214567891',2,2),
(3,'Luis','Fernandez',31555111,'2214567892',3,3),
(4,'Ana','Lopez',29999444,'2214567893',4,4),
(5,'Carlos','Diaz',32222333,'2214567894',5,5),
(6,'Sofia','Martinez',33444555,'2214567895',6,6),
(7,'Pedro','Sanchez',28888777,'2214567896',7,7),
(8,'Lucia','Torres',30123456,'2214567897',8,8),
(9,'Miguel','Ruiz',27666777,'2214567898',9,9), 
(10,'Laura','Castro',30999888,'2214567899',10,10);

INSERT INTO orden_entrega VALUES
(1,'2024-02-01',1,1),
(2,'2024-02-02',2,2),
(3,'2024-02-03',3,3),
(4,'2024-02-04',4,4),
(5,'2024-02-05',5,5),
(6,'2024-02-06',6,6),
(7,'2024-02-07',7,7),
(8,'2024-02-08',8,8),
(9,'2024-02-09',9,9),
(10,'2024-02-10',10,10);
