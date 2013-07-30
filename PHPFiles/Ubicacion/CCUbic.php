<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Ubic = $_POST['ubic'];
	$Desc = $_POST['desc'];
	$stmt = odbc_prepare($Conexion,'{CALL InsertarUbicacion(?,?)}');
	$exito = odbc_execute($stmt, array($Ubic, $Desc));
	odbc_close($Conexion);
?>