<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Prov = $_POST['prov'];
	$Desc = $_POST['desc'];
	$stmt = odbc_prepare($Conexion,'{CALL InsertarProveedor(?,?)}');
	$exito = odbc_execute($stmt, array($Prov, $Desc));
	odbc_close($Conexion);
?>