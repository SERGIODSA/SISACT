<?php
	include_once("Tiempo.php");
	$T = new Tiempo;
	$url = "'PHPFiles/Activos Fijos/Serial.php'";
	$url2 = "'PHPFiles/Activos Fijos/Depreciar.php'";
	$url3 = "'PHPFiles/Activos Fijos/EEEAFijos.php'";
	$url4 = "'PHPFiles/Activos Fijos/EAFijos.php'";
	$cont = "'ns'";
	$cont2 = "'saldo'";
	$cont3 = "'contenedor'";
	$nulo = "''";
	$c = 0;
	$Activo = $_GET['Activo'];
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	// buscamos activos
	$stmt = "EXEC BuscarActivo @Activo=$Activo";
	$exito = odbc_exec($Conexion,$stmt);
	$Fields = odbc_num_fields($exito);
	while(odbc_fetch_row($exito)){
		for($i=1; $i<=$Fields; $i++){
			$AFijo[$i] = odbc_result($exito,odbc_field_name($exito,$i));
		}
	}
	// buscamos proveedores activos y el proveedor del activo
	$stmt = "EXEC CambiarProveedor @Proveedor=$AFijo[9]";
	$exito = odbc_exec($Conexion,$stmt);
	while(odbc_fetch_row($exito)){
		$Proveedor[$c] = odbc_result($exito,odbc_field_name($exito,'1'));
		$c++;
	}
	odbc_close($Conexion);
	// inicio
	if($AFijo[2]=='1')
		$AFijo[2]='checked';
	else
		$AFijo[2]='';
	list($Fecha,$Tiempo) = explode(' ',$AFijo[4]);
	list($Hora,$Minuto,$Resto) = explode(':',$Tiempo);
	print'<div class="tablas">
		<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="8" cellpadding="0">
			<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Edicion de Activo Fijo</th></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td align="right">Activo&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$Activo.'<input type="hidden" name="activo" id="activo" value="'.$Activo.'"/></td>
			</tr>
			<tr>
				<td colspan="2"><hr><br></td>
			</tr>
			<tr>
				<td align="right">Descripcion&nbsp;&nbsp;</td>
				<td><textarea name="descripcion" id="desc" maxlength="60" rows="2" cols="25" class="campos">'.$AFijo[1].'</textarea></td>
			</tr>
			<tr>
				<td align="right">Serial&nbsp;&nbsp;</td>
				<td><input type="checkbox" name="serial" id="serial" class="campos" onclick="Serial('.$url.','.$cont.');" '.$AFijo[2].'/></td>
			</tr>
			<tr>
				<td align="right">N&#176; Serial&nbsp;&nbsp;</td>
				<td><span id="ns">';
				if($AFijo[2]=='checked')
					print '<input type="text" name="nserial" id="nserial" class="campos" maxlength="20" value="'.$AFijo[3].'"/>';
				else
					print '<input type="text" name="nserial" id="nserial" class="campos" maxlength="20" style={background-color:#E6E6E6;} readonly/>';
				print '</span></td>
			</tr>
			<tr>
				<td align="right">Fecha de adquisicion&nbsp;&nbsp;</td>
				<td><input type="text" class="campos" name="fecha" id="fecha" align="center" readonly/></td>
			</tr>
			<tr>
				<td align="right">Hora de adquisicion&nbsp;&nbsp;</td>
				<td>'; $T->Hora('1','campos',$Hora); print'&nbsp;:&nbsp;'; $T->Minuto('1','campos',$Minuto); print '</td>
			</tr>
			<tr>
				<td align="right">Referencia&nbsp;&nbsp;</td>
				<td><input type="text" class="campos" name="referencia" id="referencia" maxlength="10" align="center" value="'.$AFijo[5].'" /></td>
			</tr>
			<tr>
				<td align="right">Costo adquisicion&nbsp;&nbsp;</td>
				<td><input type="text" class="campos" name="costo" id="costo" maxlength="15" align="center" value="'.$AFijo[6].'" onkeyup="Saldo('.$url2.','.$cont2.');"/><span id="val1"></span></td>
			</tr>
			<tr>
				<td align="right">Vida util (meses)&nbsp;&nbsp;</td>
				<td><input type="text" class="campos" name="vida" id="vida" maxlength="3" align="center" value="'.$AFijo[7].'" onkeyup="Saldo('.$url2.','.$cont2.');"/><span id="val2"></span></td>
			</tr>
			<tr>
				<td align="right">Saldo a depreciar&nbsp;&nbsp;</td>
				<td><span id="saldo"><input type="text" class="campos" name="deprecio" id="deprecio" maxlength="15" align="center" value="'.$AFijo[8].'" style={background-color:#E6E6E6;} readonly/></span></td>
			</tr>
			<tr>
				<td align="right">Proveedor&nbsp;&nbsp;</td>
				<td><select name="proveedor" class="campos" id="proveedor">'; 
				for($i=0;$i<$c;$i++){
					$Selecto = '';
					if(($Proveedor[$i])==$AFijo[9])
						$Selecto = 'selected';
					print '<option value="'.$Proveedor[$i].'" style="{width: 80px;}" '.$Selecto.'>'.$Proveedor[$i].'</option>';
				}
				print '</select>';
				if($c=='0')
					print '&nbsp;&nbsp;<span style="{font-size: 10px; color: #0162a7;}">*Debe agregar proveedores</span>';
				print '</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Atras" class="boton" style="{width:60px;}" onClick="EnvioGet('.$url4.','.$nulo.','.$cont3.');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Modificar" class="boton" style="{width:80px;}" onClick="ValidarActivos('.$url3.','.$cont3.');"/></td>
			</tr>
		</div></table></form>
	</div>';
?>