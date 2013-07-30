<?php
	function Depreciar(){
		$Conexion = odbc_connect('SisAct2','sa','17316045');
		$TColum = array(23,23,22,22);
		$url = "'PHPFiles/Depreciacion/Depreciar.php'";
		$cont = "'contenedor'";
		$Periodo = '';
		$stmt = "EXEC BuscarPeriodo";
		$exito = odbc_exec($Conexion,$stmt);
		while(odbc_fetch_row($exito)){
			$Periodo = odbc_result($exito,odbc_field_name($exito,'1'));
		}
		if($Periodo!=''){
			$stmt = "EXEC BuscarDepreciacion";
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
				$activo = odbc_result($exito,odbc_field_name($exito,'1'));
				$Incorp = odbc_result($exito,odbc_field_name($exito,'2'));
				$PActivo = odbc_result($exito,odbc_field_name($exito,'3'));
				$monto = odbc_result($exito,odbc_field_name($exito,'4'));
				$parametros = "'activo=$activo+&periodo=$Periodo+&monto=$monto+&pactivo=$PActivo'";
				
				// se busca cantidad maxima de veces que se puede depreciar
				list($Ano,$Mes,$Resto) = explode('-',$Incorp);
				list($Dia,$Resto) = explode(' ',$Resto);
				$FInc = $Dia.'/'.$Mes.'/'.$Ano;
				// Fecha de incorporacion
				if($PActivo!=''){
					$Ano = $PActivo[0].$PActivo[1].$PActivo[2].$PActivo[3];
					$Mes = $PActivo[4].$PActivo[5];
					$UltDepre = $Ano.'-'.$Mes.'-'.$Dia;            // Fecha de ultima depreciacion basada en el periodo
				}
				else
					$UltDepre = $Ano.'-'.$Mes.'-'.$Dia;                // Fecha de ultima depreciacion basada en la F de incorp.
				// Fecha del periodo activo
				$fecha = time()-16200-86400;
				$Hoy = $Periodo[0].$Periodo[1].$Periodo[2].$Periodo[3].'-'.$Periodo[4].$Periodo[5].'-'.date("d",$fecha);
				$datetime1 = new DateTime($UltDepre);
				$datetime2 = new DateTime($Hoy);
				$intervalo = $datetime1->diff($datetime2);
				$años = $intervalo->format('%y');
				$meses = $intervalo->format('%m')+(($intervalo->format('%y'))*12); // meses de diferencia entre incorporacion y hoy
				// se busca cantidad de periodos
				$Ano2 = $Periodo[0].$Periodo[1].$Periodo[2].$Periodo[3];
				$Mes2 = $Periodo[4].$Periodo[5];
				$n = $Ano2-$Ano;
				if($n==0)
					$Veces = $Mes2-$Mes;
				else
					$Veces = (12-$Mes)+($Mes2)+(($n-1)*12);
				// buscamos diferencia entre periodo actual y periodo del activo
				$Ano3 = $PActivo[0].$PActivo[1].$PActivo[2].$PActivo[3];
				$Mes3 = $PActivo[4].$PActivo[5];
				if($Ano2-$Ano3==0)
					$DifPeriodo = $Mes2-$Mes3;
				else
					$DifPeriodo = ((($Ano2-$Ano3)-1)*12)+($Mes2)+(12-$Mes3);
					
				// Verifico diferencia entre periodos y diferencia entre fecha de hoy y de incorporacion
				if((($Veces-$meses)==0)||($DifPeriodo!=1)){
					print "</tr><tr>";
					printf("<td>%s</td>",odbc_result($exito,odbc_field_name($exito,'1')));
					print'<td align="center">'.$FInc.'</td>';
					print '<td align="center">'.$Mes3.'/'.$Ano3.'</td>';
					$dinero = odbc_result($exito,odbc_field_name($exito,'4'));
					printf("<td align='right'>%s</td>",number_format($dinero,2,',','.'));
					print '<td align="center" width="10%"><input type="button" class="boton" value="Depreciar" onclick="EnvioPost('.$url.','.$parametros.','.$cont.');" style="{width:80px;}"/></td>';
				}
			}
			print "</table>";
		}
		else{
			print '<div align="center" class="formulario"><span style="{font-size: 14px; color: #0162a7; font-weight: bold;}" align="center">Debe abrir un nuevo periodo</span></div>';
		}
		odbc_close($Conexion);
	}
?>