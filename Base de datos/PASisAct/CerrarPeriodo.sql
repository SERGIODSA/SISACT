SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <30/03/2013>
-- Description:	<Cerrar Periodo>
-- =============================================
CREATE PROCEDURE CerrarPeriodo
	@Periodo char(6)
AS
BEGIN
	SET NOCOUNT ON;

	UPDATE Control_Periodo SET Vigente='0' WHERE Periodo=@Periodo
END
GO
