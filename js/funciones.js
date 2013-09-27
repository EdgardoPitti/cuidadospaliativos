$(document).ready(inicio)
function inicio(){
	$("#provincias").click(cargarDistritos);
	$("#distritos").click(cargarCorregimientos);
	$("#distritos").click(cargarCorregimientos);
	$("#programas").click(cargarCategorias);
	$("#especialidad").click(cargarEspecialista);
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
function cargarEspecialista(){
	var e = $("#especialidad").attr("value");
	$.post("./mvc/vista/ambulatoria_atencionalpaciente_especialista.php",{idespecialidad:e},function(resultado){
		$("#mostrarespecialista").html(resultado)
	});
	return false;
}