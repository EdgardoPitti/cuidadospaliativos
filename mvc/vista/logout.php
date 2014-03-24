<?php	
	$_SESSION['idu'] = '';
	include_once('./mvc/vista/login.php');
	session_destroy();
?>
<SCRIPT LANGUAGE="javascript">location.href = "./";</SCRIPT>