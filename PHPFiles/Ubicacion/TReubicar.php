<?php
	function Reubicar(){
		$url = "'PHPFiles/Ubicacion/NReubicar.php'";
		$cont = "'contenedor'";
		$nulo = "''";
		$TColum = array(30,30,30);
		$Conexion = odbc_connect('SisAct2','sa','17316045');
		// Fecha de hoy
		$fecha = time()-16200;	
		$Hoy = "'".date('Y',$fecha).'/'.date('m',$fecha).'/'.date('d',$fecha)."'";
		// buscamos periodo mas antiguo
		$stmt = "EXEC MinimoPeriodo";
		$exito = odbc_exec($Conexion,$stmt);
		while(odbc_fetch_row($exito))
			$MinPer = odbc_result($exito,odbc_field_name($exito,'1'));
		$FAntigua = "'".$MinPer[0].$MinPer[1].$MinPer[2].$MinPer[3]."/".$MinPer[4].$MinPer[5]."/01'";
		// buscamos ubicacion de activos
		$stmt = "EXEC BuscarUbicacionActivos";
		$exito = odbc_exec($Conexion,$stmt);
		$Fields = odbc_num_fields($exito);
		print '<table border="0" width="100%" class="tablas" cellspacing="6" cellpadding="0"><tr>';
		// Titulo de columnas
		for ($i=1; $i<=$Fields; $i++){
			print("<th style='{color:white;}' bgcolor='#0064a2' width='".$TColum[($i-1)]."%'>".odbc_field_name($exito,$i)."</th>");
		}   
		print '<th colspan="2" style="{color:white;}" bgcolor="#0064a2" width="24%">Accion</th>';
		// Cuerpo de la tabla
		while(odbc_fetch_row($exito)){
			$FUbic = $FAntigua;
			print "</tr><tr>";
			printf("<td>%s</td>",odbc_result($exito,odbc_field_name($exito,'1')));
			if(odbc_result($exito,odbc_field_name($exito,'2'))!=NULL){
				$PVez = 0;
				printf("<td>%s</td>",odbc_result($exito,odbc_field_name($exito,'2')));
				$FUbic = odbc_result($exito,odbc_field_name($exito,'3'));
				list($Ano,$Mes,$Resto) = explode('-',$FUbic);
				list($Dia,$Resto) = explode(' ',$Resto);
				print'<td align="center">'.$Dia.'/'.$Mes.'/'.$Ano.'</td>';
				$Dia = $Dia+1;
				if($Dia<10)
					$Dia = '0'.$Dia;
				$FUbic = "'".$Ano.'-'.$Mes.'-'.$Dia."'";
			}
			else{
				print'<td align="center"></td><td align="center"></td>';
				$PVez = 1;
			}
			$parametros = "'activo=".odbc_result($exito,odbc_field_name($exito,'1'))."&pvez=".$PVez."'";
			if(odbc_result($exito,odbc_field_name($exito,'2'))!=NULL)
				print '<td align="center" width="10%"><input type="button" class="boton" value="Reubicar" style="{width:80px;}" onclick="EnvioGetConFecha('.$url.','.$parametros.','.$cont.','.$nulo.','.$FUbic.','.$Hoy.');"/></td>';
			else
				print '<td align="center" width="10%"><input type="button" class="boton" value="Ubicar" style="{width:80px;}" onclick="EnvioGetConFecha('.$url.','.$parametros.','.$cont.','.$nulo.','.$FUbic.','.$Hoy.');"/></td>';
		}
		print "</table>";
		odbc_close($Conexion);
	}
?>