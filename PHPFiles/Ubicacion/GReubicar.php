<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Activo = $_POST['activo'];
	$PVez = $_POST['pvez'];
	$Ubicacion = $_POST['ubicacion'];
	$Fecha = "'".$_POST['freu']."'";
	list($Dia,$Mes,$Resto) = explode('/',$Fecha);
	list($Ano,$Resto) = explode(' ',$Resto);
	$Periodo = $Ano.$Mes;
	$stmt = "EXEC Reubicar @Activo=$Activo,@Ubicacion=$Ubicacion,@Fecha=$Fecha,@PVez=$PVez,@Periodo=$Periodo";
	$exito = odbc_exec($Conexion,$stmt);
	odbc_close($Conexion);
	include_once('TReubicar.php');
	Reubicar();
?>