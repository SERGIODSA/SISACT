SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <30/03/2013>
-- Description:	<Buscar Ubicacion Activos>
-- =============================================
CREATE PROCEDURE BuscarUbicacionActivos
AS
BEGIN
	SELECT DISTINCT AF.Activo,Ubi AS Ubicacion,Fecha FROM Activos_Fijos AF LEFT JOIN 
	(SELECT AF.Activo AS Act,AU.Ubicacion AS Ubi,Fecha FROM Activos_Fijos AF,
	Activo_Ubicacion AU,Depreciaciones D,(SELECT Au.Activo AS Act,MAX(Fecha_ubicacion) 
	AS Fecha FROM Activos_Fijos AF,Activo_Ubicacion AU WHERE AU.Activo=AF.Activo 
	GROUP BY AU.Activo) AS Tabla WHERE AF.Activo=D.Activo AND AF.Activo=AU.Activo 
	AND AF.Activo=Act AND Fecha=Au.Fecha_ubicacion AND AF.Situacion!='3') AS Tabla ON 
	AF.Activo=Act WHERE AF.Situacion!='3'
END
GO
