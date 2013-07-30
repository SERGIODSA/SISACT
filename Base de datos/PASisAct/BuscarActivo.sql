SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <24/03/2013>
-- Description:	<Buscar activos>
-- =============================================
CREATE PROCEDURE BuscarActivo
	@Activo varchar(8) 
AS
BEGIN
	SELECT Descripcion,Utiliza_serial,Serial,Fecha_adquisicion,Referencia,Costo_adquisicion,Vida_util,Saldo_a_depreciar,Proveedor FROM Activos_Fijos WHERE Activo=@Activo
END
GO