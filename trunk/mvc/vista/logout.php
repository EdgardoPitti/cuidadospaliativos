<?php
	include_once('./mvc/modelo/diseno.php');
	$ds = new Diseno();
	$_SESSION['idu'] = '';
	include_once('./mvc/vista/login.php');
?>