<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Activo = "'".$_POST['activo']."'";
	$Fdes = "'".$_POST['fdes']."'";
	$stmt = "EXEC Desincorporar @Activo=$Activo,@Fdes=$Fdes";
	$exito = odbc_exec($Conexion,$stmt);
	odbc_close($Conexion);
	include_once('TAFijos.php');
	TAFijos();
?>