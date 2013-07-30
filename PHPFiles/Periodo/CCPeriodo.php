<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Periodo = "'".$_POST['periodo']."'";
	$stmt = "EXEC CerrarPeriodo @Periodo=$Periodo";
	$exito = odbc_exec($Conexion,$stmt);
	odbc_close($Conexion);
?>