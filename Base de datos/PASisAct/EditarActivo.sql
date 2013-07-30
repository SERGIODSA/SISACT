USE [SISACT]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <24/03/2013>
-- Description:	<Editar Activo>
-- =============================================
CREATE PROCEDURE EditarActivo
	@Activo varchar(8),
	@Descripcion varchar(60),
	@Serial bit, 
	@NSerial varchar(20),
	@Fecha datetime,
	@Referencia varchar(10),
	@Costo money,
	@Vida int,
	@Saldo money,
	@Proveedor varchar(8)
AS
BEGIN
	SET NOCOUNT ON;
	
	SET DATEFORMAT dmy;

	UPDATE Activos_Fijos SET Descripcion=@Descripcion,Utiliza_serial=@Serial,
	Serial=@NSerial,Fecha_adquisicion=@Fecha,Referencia=@Referencia,
	Costo_adquisicion=@Costo,Vida_util=@Vida,Saldo_a_depreciar=@Saldo,
	Proveedor=@Proveedor WHERE Activo=@Activo
END