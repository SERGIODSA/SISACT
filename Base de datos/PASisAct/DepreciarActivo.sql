USE [SISACT]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <28/03/2013>
-- Description:	<Depreciar Activo>
-- =============================================
CREATE PROCEDURE DepreciarActivo
	@Activo varchar(8),@Periodo char(6),@Ubicacion varchar(8),@FUbic datetime
AS
BEGIN
	SET NOCOUNT ON;

	INSERT INTO Depreciaciones (Activo,Periodo,Monto_acumulado) VALUES (@Activo,@Periodo,
	'0')
	INSERT INTO Activo_Ubicacion (Activo,Ubicacion,Fecha_ubicacion) VALUES (@Activo,
	@Ubicacion,@FUbic)
END
