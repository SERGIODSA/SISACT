SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <30/03/2013>
-- Description:	<Reporte Detallado Activos>
-- =============================================
CREATE PROCEDURE ReporteDetallado 
	@Tipo tinyint
AS
BEGIN
	IF(@Tipo='0')
	BEGIN
		SELECT AU.Ubicacion,AF.Activo,AF.Descripcion,AF.Proveedor,AF.Costo_Adquisicion,
		(AF.Costo_adquisicion-D.Monto_acumulado) AS Saldo
		FROM Activos_Fijos AF,Activo_Ubicacion AU,Depreciaciones D,
		(SELECT Au.Activo AS Act,MAX(Fecha_ubicacion) AS Fecha FROM Activos_Fijos AF,
		Activo_Ubicacion AU WHERE AU.Activo=AF.Activo GROUP BY AU.Activo) AS Tabla 
		WHERE AF.Activo=D.Activo AND AF.Activo=AU.Activo AND AF.Activo=Act 
		AND Fecha=Au.Fecha_ubicacion ORDER BY AU.Ubicacion
	END
	IF(@Tipo='1')
	BEGIN
		SELECT DISTINCT AF.Proveedor,AF.Activo,AF.Descripcion,Ubi AS Ubicacion,
		AF.Costo_Adquisicion,Saldo FROM Activos_Fijos AF LEFT JOIN
		(SELECT AF.Proveedor,AF.Activo AS Act,AF.Descripcion,AU.Ubicacion AS Ubi,AF.Costo_Adquisicion,
		(AF.Costo_adquisicion-D.Monto_acumulado) AS Saldo
		FROM Activos_Fijos AF,Activo_Ubicacion AU,Depreciaciones D,
		(SELECT Au.Activo AS Act,MAX(Fecha_ubicacion) AS Fecha FROM Activos_Fijos AF,
		Activo_Ubicacion AU WHERE AU.Activo=AF.Activo GROUP BY AU.Activo) AS Tabla 
		WHERE AF.Activo=D.Activo AND AF.Activo=AU.Activo AND AF.Activo=Act 
		AND Fecha=Au.Fecha_ubicacion) 
		AS Tabla ON AF.Activo=Act ORDER BY AF.Proveedor
	END
	ELSE
	BEGIN
		SELECT DISTINCT AF.Proveedor,AF.Activo,AF.Descripcion,Ubi AS Ubicacion,
		AF.Costo_Adquisicion,Saldo FROM Activos_Fijos AF LEFT JOIN
		(SELECT AF.Descripcion,AF.Activo AS Act,AF.Proveedor,AU.Ubicacion AS Ubi,
		AF.Costo_Adquisicion,(AF.Costo_adquisicion-D.Monto_acumulado) AS Saldo
		FROM Activos_Fijos AF,Activo_Ubicacion AU,Depreciaciones D,
		(SELECT Au.Activo AS Act,MAX(Fecha_ubicacion) AS Fecha FROM Activos_Fijos AF,
		Activo_Ubicacion AU WHERE AU.Activo=AF.Activo GROUP BY AU.Activo) AS Tabla 
		WHERE AF.Activo=D.Activo AND AF.Activo=AU.Activo AND AF.Activo=Act 
		AND Fecha=Au.Fecha_ubicacion)
		AS Tabla ON AF.Activo=Act ORDER BY AF.Descripcion
	END
END
GO
