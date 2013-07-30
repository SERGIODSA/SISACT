SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <28/03/2013>
-- Description:	<Buscar Periodo>
-- =============================================
CREATE PROCEDURE BuscarUltimoPeriodo
AS
BEGIN
	SELECT Periodo FROM Control_Periodo WHERE Vigente='0'
END
GO