SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <30/03/2013>
-- Description:	<Reubicar Activo>
-- =============================================
CREATE PROCEDURE Reubicar
	@Activo varchar(8),@Ubicacion varchar(8),@Fecha datetime,@PVez bit,@Periodo char(6)
AS
BEGIN
	SET NOCOUNT ON;

	INSERT INTO Activo_Ubicacion (Activo,Ubicacion,Fecha_ubicacion) VALUES
	(@Activo,@Ubicacion,@Fecha)
	
	IF(@PVez='1')
	BEGIN
		INSERT INTO Depreciaciones (Activo,Periodo,Monto_acumulado) VALUES (@Activo,@Periodo,'0')
		UPDATE Activos_Fijos SET Fecha_incorporacion=@Fecha WHERE Activo=@Activo
	END
END
GO
