<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Activo = "'".$_POST['activo']."'";
	$Desc = "'".$_POST['desc']."'";
	$FAdq = "'".$_POST['fadq']."'";
	$Ref = "'".$_POST['ref']."'";
	$Costo = "'".$_POST['costo']."'";
	$Vida = "'".$_POST['vida']."'";
	$Deprecio = "'".$_POST['deprecio']."'";
	$Proveedor = "'".$_POST['proveedor']."'";
	$Serial = "'".$_POST['serial']."'";
	$NSerial = "'".$_POST['nserial']."'";
	$stmt = "EXEC EditarActivo @Activo=$Activo,@Descripcion=$Desc,@Serial=$Serial,@NSerial=$NSerial,@Fecha=$FAdq,@Referencia=$Ref,@Costo=$Costo,@Vida=$Vida,@Saldo=$Deprecio,@Proveedor=$Proveedor";
	$exito = odbc_exec($Conexion,$stmt);
	odbc_close($Conexion);
	include_once('TAFijos.php');
	TAFijos();
?>