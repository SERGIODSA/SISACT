SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <29/03/2013>
-- Description:	<Actualizar Depreciacion>
-- =============================================
CREATE PROCEDURE ActualizarDepreciacion
	@Activo varchar(8),@Periodo char(6),@MAcum money
AS
BEGIN
	SET NOCOUNT ON;

    UPDATE Depreciaciones SET Periodo=@Periodo,Monto_acumulado=@MAcum WHERE Activo=@Activo
END
GO
