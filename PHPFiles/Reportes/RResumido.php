<?php
	$url = "'PHPFiles/Reportes/RRResumido.php'";
	$cont = "'resultado'";
	print '<div><form name="datos" onSubmit="return false"><table border="0" width="100%" class="tablas" cellspacing="6" cellpadding="0">
		<tr>
			<td align="center"><input type="radio" name="opcion" value="1">&nbsp;Ubicacion</td>
			<td align="center"><input type="radio" name="opcion" value="0">&nbsp;Proveedor</td>
			<td align="center"><input type="button" class="boton" value="Buscar" style="{width:80px;}" onclick="Reportes('.$url.','.$cont.')"/></td>
		</tr>
	</table></form></div><br>
	<div id="resultado"></div><br><br>';
?>