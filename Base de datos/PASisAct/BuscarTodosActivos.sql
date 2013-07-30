SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <24/03/2013>
-- Description:	<Buscar activos>
-- =============================================
CREATE PROCEDURE BuscarTodosActivos 
AS
BEGIN
	SELECT Activo,Descripcion,Fecha_adquisicion,Fecha_incorporacion,Situacion FROM Activos_Fijos WHERE Situacion!='3'
END
GO
