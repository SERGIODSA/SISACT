SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <30/03/2013>
-- Description:	<ResumenActivos>
-- =============================================
CREATE PROCEDURE ResumenActivos
	@Tipo bit 
AS
BEGIN
	IF(@Tipo='1')
	BEGIN
		SELECT AU.Ubicacion,COUNT(*) AS Cantidad,SUM(AF.Costo_adquisicion) AS Costo,
		SUM(AF.Saldo_a_depreciar) AS Saldo FROM 
		(SELECT Au.Activo AS Act,MAX(Fecha_ubicacion) AS Fecha FROM Activos_Fijos AF,
		Activo_Ubicacion AU WHERE AU.Activo=AF.Activo GROUP BY AU.Activo) AS Tabla,
		Activo_Ubicacion AU,Activos_Fijos AF 
		WHERE AF.Activo=AU.Activo AND AU.Activo=Act AND Fecha=Au.Fecha_ubicacion 
		GROUP BY AU.Ubicacion
	END
	ELSE
	BEGIN
		SELECT Proveedor,COUNT(*) AS Cantidad,SUM(Costo_adquisicion) AS Costo,
		SUM(Saldo_a_depreciar) AS Saldo FROM Activos_Fijos GROUP BY Proveedor
	END
END
GO
