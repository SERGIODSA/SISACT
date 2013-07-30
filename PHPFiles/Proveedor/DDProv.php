<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Prov = $_POST['Proveedor'];
	$Vig = $_POST['Vigente'];
	$stmt = odbc_prepare($Conexion,'{CALL DesactivarProveedor(?,?)}');
	$exito = odbc_execute($stmt, array($Prov, $Vig));
	odbc_close($Conexion);
	include_once('TDProv.php');
	TDesactProv();
?>