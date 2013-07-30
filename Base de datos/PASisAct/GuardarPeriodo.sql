SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <28/03/2013>
-- Description:	<Guardar Periodo>
-- =============================================
CREATE PROCEDURE GuardarPeriodo 
	@Periodo char(6)
AS
BEGIN
	SET NOCOUNT ON;
	INSERT INTO Control_Periodo (Periodo,Vigente) VALUES (@Periodo,'1')
END
GO
