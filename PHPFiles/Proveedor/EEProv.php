<?php
	$url = "'PHPFiles/Proveedor/EProv.php'";
	$cont = "'contenedor'";
	$nulo = "''";
	print'<div class="tablas">
		<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="6" cellpadding="0">
			<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Edicion de proveedor</th></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td align="right">Proveedor&nbsp;&nbsp;</td>
				<td align="center" style="{font-weight:bold;}"><input type="hidden" name="proveedor" id="prov" value="'.$_GET['Proveedor'].'"/>'.$_GET['Proveedor'].'</td>
			</tr>
			<tr>
				<td colspan="2"><hr><br></td>
			</tr>
			<tr>
				<td align="right">Descripcion&nbsp;&nbsp;</td>
				<td><textarea name="descripcion" id="desc" maxlength="60" rows="2" cols="25">'.$_GET['Descripcion'].'</textarea></td>
			</tr>
			<tr><td colspan="2"><br><td></tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Atras" class="boton" style="{width:60px;}" onClick="EnvioGet('.$url.','.$nulo.','.$cont.');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Registrar" class="boton" style="{width:80px;}" onClick="EditProveedor();"/></td>
			</tr>
		</div></table></form>
	</div>';
?>