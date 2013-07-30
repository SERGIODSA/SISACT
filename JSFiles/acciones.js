function Ajax(){
	var xmlhttp = false;
	try{
		xmlhttp = new ActiveXObject("Msxm12.XMLHTTP");
	}
	catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E){
			xmlhttp = false;
		}
	}
	if(!xmlhttp & typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function EnvioGet(url,parametros,contenedor){
	c = document.getElementById(contenedor);
	ajax = Ajax();
	if(parametros=='')
		ajax.open("GET",url); 
	else
		ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null);
}
function EnvioPost(url,parametros,contenedor){
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("POST",url,true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4) {
			c.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(parametros);
}
function EnvioGetConFecha(url,parametros,contenedor,fecha,min,max){
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				$("#fecha").datepicker({ 
					minDate: new Date(min),
					maxDate: new Date(max),
					dateFormat: 'dd/mm/yy'
				});
				if(fecha!='')
					$("#fecha").datepicker('setDate',fecha);
			});
		}
	}
	ajax.send(null);
}
function InsertProveedor(){
	prov = document.getElementById('prov').value;
	desc = document.getElementById('desc').value;
	var parametros = "prov="+prov+"&desc="+desc;
	EnvioPost('PHPFiles/Proveedor/CCProv.php',parametros,'contenedor');
}
function EditProveedor(){
	prov = document.getElementById('prov').value;
	desc = document.getElementById('desc').value;
	var parametros = "prov="+prov+"&desc="+desc;
	EnvioPost('PHPFiles/Proveedor/EEEProv.php',parametros,'contenedor');
}
function InsertUbicacion(){
	ubic = document.getElementById('ubic').value;
	desc = document.getElementById('desc').value;
	var parametros = "ubic="+ubic+"&desc="+desc;
	EnvioPost('PHPFiles/Ubicacion/CCUbic.php',parametros,'contenedor');
}
function EditUbicacion(){
	ubic = document.getElementById('ubic').value;
	desc = document.getElementById('desc').value;
	var parametros = "ubic="+ubic+"&desc="+desc;
	EnvioPost('PHPFiles/Ubicacion/EEEUbic.php',parametros,'contenedor');
}
function Serial(url,contenedor){
	var parametros = 'opt=0';
	if(document.datos.serial.checked)
		var parametros = 'opt=1';
	EnvioGet(url,parametros,contenedor);
}
function Saldo(url,contenedor){
	var costo = 0;
	var vida = 0;
	var deprecio = 0;
	if((document.getElementById('costo').value!='')&&(document.getElementById('vida').value!='')){
		costo = document.getElementById('costo').value;
		vida = document.getElementById('vida').value;
		deprecio = costo/vida;
	}
	var parametros = "deprecio="+deprecio;
	EnvioGet(url,parametros,contenedor);
}
function ValidarActivos(url,contenedor){
	var activo = document.getElementById('activo').value;
	var desc = document.getElementById('desc').value;
	var fadq = document.getElementById('fecha').value;
	var hadq = document.getElementById('hora1').value+':'+document.getElementById('minuto1').value;
	var ref = document.getElementById('referencia').value;
	var costo = document.getElementById('costo').value;
	var vida = document.getElementById('vida').value;
	var deprecio = document.getElementById('deprecio').value;
	var proveedor = document.getElementById('proveedor').value;
	if(document.datos.serial.checked){
		var serial = 1;
		var nserial = document.getElementById('nserial').value;
	}
	else{
		var serial = 0;
		var nserial = '';
	}
	if((activo=='')||(desc=='')||(fadq=='')||(hadq=='')||(ref=='')||(costo=='')||(vida=='')||(deprecio=='')||(proveedor=='')){
		alert('Debe llenar todos los campos');
	}
	else{
		if((!isNaN(costo))&&(!isNaN(vida))){
			var fadq = fadq+' '+hadq;
			var parametros = 'activo='+activo+'&desc='+desc+'&fadq='+fadq+'&ref='+ref+'&costo='+costo+'&vida='+vida+'&deprecio='+deprecio+'&proveedor='+proveedor+'&serial='+serial+'&nserial='+nserial;
			EnvioPost(url,parametros,contenedor);
		}
		else{
			if(isNaN(costo)&&isNaN(vida)){
				document.getElementById("val1").innerHTML="&nbsp;&nbsp;<span style='{font-size: 10px; color: #0162a7;}'>*Solo acepta numeros reales";
				document.getElementById("val2").innerHTML="&nbsp;&nbsp;<span style='{font-size: 10px; color: #0162a7;}'>*Solo acepta numeros enteros";
			}
			else{
				if(isNaN(costo)){
					document.getElementById("val1").innerHTML="&nbsp;&nbsp;<span style='{font-size: 10px; color: #0162a7;}'>*Solo acepta numeros reales";
					document.getElementById("val2").innerHTML="";
				}
				else{
					document.getElementById("val1").innerHTML="";
					document.getElementById("val2").innerHTML="&nbsp;&nbsp;<span style='{font-size: 10px; color: #0162a7;}'>*Solo acepta numeros enteros";
				}
			}
		}
	}
}
function Desincorporar(activo,url,contenedor){
	var fdes = document.getElementById('fecha').value;
	var hdes = document.getElementById('hora1').value+':'+document.getElementById('minuto1').value;
	fdes = fdes+' '+hdes;
	var parametros = 'activo='+activo+'&fdes='+fdes;
	EnvioPost(url,parametros,contenedor);
}
function Reubicar(url,contenedor){
	var freu = document.getElementById('fecha').value;
	var ubicacion = document.getElementById('ubicacion').value;
	if(ubicacion=='')
		alert('Debe seleccionar una ubicacion');
	else{
		if(freu=='')
			alert('Debe seleccionar la fecha');
		else{
			var activo = document.getElementById('activo').value;
			var pvez = document.getElementById('pvez').value;
			var ubicacion = document.getElementById('ubicacion').value;
			var hreu = document.getElementById('hora1').value+':'+document.getElementById('minuto1').value;
			freu = freu+' '+hreu;
			var parametros = 'activo='+activo+'&freu='+freu+'&ubicacion='+ubicacion+'&pvez='+pvez;
			EnvioPost(url,parametros,contenedor);
		}
	}
}
function Reportes(url,contenedor){
	var b = 0;
	for(i=0;i<document.datos.opcion.length;i++){
        if(document.datos.opcion[i].checked){
            var opcion = document.datos.opcion[i].value;
			b = 1;
			parametros = 'opcion='+opcion;
			EnvioGet(url,parametros,contenedor);
        }
    }	
	if(b == 0)
		alert('Debe seleccionar una opcion');
}