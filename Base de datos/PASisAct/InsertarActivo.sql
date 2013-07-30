SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Sergio Da Silva>
-- Create date: <23/03/2013>
-- Description:	<Insertar Activo>
-- =============================================
CREATE PROCEDURE InsertarActivo 
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

	INSERT INTO Activos_Fijos (Activo,Descripcion,Utiliza_serial,Serial,Fecha_adquisicion,
	Referencia,Costo_adquisicion,Vida_util,Saldo_a_depreciar,Proveedor,Situacion) 
	VALUES (@Activo,@Descripcion,@Serial,@NSerial,@Fecha,@Referencia,@Costo,@Vida,@Saldo,
	@Proveedor,'0');
END
GO
