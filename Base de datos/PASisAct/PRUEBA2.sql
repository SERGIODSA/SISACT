DELETE FROM Activo_Ubicacion
DELETE FROM Depreciaciones
UPDATE Activos_Fijos SET Ultimo_periodo=NULL,Periodo_saldo_cero=NULL,Situacion='0',Fecha_incorporacion=NULL WHERE Activo='Admiral'
UPDATE Activos_Fijos SET Ultimo_periodo=NULL,Periodo_saldo_cero=NULL,Situacion='0',Fecha_incorporacion=NULL WHERE Activo='Benwin'
UPDATE Activos_Fijos SET Ultimo_periodo=NULL,Periodo_saldo_cero=NULL,Situacion='0',Fecha_incorporacion=NULL WHERE Activo='Galaxy'
UPDATE Activos_Fijos SET Ultimo_periodo=NULL,Periodo_saldo_cero=NULL,Situacion='0',Fecha_incorporacion=NULL WHERE Activo='Samsung'
UPDATE Control_Periodo SET Vigente='1' WHERE Periodo='201303'
DELETE FROM Control_Periodo WHERE Periodo>'201303'