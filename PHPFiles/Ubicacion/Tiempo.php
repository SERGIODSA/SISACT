<?php
class Tiempo{
	private $fecha;
	function __construct() {
		$this->fecha = time()-16200;
	}
	// los parametros son numero de id,clase css y el tiempo (nulo si no se carga hora o minuto de una BD)
	function Hora($num,$clase,$dato){		
		$hora = date('H',$this->fecha);
		print '<select name="hora" class="'.$clase.'" id="hora'.$num.'" style="{width: 40px;}">';
		for($h=0;$h<=23;$h++){
			if($h<10)
				$hh = "0" . $h;
			else
				$hh = $h;
			print "<option value='$hh'";
			if($dato==''){
				if($hora==$hh)
					print ' selected="selected">'.$hh.'</option>';
				else
					print '>'.$hh.'</option>';
			}
			else{
				if($dato==$hh)
					print ' selected="selected">'.$hh.'</option>';
				else
					print '>'.$hh.'</option>';
			}
		}
		print '</select>';
	}
	function Minuto($num,$clase,$dato){
		$minuto = date('i',$this->fecha);
		print '<select name="minuto" class="'.$clase.'" id="minuto'.$num.'" style="{width: 40px;}">';
		for($m=0;$m<=59;$m++){
			if($m<10)
				$mm = "0" . $m;
			else
				$mm = $m;
			print "<option value='$mm'";
			if($dato==''){
				if($minuto==$mm)
					print ' selected="selected">'.$mm.'</option>';
				else
					print '>'.$mm.'</option>';
			}
			else{
				if($dato==$mm)
					print ' selected="selected">'.$mm.'</option>';
				else
					print '>'.$mm.'</option>';
			}
		}
		print '</select>';
	}
}
?>