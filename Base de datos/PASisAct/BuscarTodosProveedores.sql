USE [SISACT]
GO
/****** Object:  StoredProcedure [dbo].[BuscarProveedores]    Script Date: 03/19/2013 16:54:03 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <19/03/2013>
-- Description:	<Buscar Proveedores>
-- =============================================
CREATE PROCEDURE BuscarTodosProveedores
AS 
BEGIN
	SELECT Proveedor FROM Proveedores WHERE Vigente='1'
END
