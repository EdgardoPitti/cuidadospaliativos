$(document).ready(inicio)
function inicio(){
	$("#provincias").click(cargarDistritos);
	$("#distritos").click(cargarCorregimientos);
	$("#programas").click(cargarCategorias);
	$("#especialidad").click(cargarEspecialista);
	$("#filtro_visitas").click(cargarFiltroVisitas);
	$("#filtro_visitas1").click(cargarFiltroVisitas1);
	$("#filtro_visitas2").click(cargarFiltroVisitas2);
	$("#filtro_tipo").click(mostrarReferencia);
	$("#filtro_tipo1").click(mostrarReferencia);
	
}
function mostrarReferencia(){
	if (document.getElementById('filtro_tipo').checked == true) {
		document.getElementById('mostrar').style.display='block';
		document.getElementById('ocultar').style.display='none';
	}else{
		document.getElementById('mostrar').style.display='none';
		document.getElementById('ocultar').style.display='block';
	}
}
function cargarFiltroVisitas(){
	var f = $("#filtro_visitas").attr("value");
	var v = $("#var").attr("value");
	$.post("./mvc/vista/grafica_visita.php", {tipo:f,filtro:v},function(resultado){
		$("#mostrargrafica").html(resultado)
	});
}
function cargarFiltroVisitas1(){
	var f = $("#filtro_visitas1").attr("value");
	var v = $("#var").attr("value");
	$.post("./mvc/vista/grafica_visita.php", {tipo:f,filtro:v},function(resultado){
		$("#mostrargrafica").html(resultado)
	});
}function cargarFiltroVisitas2(){
	var f = $("#filtro_visitas2").attr("value");
	var v = $("#var").attr("value");
	$.post("./mvc/vista/grafica_visita.php", {tipo:f,filtro:v},function(resultado){
		$("#mostrargrafica").html(resultado)
	});
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