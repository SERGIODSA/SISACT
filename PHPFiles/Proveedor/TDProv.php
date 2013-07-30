<?php
	function TDesactProv(){
		$Conexion = odbc_connect('SisAct2','sa','17316045');
		$TColum = array(20,70);
		$url = "'PHPFiles/Proveedor/DDProv.php'";
		$contenedor = "'contenedor'";
		$Prov = "'%%'";
		$stmt = "EXEC BuscarProveedores @Proveedor=$Prov";
		$exito = odbc_exec($Conexion,$stmt);
		$Fields = odbc_num_fields($exito);
		print '<table border="0" width="100%" class="tablas" cellspacing="6" cellpadding="0"><tr>';
		// Titulo de columnas
		for ($i=1; $i<$Fields; $i++){
			print("<th style='{color:white;}' bgcolor='#0064a2' width='".$TColum[($i-1)]."%'>".odbc_field_name($exito,$i)."</th>");
		}   
		print "<th style='{color:white;}' bgcolor='#0064a2' width='10%'>Accion</th>";
		// Cuerpo de la tabla
		while(odbc_fetch_row($exito)){
			print "</tr><tr>";
			$parametros = "'";
			for($i=1; $i<$Fields; $i++){
				printf("<td>%s</td>",odbc_result($exito,$i));
				if($i==1)
					$parametros = $parametros.odbc_field_name($exito,$i)."=".odbc_result($exito,$i)."&".odbc_field_name($exito,'3')."=";
			}
			if(odbc_result($exito,$Fields)=='1'){
				$parametros = $parametros."0'";
				print '<td align="center"><input type="button" class="boton" value="Desactivar" onclick="EnvioPost('.$url.','.$parametros.','.$contenedor.')"/><td></tr>';
			}
			else{
				$parametros = $parametros."1'";
				print '<td align="center"><input type="button" class="boton" value="Activar" onclick="EnvioPost('.$url.','.$parametros.','.$contenedor.')"/><td></tr>';
			}
		}
		print "</table>";
		odbc_close($Conexion);
	}
?> 