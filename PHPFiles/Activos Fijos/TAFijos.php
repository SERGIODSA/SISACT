<?php
	function TAFijos(){
		$Conexion = odbc_connect('SisAct2','sa','17316045');
		$TColum = array(15,61);
		$url = "'PHPFiles/Activos Fijos/EEAFijos.php'";
		$url2 = "'PHPFiles/Activos Fijos/Desincorporar.php'";
		$contenedor = "'contenedor'";
		$nulo = "''";
		// fecha mas antigua
		$stmt = "EXEC MinimoPeriodo";
		$exito = odbc_exec($Conexion,$stmt);
		while(odbc_fetch_row($exito))
			$MinPer = odbc_result($exito,odbc_field_name($exito,'1'));
		$FAntigua = "'".$MinPer[0].$MinPer[1].$MinPer[2].$MinPer[3]."/".$MinPer[4].$MinPer[5]."/01'";
		// buscamos todos los activos
		$stmt = "EXEC BuscarTodosActivos";
		$exito = odbc_exec($Conexion,$stmt);
		$Fields = odbc_num_fields($exito);
		print '<table border="0" width="100%" class="tablas" cellspacing="6" cellpadding="0"><tr>';
		// Titulo de columnas
		for ($i=1; $i<($Fields-2); $i++){
			print("<th style='{color:white;}' bgcolor='#0064a2' width='".$TColum[($i-1)]."%'>".odbc_field_name($exito,$i)."</th>");
		}   
		print '<th colspan="2" style="{color:white;}" bgcolor="#0064a2" width="24%">Accion</th>';
		// Cuerpo de la tabla
		while(odbc_fetch_row($exito)){
			print "</tr><tr>";
			for($i=1; $i<=$Fields; $i++){
				if($i<($Fields-2))
					printf("<td>%s</td>",odbc_result($exito,$i));
				if($i=='1'){
					$parametros = "'".odbc_field_name($exito,$i)."=".odbc_result($exito,$i)."'";
					$parametros2 = "'".odbc_field_name($exito,$i)."=".odbc_result($exito,$i)."&";
				}
				if($i=='3'){
					$parametros2 = $parametros2.odbc_field_name($exito,$i)."=".odbc_result($exito,$i)."&";
					list($Fecha,$Tiempo) = explode(' ',odbc_result($exito,$i));
					list($Ano,$Mes,$Dia) = explode('-',$Fecha);
					$Fecha = "'".$Dia.'/'.$Mes.'/'.$Ano."'";
				}
				if($i=='4'){
					$parametros2 = $parametros2.odbc_field_name($exito,$i)."=".odbc_result($exito,$i)."'";
					$Finc = odbc_result($exito,$i);
				}
				if($i==$Fields)
					$Situacion = odbc_result($exito,$i);
			}
			$Fi = "''";
			if($Finc!=null){
				list($Fecha,$Tiempo) = explode(' ',$Finc);
				list($Ano,$Mes,$Dia) = explode('-',$Fecha);
				$Fi = "'".$Ano.'/'.$Mes.'/'.$Dia."'";
			}
			$fecha = time()-16200;	
			$Hoy = "'".date('Y',$fecha).'/'.date('m',$fecha).'/'.date('d',$fecha)."'";
			print '<td align="center" width="10%"><input type="button" class="boton" value="Modificar" style="{width:80px;}" onclick="EnvioGetConFecha('.$url.','.$parametros.','.$contenedor.','.$Fecha.','.$FAntigua.','.$Hoy.')"/></td>';
			if ($Finc!=null)
				print '<td align="center" width="14%"><input type="button" class="boton" value="Desincorporar" style="{width:110px;}" onclick="EnvioGetConFecha('.$url2.','.$parametros2.','.$contenedor.','.$nulo.','.$Fi.','.$Hoy.')"/></td></tr>';
			else
				print '<td align="center" width="14%"><input type="button" class="boton2" value="Desincorporar" style="{width:110px;}" /></td></tr>';
		}
		print "</table>";
		odbc_close($Conexion);
	}
?> 