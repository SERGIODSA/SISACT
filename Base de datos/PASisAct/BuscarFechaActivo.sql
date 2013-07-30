SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <29/03/2013>
-- Description:	<Buscar Activos Fechas>
-- =============================================
CREATE PROCEDURE BuscarFechasActivos
	@Activo varchar(8)
AS
BEGIN
	SELECT Costo_adquisicion,Saldo_a_depreciar,Fecha_incorporacion FROM Activos_Fijos 
	WHERE Activo=@Activo
END
GO
