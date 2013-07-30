<?php
	include_once("Tiempo.php");
	$T = new Tiempo;
	$url = "'PHPFiles/Activos Fijos/Serial.php'";
	$url2 = "'PHPFiles/Activos Fijos/Depreciar.php'";
	$url3 = "'PHPFiles/Activos Fijos/GAFijos.php'";
	$cont = "'ns'";
	$cont2 = "'saldo'";
	$cont3 = "'contenedor'";
	$Periodo = '';
	$c = 0;
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$stmt = "EXEC BuscarPeriodo";
	$exito = odbc_exec($Conexion,$stmt);
	while(odbc_fetch_row($exito))
		$Periodo = odbc_result($exito,odbc_field_name($exito,'1'));
	if($Periodo=='')
		print '<div align="center" class="formulario"><span style="{font-size: 14px; color: #0162a7; font-weight: bold;}" align="center">Debe abrir un nuevo periodo</span></div>';
	else{
		$stmt = "EXEC BuscarTodosProveedores";
		$exito = odbc_exec($Conexion,$stmt);
		while(odbc_fetch_row($exito)){
			$Proveedor[$c] = odbc_result($exito,odbc_field_name($exito,'1'));
			$c++;
		}
		print'<div class="tablas">
			<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="8" cellpadding="0">
				<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Nuevo Activo Fijo</th></tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td align="right">Activo&nbsp;&nbsp;</td>
					<td><input type="text" name="activo" id="activo" maxlength="8" class="campos"/></td>
				</tr>
				<tr>
					<td align="right">Descripcion&nbsp;&nbsp;</td>
					<td><textarea name="descripcion" id="desc" maxlength="60" rows="2" cols="25" class="campos"></textarea></td>
				</tr>
				<tr>
					<td align="right">Serial&nbsp;&nbsp;</td>
					<td><input type="checkbox" name="serial" id="serial" class="campos" onclick="Serial('.$url.','.$cont.');"/></td>
				</tr>
				<tr>
					<td align="right">N&#176; Serial&nbsp;&nbsp;</td>
					<td><span id="ns"><input type="text" name="nserial" id="nserial" class="campos" maxlength="20" style={background-color:#E6E6E6;} readonly/></span></td>
				</tr>
				<tr>
					<td align="right">Fecha de adquisicion&nbsp;&nbsp;</td>
					<td><input type="text" class="campos" name="fecha" id="fecha" align="center" readonly/></td>
				</tr>
				<tr>
					<td align="right">Hora de adquisicion&nbsp;&nbsp;</td>
					<td>'; $T->Hora('1','campos',''); print'&nbsp;:&nbsp;'; $T->Minuto('1','campos',''); print '</td>
				</tr>
				<tr>
					<td align="right">Referencia&nbsp;&nbsp;</td>
					<td><input type="text" class="campos" name="referencia" id="referencia" maxlength="10" align="center" /></td>
				</tr>
				<tr>
					<td align="right">Costo adquisicion&nbsp;&nbsp;</td>
					<td><input type="text" class="campos" name="costo" id="costo" maxlength="15" align="center" onkeyup="Saldo('.$url2.','.$cont2.');"/><span id="val1"></span></td>
				</tr>
				<tr>
					<td align="right">Vida util (meses)&nbsp;&nbsp;</td>
					<td><input type="text" class="campos" name="vida" id="vida" maxlength="3" align="center" onkeyup="Saldo('.$url2.','.$cont2.');"/><span id="val2"></span></td>
				</tr>
				<tr>
					<td align="right">Saldo a depreciar&nbsp;&nbsp;</td>
					<td><span id="saldo"><input type="text" class="campos" name="deprecio" id="deprecio" maxlength="15" align="center" style={background-color:#E6E6E6;} readonly/></span></td>
				</tr>
				<tr>
					<td align="right">Proveedor&nbsp;&nbsp;</td>
					<td><select name="proveedor" class="campos" id="proveedor">'; 
					for($i=0;$i<$c;$i++){
						print '<option value="'.$Proveedor[$i].'" style="{width: 80px;}">'.$Proveedor[$i].'</option>';
					}
					print '</select>';
					if($c=='0')
						print '&nbsp;&nbsp;<span style="{font-size: 10px; color: #0162a7;}">*Debe agregar proveedores</span>';
					print '</td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Registrar" class="boton" style="{width:80px;}" onClick="ValidarActivos('.$url3.','.$cont3.');"/></td>
				</tr>
			</div></table></form>
		</div>';
	}
	odbc_close($Conexion);
?>