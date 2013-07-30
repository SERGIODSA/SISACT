SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <29/03/2013>
-- Description:	<Actualizar Ultimo Periodo>
-- =============================================
CREATE PROCEDURE UltimoPeriodo
	@Activo varchar(8),@UPeriodo char(6)
AS
BEGIN
	SET NOCOUNT ON;
	
	UPDATE Activos_Fijos SET Ultimo_periodo=@UPeriodo WHERE Activo=@Activo
END
GO
