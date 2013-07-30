
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <29/03/2013>
-- Description:	<Actualizar Periodo Saldo Cero>
-- =============================================
CREATE PROCEDURE PSaldoCero
	@Activo varchar(8),@PSCero char(6)
AS
BEGIN
	SET NOCOUNT ON;

	UPDATE Activos_Fijos SET Periodo_saldo_cero=@PSCero,Situacion='2' WHERE Activo=@Activo
END
GO
