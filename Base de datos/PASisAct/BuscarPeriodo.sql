SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <26/03/2013>
-- Description:	<Buscar Periodo>
-- =============================================
CREATE PROCEDURE BuscarPeriodo
AS
BEGIN
	SELECT Periodo FROM Control_Periodo WHERE Vigente='1'
END
GO
