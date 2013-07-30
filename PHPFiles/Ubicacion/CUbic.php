<?php
	print'<div class="tablas">
		<div align="center" class="formulario"><form name="datos" onSubmit="return false"><table cellspacing="6" cellpadding="0">
			<tr><th colspan="2" style="{color:white;}" bgcolor="#0064a2">Nueva Ubicacion</th></tr>
			<tr><td colspan="2"><br></td></tr>
			<tr>
				<td align="right">Ubicacion&nbsp;&nbsp;</td>
				<td><input type="text" name="ubicacion" id="ubic" maxlength="8" class="campos"/></td>
			</tr>
			<tr>
				<td align="right">Descripcion&nbsp;&nbsp;</td>
				<td><textarea name="descripcion" id="desc" maxlength="60" rows="2" cols="25" class="campos"></textarea></td>
			</tr>
			<tr><td colspan="2"><br><td></tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Registrar" class="boton" style="{width:80px;}" onClick="InsertUbicacion();"/></td>
			</tr>
		</div></table></form>
	</div>';
?>