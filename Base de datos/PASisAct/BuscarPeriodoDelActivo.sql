SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <08/04/2013>
-- Description:	<Buscar periodo del activo>
-- =============================================
CREATE PROCEDURE BuscarPeriodoDelActivo 
	@Activo varchar(8)
AS
BEGIN
	SELECT MAX(Periodo) FROM Depreciaciones WHERE Activo=@Activo
END
GO
