SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <31/03/2013>
-- Description:	<Minimo Periodo>
-- =============================================
CREATE PROCEDURE MinimoPeriodo
AS
BEGIN
	SELECT MIN(Periodo) FROM Control_Periodo
END
GO
