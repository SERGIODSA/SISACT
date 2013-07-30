<?php
	$url = "'PHPFiles/Periodo/CCPeriodo.php'";
	$cont = "'contenedor'";
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	// buscamos periodo activo
	$stmt = "EXEC BuscarPeriodo";
	$AFijo = '';
	$Periodo = '';
	$c = 0;
	$d = 0;
	$e = 0;
	$fecha = time()-16200;
	$exito = odbc_exec($Conexion,$stmt);
	$Fields = odbc_num_fields($exito);
	while(odbc_fetch_row($exito)){
		for($i=1; $i<=$Fields; $i++){
			$AFijo = odbc_result($exito,odbc_field_name($exito,$i));
			$Ano2 = $AFijo[0].$AFijo[1].$AFijo[2].$AFijo[3];
			$Mes2 = $AFijo[4].$AFijo[5];	
			$Periodo = $Mes2.'/'.$Ano2;
			$c = 1;
		}
	}
	if($c==1){
		$stmt = "EXEC BuscarDepreciacion";
		$exito = odbc_exec($Conexion,$stmt);
		$Fields = odbc_num_fields($exito);
		while(odbc_fetch_row($exito)){
			$Incorp = odbc_result($exito,odbc_field_name($exito,'2'));
			$PActivo = odbc_result($exito,odbc_field_name($exito,'3'));		
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
			$Hoy = $Ano2.'-'.$Mes2.'-'.date("d",$fecha);
			$datetime1 = new DateTime($UltDepre);
			$datetime2 = new DateTime($Hoy);
			$intervalo = $datetime1->diff($datetime2);
			$años = $intervalo->format('%y');
			$meses = $intervalo->format('%m')+(($intervalo->format('%y'))*12); // meses de diferencia entre incorporacion y hoy
			// se busca cantidad de periodos
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
			if((($Veces-$meses)==0)||($DifPeriodo!=1))
				$d=1;
		}
	}
	$PPresente = date("Y",$fecha).date("m",$fecha);
	if($PPresente==$AFijo)
		$e=1;
	$parametros = "'periodo=$AFijo'";
	odbc_close($Conexion);
		print'<div class="tablas">
		<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="8" cellpadding="0">
		<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Cerrar Periodo</th></tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td align="right">Periodo Vigente&nbsp;&nbsp;</td>
			<td align="center" style="{font-weight:bold;}">'.$Periodo.'</td>
		</tr>
		<tr>
			<td colspan="2">'; 
				if($c==0) print'<span style="{font-size: 10px; color: #0162a7;}">*Debe abrir un nuevo periodo</span>'; 
				if($d==1) print'<span style="{font-size: 10px; color: #0162a7;}">*Debe realizar la depreciacion de los activos</span>';
				else if($e==1) print'<span style="{font-size: 10px; color: #0162a7;}">*El periodo vigente pertenece a la fecha actual</span>';
			print'</td>
		</tr>
		<tr><td colspan="2"><br></td></tr>
		<tr>
			<td colspan="2" align="center">'; 
				if(($d==0)&&($c==1)&&($e==0)) 
					print '<input type="submit" value="Cerrar Periodo" class="boton" style="{width:120px;}" onClick="EnvioPost('.$url.','.$parametros.','.$cont.');"/>'; 
				else
					print '<input type="submit" value="Cerrar Periodo" class="boton2" style="{width:120px;}"/>';
		print '</td>
		</tr>
		</div></table></form>
	</div>';
?>