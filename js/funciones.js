$(document).ready(inicio)


function inicio(){
	$("#provincias").change(cargarDistritos);
	$("#provinciasnacimiento").change(cargarDistritosnacimiento);
	$("#distritos").change(cargarCorregimientos);
	$("#distritosnacimiento").change(cargarCorregimientosnacimiento);
	$("#programas").change(cargarCategorias)
}
function cargarDistritos(){
	var p = $("#provincias").attr("value");
	$.post("./mvc/vista/domiciliaria_capturardatos_distritos.php",{idprovincia:p},function(resultado){
		$("#mostrardistritos").html(resultado)
	});	
	return false;
} 
function cargarDistritosnacimiento(){
	var p = $("#provinciasnacimiento").attr("value");
	$.post("./mvc/vista/domiciliaria_capturardatos_distritosnacimiento.php",{idprovincia:p},function(resultado){
		$("#mostrardistritosnacimiento").html(resultado)
	});	
	return false;
} 
function cargarCorregimientos(){
	var d = $("#distritos").attr("value");
	$.post("./mvc/vista/domiciliaria_capturardatos_corregimientos.php",{iddistrito:d},function(resultado){
		$("#mostrarcorregimientos").html(resultado)
	});
	return false;
}
function cargarCorregimientosnacimiento(){
	var d = $("#distritosnacimiento").attr("value");
	$.post("./mvc/vista/domiciliaria_capturardatos_corregimientosnacimiento.php",{iddistrito:d},function(resultado){
		$("#mostrarcorregimientosnacimiento").html(resultado)
	});
	return false;
}
function cargarCategorias(){
	var c = $("#programas").attr("value");
	$.post("./mvc/vista/domiciliaria_capturardatos_categorias.php",{categoria:c},function(resultado){
		$("#mostrarcategorias").html(resultado)
	});
	return false;
}