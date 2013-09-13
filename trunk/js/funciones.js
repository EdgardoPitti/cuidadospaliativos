$(document).ready(inicio)
function inicio(){
	$("#provincias").click(cargarDistritos);
	$("#distritos").click(cargarCorregimientos);
	$("#programas").click(cargarCategorias);
}
function cargarDistritos(){
	var p = $("#provincias").attr("value");
	$.post("./mvc/vista/capturardatos_distritos.php",{idprovincia:p},function(resultado){
		$("#mostrardistritos").html(resultado)
	});	
	return false;
} 
function cargarCorregimientos(){
	var d = $("#distritos").attr("value");
	$.post("./mvc/vista/capturardatos_corregimientos.php",{iddistrito:d},function(resultado){
		$("#mostrarcorregimientos").html(resultado)
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