<?php
	$Activo = $_GET['Activo'];
	$FAdq = $_GET['Fecha_adquisicion'];
	$FInc = $_GET['Fecha_incorporacion'];
	// Fecha de adquisicion
	list($Fecha,$Tiempo) = explode(' ',$FAdq);
	list($Ano,$Mes,$Dia) = explode('-',$Fecha);
	list($Hora,$Minuto,$Resto) = explode(':',$Tiempo);
	$FechaAdq = $Dia.'/'.$Mes.'/'.$Ano;
	$HoraAdq = $Hora.":".$Minuto;
	// Fecha de incorporacion
	list($Fecha,$Tiempo) = explode(' ',$FInc);
	list($Ano,$Mes,$Dia) = explode('-',$Fecha);
	list($Hora,$Minuto,$Resto) = explode(':',$Tiempo);
	$FechaInc = $Dia.'/'.$Mes.'/'.$Ano;
	$HoraInc = $Hora.":".$Minuto;
	// inicio
	include_once("Tiempo.php");
	$T = new Tiempo;
	$url = "'PHPFiles/Activos Fijos/GDesincorporar.php'";
	$url2 = "'PHPFiles/Activos Fijos/EAFijos.php'";
	$cont = "'contenedor'";
	$nulo = "''";
	$act = "'".$Activo."'";
	print'<div class="tablas">
		<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="8" cellpadding="0">
			<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Desincorporar Activo Fijo</th></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td align="right">Activo&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$Activo.'</td>
			</tr>
			<tr>
				<td align="right">Fecha de adquisicion&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$FechaAdq.'</td>
			</tr>
			<tr>
				<td align="right">Hora de adquisicion&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$HoraAdq.'</td>
			</tr>
			<tr>
				<td align="right">Fecha de incorporacion&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$FechaInc.'</td>
			</tr>
			<tr>
				<td align="right">Hora de incorporacion&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}">'.$HoraInc.'</td>
			</tr>
			<tr>
				<td colspan="2"><hr><br></td>
			</tr>
			<tr>
				<td align="right">Fecha de desincorporacion&nbsp;&nbsp;</td>
				<td><input type="text" class="campos" name="fecha" id="fecha" align="center" readonly/></td>
			</tr>
			<tr>
				<td align="right">Hora de desincorporacion&nbsp;&nbsp;</td>
				<td>'; $T->Hora('1','campos',''); print'&nbsp;:&nbsp;'; $T->Minuto('1','campos',''); print '</td>
			</tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Atras" class="boton" style="{width:60px;}" onClick="EnvioGet('.$url2.','.$nulo.','.$cont.');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Desincorporar" class="boton" style="{width:110px;}" onClick="Desincorporar('.$act.','.$url.','.$cont.');"/></td>
			</tr>
		</div></table></form>
	</div>';
?>