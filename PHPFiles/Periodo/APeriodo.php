<?php
	$url = "'PHPFiles/Periodo/GPeriodo.php'";
	$cont = "'contenedor'";
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	// buscamos periodo activo
	$stmt = "EXEC BuscarPeriodo";
	$AFijo = '';
	$c = 0;
	$exito = odbc_exec($Conexion,$stmt);
	$Fields = odbc_num_fields($exito);
	while(odbc_fetch_row($exito)){
		for($i=1; $i<=$Fields; $i++){
			$AFijo = odbc_result($exito,odbc_field_name($exito,$i));
		}
	}
	// si no existe buscamos el ultimo periodo
	if($AFijo==null){
		$stmt = "EXEC BuscarUltimoPeriodo";
		$exito = odbc_exec($Conexion,$stmt);
		$Fields = odbc_num_fields($exito);
		while(odbc_fetch_row($exito)){
			for($i=1; $i<=$Fields; $i++){
				$AFijo = odbc_result($exito,odbc_field_name($exito,$i));
			}
		}
		// si existe lo separamos en mes y año
		if($AFijo!=null){
			$Ano = $AFijo[0].$AFijo[1].$AFijo[2].$AFijo[3];
			$Mes = $AFijo[4].$AFijo[5];	
			$Periodo = $Mes.'/'.$Ano;
			if($Mes==12){
				$Ano = $Ano + 1;
				$Mes = '01';	
			}
			else{
				$Mes = $Mes + 1;
				if($Mes<10)
					$Mes = '0'.$Mes;
			}
			$NPeriodo = $Mes.'/'.$Ano;
			$NP = $Ano.$Mes;
		}
		// si no existe, es nulo
		else{
			$Periodo = '';
			$fecha = time()-16200; /* AQUI */	
			$NPeriodo = date('m',$fecha).'/'.date('Y',$fecha);
			$NP = date('Y',$fecha).date('m',$fecha);
		}
		$parametros = "'nperiodo=$NP'";
	}
	// Si hay un periodo vigente, lo separamos en mes y año
	else{
		$Ano = $AFijo[0].$AFijo[1].$AFijo[2].$AFijo[3];
		$Mes = $AFijo[4].$AFijo[5];
		$Periodo = $Mes.'/'.$Ano;
		$c = 1;
		$NPeriodo = '--';
	}
	odbc_close($Conexion);
		print'<div class="tablas">
		<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="8" cellpadding="0">
			<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Abrir Periodo</th></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td align="right">Ultimo Periodo&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$Periodo.'</td>
			</tr>
			<tr>
				<td align="right">Nuevo Periodo&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$NPeriodo.'</td>
			</tr>
			<tr>
				<td colspan="2">'; if($c==1) print'<span style="{font-size: 10px; color: #0162a7;}">*Debe cerrar el periodo vigente</span>'; print'</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2" align="center">'; 
					if($c==0) 
						print '<input type="submit" value="Abrir Periodo" class="boton" style="{width:120px;}" onClick="EnvioPost('.$url.','.$parametros.','.$cont.');"/>'; 
					else
						print '<input type="submit" value="Abrir Periodo" class="boton2" style="{width:120px;}"/>';
		print '</td>
			</tr>
		</div></table></form>
	</div>';
?>