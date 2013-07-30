USE [SISACT]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <25/03/2013>
-- Description:	<Guardar Desincorporacion>
-- =============================================
CREATE PROCEDURE Desincorporar
	@Activo varchar(8),
	@Fdes datetime
AS
BEGIN
	SET NOCOUNT ON;
	
	SET DATEFORMAT dmy;

	UPDATE Activos_Fijos SET Fecha_desincorporacion=@Fdes,Situacion='3' WHERE Activo=@Activo
END