<?php
	$Tipo = $_GET['opcion'];
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$TColum = array(25,25,25,25);
	$TAlign = array('left','center','right','right');
	$Titulo1 = array('Ubicacion','N&#176; Activos','Monto adquisicion','Saldo a depreciar');
	$Titulo2 = array('Proveedor','N&#176; Activos','Monto adquisicion','Saldo a depreciar');
	$stmt = "EXEC ResumenActivos @Tipo=$Tipo";
	$exito = odbc_exec($Conexion,$stmt);
	$Fields = odbc_num_fields($exito);
	print '<table border="0" width="100%" class="tablas" cellspacing="6" cellpadding="0"><tr>';
	// Titulo de columnas
	for ($i=1; $i<=$Fields; $i++){
		print "<th style='{color:white;}' bgcolor='#0064a2' width='".$TColum[($i-1)]."%'>";
		if($Tipo=='1')	
			print $Titulo1[($i-1)];
		else
			print $Titulo2[($i-1)];
		print "</th>";
	}   
	// Cuerpo de la tabla
	while(odbc_fetch_row($exito)){
		print "</tr><tr>";
		for($i=1; $i<=$Fields; $i++){
			$Resultado = odbc_result($exito,$i);
			if($i=='3')
				$Resultado = number_format($Resultado,2,',','.');
			if($i=='4')
				$Resultado = number_format($Resultado,2,',','.');
			printf("<td align='".$TAlign[($i-1)]."'>%s</td>",$Resultado);
		}
	}
	print "</table>";
	odbc_close($Conexion);
?> 