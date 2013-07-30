DELETE FROM Activo_Ubicacion
DELETE FROM Ubicaciones
DELETE FROM Depreciaciones
DELETE FROM Control_Periodo
DELETE FROM Activos_Fijos
DELETE FROM Proveedores

INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201201','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201202','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201203','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201204','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201205','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201206','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201207','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201208','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201209','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201210','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201211','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201212','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201301','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201302','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201303','0')
INSERT INTO Control_Periodo (Periodo,Vigente) VALUES ('201304','1')

INSERT INTO Proveedores (Proveedor,Descripcion,Vigente) VALUES ('wwwwwwww','a','1'),('prueba','a','1'),('prueba2','a','1')

INSERT INTO Activos_Fijos (Activo,Descripcion,Utiliza_serial,Serial,Fecha_adquisicion,Referencia,Costo_adquisicion,Vida_util,Saldo_a_depreciar,Ultimo_periodo,Periodo_saldo_cero,Fecha_incorporacion,Fecha_desincorporacion,Proveedor,Situacion) VALUES
 ('Admiral','prueba3','0',NULL,'29/03/2013 14:55:00.000','xyz','50000,00','10','5000,00',NULL,NULL,NULL,NULL,'wwwwwwww','0')
,('Benwin','prueba4','0',NULL,'10/01/2013 14:55:00.000','ert','60000,00','6','10000,00',NULL,NULL,NULL,NULL,'prueba','0')
,('Galaxy','prueba2','0',NULL,'30/11/2012 14:54:00.000','x','4000,00','4','1000,00',NULL,NULL,NULL,NULL,'prueba2','0')
,('Samsung','prueba','0',NULL,'01/01/2012 14:52:00.000','123','10000,00','10','1000,00',NULL,NULL,NULL,NULL,'prueba','0')

INSERT INTO Ubicaciones (Ubicacion,Descripcion) VALUES ('Almacen','x'),('Deposito','y')