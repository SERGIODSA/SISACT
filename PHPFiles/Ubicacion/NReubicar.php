<?php
	include_once("Tiempo.php");
	$T = new Tiempo;
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$c = 0;
	$url = "'PHPFiles/Ubicacion/GReubicar.php'";
	$cont = "'contenedor'";
	$Ubic = "'%%'";
	$stmt = "EXEC BuscarUbicaciones @Ubicacion=$Ubic";
	$exito = odbc_exec($Conexion,$stmt);
	while(odbc_fetch_row($exito)){
		$Ubicacion[$c]=odbc_result($exito,odbc_field_name($exito,'1'));
		$c++;
	}
	print'<div class="tablas">
			<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="8" cellpadding="0">
				<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Reubicacion de Activo Fijo</th></tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td align="right">Activo&nbsp;&nbsp;</td>
					<td align="center" style="{font-weight:bold;}"><input type="hidden" name="activo" id="activo" value="'.$_GET['activo'].'"><input type="hidden" name="pvez" id="pvez" value="'.$_GET['pvez'].'">'.$_GET['activo'].'</td>
				</tr>
				<tr>
					<td colspan="2"><hr><br></td>
				</tr>
				<tr>
					<td align="right">Ubicacion&nbsp;&nbsp;</td>
					<td><select name="ubicacion" class="campos" id="ubicacion">'; 
					for($i=0;$i<$c;$i++){
						print '<option value="'.$Ubicacion[$i].'" style="{width: 80px;}">'.$Ubicacion[$i].'</option>';
					}
					print '</select>';
					if($c=='0')
						print '&nbsp;&nbsp;<span style="{font-size: 10px; color: #0162a7;}">*Debe agregar ubicaciones</span>';
					print '</td>
				</tr>
				<tr>
					<td align="right">Fecha de ubicacion&nbsp;&nbsp;</td>
					<td><input type="text" class="campos" name="fecha" id="fecha" align="center" readonly/></td>
				</tr>
				<tr>
					<td align="right">Hora de ubicacion&nbsp;&nbsp;</td>
					<td>'; $T->Hora('1','campos',''); print'&nbsp;:&nbsp;'; $T->Minuto('1','campos',''); print '</td>
				</tr>
				<tr><td colspan="2"><br></td></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Guardar" class="boton" style="{width:80px;}" onclick="Reubicar('.$url.','.$cont.');" /></td>
				</tr>
			</div></table></form>
		</div>';
?>