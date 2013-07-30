<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$Activo = $_POST['activo'];   
	$periodo = $_POST['periodo']; // periodo abierto
	$pactivo = $_POST['pactivo']; // periodo activo
	$monto = $_POST['monto'];     // monto acumulado
	$PDelActivo = '';
	// periodo activo
	$Ano3 = $pactivo[0].$pactivo[1].$pactivo[2].$pactivo[3];
	$Mes3 = $pactivo[4].$pactivo[5];
	// Buscamos periodo del activo
	$stmt = "EXEC BuscarPeriodoDelActivo @Activo=$Activo";
	$exito = odbc_exec($Conexion,$stmt);
	while(odbc_fetch_row($exito))
		$PDelActivo = odbc_result($exito,odbc_field_name($exito,'1')); 
	// Buscamos fecha del activo	
	$stmt = "EXEC BuscarFechasActivos @Activo=$Activo";
	$exito = odbc_exec($Conexion,$stmt);
	while(odbc_fetch_row($exito)){
		$Costo = odbc_result($exito,odbc_field_name($exito,'1'));   // valor total
		$Saldo = odbc_result($exito,odbc_field_name($exito,'2'));   // depreciacion mensual
		$Incorp = odbc_result($exito,odbc_field_name($exito,'3'));  // fecha de incorporacion
	}
	// Fecha de incorporacion
	list($Ano,$Mes,$Resto) = explode('-',$Incorp);
	list($Dia,$Resto) = explode(' ',$Resto);
	if($PDelActivo!=''){
		$Ano = $PDelActivo[0].$PDelActivo[1].$PDelActivo[2].$PDelActivo[3];
		$Mes = $PDelActivo[4].$PDelActivo[5];
		$UltDepre =  $Ano.'-'.$Mes.'-'.$Dia;            // Fecha de ultima depreciacion basada en el periodo
	}
	else
		$UltDepre = $Ano.'-'.$Mes.'-'.$Dia;                // Fecha de ultima depreciacion basada en la F de incorp.
	// se busca cuantas veces falta por depreciar
	$ndep = $monto/$Saldo;
	$faltante = ($Costo/$Saldo)-$ndep;
	// se busca cantidad maxima de veces que se puede depreciar
	$fecha = time()-16200-86400; 	
	$Hoy = $periodo[0].$periodo[1].$periodo[2].$periodo[3].'-'.$periodo[4].$periodo[5].'-'.date("d",$fecha);
	$datetime1 = new DateTime($UltDepre);
	$datetime2 = new DateTime($Hoy);
	$intervalo = $datetime1->diff($datetime2);
	$años = $intervalo->format('%y');
	$meses = $intervalo->format('%m')+(($intervalo->format('%y'))*12); // meses de diferencia entre ultimo periodo depreciado y periodo vigente
	if($meses>=$faltante)
		$Veces = $faltante;
	else
		$Veces = $meses;
	$Situacion = '1';
	for($i=0;$i<$Veces;$i++){
		// aqui hago la acumulacion de saldo
		$monto = $monto+$Saldo;
		// Sumo 1 al periodo del activo
		if($Mes3=='12'){
			$Mes3='1';
			$Ano3=$Ano3+1;
		}
		else{
			$Mes3 = $Mes3+1;
		}
		if($Mes3<10)
			$Mes3 = '0'.$Mes3;
		$per = $Ano3.$Mes3;
		// averiguo si es el ultimo periodo a depreciar
		if(($monto-$Costo)==0){
			$PSCero = $per;
			$stmt = "EXEC PSaldoCero @Activo=$Activo,@PSCero=$PSCero";
			$exito = odbc_exec($Conexion,$stmt);
			$Situacion = '2';
		}
		else{
			if(($Costo-$monto)==$Saldo){
				$UPeriodo = $per;
				$stmt = "EXEC UltimoPeriodo @Activo=$Activo,@UPeriodo=$UPeriodo";
				$exito = odbc_exec($Conexion,$stmt);
			}
		}
		if($i==($Veces-1)){
			$stmt = "EXEC ActualizarDepreciacion @Activo=$Activo,@Periodo=$per,@MAcum=$monto";
			$exito = odbc_exec($Conexion,$stmt);
			$stmt = "EXEC ActualizarActivo @Activo=$Activo,@Situacion=$Situacion";
			$exito = odbc_exec($Conexion,$stmt);
		}
	}
	odbc_close($Conexion);
	include_once('TDepreciar.php');
	Depreciar();
?>