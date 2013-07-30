SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <29/03/2013>
-- Description:	<Buscar Depreciacion>
-- =============================================
CREATE PROCEDURE BuscarDepreciacion
AS
BEGIN
	SELECT D.Activo,AF.Fecha_incorporacion,D.Periodo,D.Monto_acumulado 
	FROM Depreciaciones D,Control_Periodo CP,Activos_Fijos AF 
	WHERE CP.Periodo=D.Periodo AND D.Activo=AF.Activo AND 
	DATEDIFF(month,AF.Fecha_incorporacion,Getdate())>='1' AND CP.Vigente='0'
	AND Periodo_saldo_cero IS NULL
END
GO
