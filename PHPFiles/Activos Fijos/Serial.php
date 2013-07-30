<?php
	$opt = $_GET['opt'];
	if($opt=='0')
		print '<input type="text" name="nserial" id="nserial" class="campos" maxlength="20" style={background-color:#E6E6E6;} readonly/>';
	else
		print '<input type="text" name="nserial" id="nserial" class="campos" maxlength="20"/>';
?>