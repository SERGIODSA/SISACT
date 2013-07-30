<?php
	$Conexion = odbc_connect('SisAct2','sa','17316045');
	$stmt = "EXEC MinimoPeriodo";
	$exito = odbc_exec($Conexion,$stmt);
	while(odbc_fetch_row($exito))
		$MinPer = odbc_result($exito,odbc_field_name($exito,'1'));
	$FAntigua = $MinPer[0].$MinPer[1].$MinPer[2].$MinPer[3]."/".$MinPer[4].$MinPer[5]."/01";
	odbc_close($Conexion);
	$fecha = time()-16200;	
	$Hoy = date('Y',$fecha).'/'.date('m',$fecha).'/'.date('d',$fecha);
?>
<html>
<head>
	<title>Sistema de activos</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script type="text/javascript" src="JSFiles/acciones.js"></script>
	<link rel="stylesheet" href="CSSFiles/Menu.css" type="text/css">
	<link type="text/css" href="jquery-ui-1.10.2.custom/css/smoothness/jquery-ui-1.10.2.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="jquery-ui-1.10.2.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.js"></script>
	<script type="text/javascript" src="jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js"></script>
</head>
<body>
	<div class="logo">
		<img src="Imagenes/SisAct.jpg">
	</div>
	<div class="barra">
		<div class="menu">
			<ul class="nav">
				<li><a href="">Tablas<span class="flecha">&#9660;</span></a>
					<ul>
						<li><a href="">Proveedores<span class="flecha">&#9660;</span></a>
							<ul>
								<li><a onclick="EnvioGet('PHPFiles/Proveedor/CProv.php','','contenedor');">Agregar<span class="flecha">&#9660;</span></a></li>
								<li><a onclick="EnvioGet('PHPFiles/Proveedor/EProv.php','','contenedor');">Modificar<span class="flecha">&#9660;</span></a></li>
								<li><a onclick="EnvioGet('PHPFiles/Proveedor/DProv.php','','contenedor');">Desactivar<span class="flecha">&#9660;</span></a></li>
							</ul>
						</li>
						<li><a href="">Ubicaciones<span class="flecha">&#9660;</span></a>
							<ul>
								<li><a onclick="EnvioGet('PHPFiles/Ubicacion/CUbic.php','','contenedor');">Agregar<span class="flecha">&#9660;</span></a></li>
								<li><a onclick="EnvioGet('PHPFiles/Ubicacion/EUbic.php','','contenedor');">Modificar<span class="flecha">&#9660;</span></a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="">Procesos<span class="flecha">&#9660;</span></a>
					<ul>
						<li><a href="">Activos Fijos<span class="flecha">&#9660;</span></a>
							<ul>
								<li><a onclick="EnvioGetConFecha('PHPFiles/Activos Fijos/CAFijos.php','','contenedor','','<?php print $FAntigua ?>','<?php print $Hoy ?>');">Agregar<span class="flecha">&#9660;</span></a></li>
								<li><a onclick="EnvioGet('PHPFiles/Activos Fijos/EAFijos.php','','contenedor');">Modificar<span class="flecha">&#9660;</span></a></li>
							</ul>
						</li>
						<li><a onclick="EnvioGet('PHPFiles/Depreciacion/CDepreciar.php','','contenedor');">Depreciacion<span class="flecha">&#9660;</span></a></li>
						<li><a onclick="EnvioGet('PHPFiles/Periodo/APeriodo.php','','contenedor');">Abrir Periodo<span class="flecha">&#9660;</span></a></li>
						<li><a onclick="EnvioGet('PHPFiles/Periodo/CPeriodo.php','','contenedor');">Cerrar Periodo<span class="flecha">&#9660;</span></a></li>
						<li><a onclick="EnvioGet('PHPFiles/Ubicacion/Reubicar.php','','contenedor');">Reubicacion Activo<span class="flecha">&#9660;</span></a></li>
					</ul>
				</li>
				<li><a href="">Reportes<span class="flecha">&#9660;</span></a>
					<ul>
						<li><a onclick="EnvioGet('PHPFiles/Reportes/RResumido.php','','contenedor');">Informe resumido de activos<span class="flecha">&#9660;</span></a></li>
						<li><a onclick="EnvioGet('PHPFiles/Reportes/RDetallado.php','','contenedor');">Informe detallado de activos<span class="flecha">&#9660;</span></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div id="contenedor">
	</div>
</body>
</html>