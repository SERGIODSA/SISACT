<?php
	$Tipo = $_GET['opcion'];
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$TColum1 = array(10,10,30,12,18,20);
	$TColum2 = array(12,10,30,10,18,20);
	$TColum3 = array(30,10,12,10,18,20);
	$TAlign1 = array('left','center','right','right','right','right');
	$TAlign2 = array('left','center','right','right','right','right');
	$TAlign3 = array('left','center','right','right','right','right');
	$Titulo1 = array('Ubicacion','Activo','Descripcion','Proveedor','Costo adquisicion','Saldo sin depreciar');
	$Titulo2 = array('Proveedor','Activo','Descripcion','Ubicacion','Costo adquisicion','Saldo sin depreciar');
	$Titulo3 = array('Descripcion','Activo','Proveedor','Ubicacion','Costo adquisicion','Saldo sin depreciar');
	$stmt = "EXEC ReporteDetallado @Tipo=$Tipo";
	$exito = odbc_exec($Conexion,$stmt);
	$Fields = odbc_num_fields($exito);
	print '<table border="0" width="100%" class="tablas" cellspacing="6" cellpadding="0"><tr>';
	// Titulo de columnas
	for ($i=1; $i<=$Fields; $i++){
		switch ($Tipo){
			case '0':
				$T = $Titulo1[($i-1)];
				$C = $TColum1[($i-1)];
				break;
			case '1':
				$T = $Titulo2[($i-1)];
				$C = $TColum2[($i-1)];
				break;
			case '2':
				$T = $Titulo3[($i-1)];
				$C = $TColum3[($i-1)];
				break;
		}
		print "<th style='{color:white;}' bgcolor='#0064a2' width='".$C."%'>".$T."</th>";
	}   
	// Cuerpo de la tabla
	while(odbc_fetch_row($exito)){
		print "</tr><tr>";
		for($i=1; $i<=$Fields; $i++){
			$Resultado = odbc_result($exito,$i);
			switch ($Tipo){
				case '0':
					$A = $TAlign1[($i-1)];
					break;
				case '1':
					$A = $TAlign2[($i-1)];
					break;
				case '2':
					$A = $TAlign3[($i-1)];
					break;
			}
			if($i=='5')
				$Resultado = number_format($Resultado,2,',','.');
			if($i=='6')
				$Resultado = number_format($Resultado,2,',','.');
			printf("<td align='".$A."'>%s</td>",$Resultado);
		}
	}
	print "</table>";
	odbc_close($Conexion);
?> 