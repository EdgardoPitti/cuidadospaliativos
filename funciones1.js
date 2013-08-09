$(document).ready(inicio)


function inicio(){
	$("#provincias").change(cargarDistritos);
	$("#distritos").change(cargarCorregimientos);
}
function cargarDistritos(){
	var p = $("#provincias").attr("value");
	
	$.post("./mvc/vista/domiciliaria_capturardatos_distritos.php",{idprovincia:p},function(resultado){
		$("#mostrardistritos").html(resultado)
	});
	return false;
} 
function cargarCorregimientos(){

	var d = $("#distritos").attr("value");
	
	$.post("domiciliaria_capturardatos_corregimientos.php",{iddistrito:d},function(resultado){
		$("#mostrarcorregimientos").html(resultado)
	});
	return false;

}