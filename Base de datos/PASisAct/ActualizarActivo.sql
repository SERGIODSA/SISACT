SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <29/03/2013>
-- Description:	<Actualizar Activo>
-- =============================================
CREATE PROCEDURE ActualizarActivo 
	@Activo varchar(8),@Situacion tinyint
AS
BEGIN
	SET NOCOUNT ON;

    UPDATE Activos_Fijos SET Situacion=@Situacion WHERE Activo=@Activo
END
GO