$('document').ready(function() {
	var palabra =""; // Término a buscar
   
/***** Búsquedas de Diagnósticos ******/
   
   // Evento al escribir sobre el cuadro de texto
   $("#diagnostico1").keypress(function() {
   	palabra = $("#diagnostico1").val(); // Completa la palabra
   });
   // Tan pronto se empieza a escribir en el cuadro de texto, se
   // dispara el evento de autocompletar que hace la consulta al
   // archivo listaCIE10.php con el término a buscar. En el 
   // archivo listaCIE10.php, se hace la consulta y se regresan 
   // las coincidencias de la palabra, completando el texto con
   // una lista de sugerencias. Igualmente, se reciben, los ID's
   // que coinciden con los términos buscados.
   $("#diagnostico1").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
   	matchContains: true,
   	mustMatch: true,
      selectFirst: false
   });
   // Con base en el valor del término que se ha seleccionado en 
   // la lista de sugerencias, se pasa a los campos txtAfecciones_val
   // y txtCIE, el valor del ID del termino seleccionado, que es el 
   // código CIE10 asignado.
   $("#diagnostico1").result(function(event, data, formatted) {
   	$("#cie1").val(data[1]); 
   });                   

	////////////////////////////////////////						
	$("#diagnostico2").keypress(function() {
   	palabra = $("#diagnostico2").val(); // Completa la palabra
   });
	$("#diagnostico2").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
   	matchContains: true,
      mustMatch: true,
      selectFirst: false
   });
   $("#diagnostico2").result(function(event, data, formatted) {
   	$("#cie2").val(data[1]); 
   });

////////////////////////////////////////						
	$("#diagnostico3").keypress(function() {
   	palabra = $("#diagnostico3").val(); // Completa la palabra
   });
   $("#diagnostico3").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
   	matchContains: true,
      mustMatch: true,
      selectFirst: false
   });
   $("#diagnostico3").result(function(event, data, formatted) {
		$("#cie3").val(data[1]); 
	}); 

////////////////////////////////////////						
	$("#diagnostico4").keypress(function() {
		palabra = $("#diagnostico4").val(); // Completa la palabra
	});
	$("#diagnostico4").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
   $("#diagnostico4").result(function(event, data, formatted) {
		$("#cie4").val(data[1]); 
	});
                    
 ////////////////////////////////////////						         
	$("#diagnostico5").keypress(function() {
		palabra = $("#diagnostico5").val(); // Completa la palabra
	});
	$("#diagnostico5").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#diagnostico5").result(function(event, data, formatted) {
		$("#cie5").val(data[1]); 
	}); 
                    
///////////////////////////////                    
	$("#diagnostico6").keypress(function() {
		palabra = $("#diagnostico6").val(); // Completa la palabra
	});
	$("#diagnostico6").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#diagnostico6").result(function(event, data, formatted) {
		$("#cie6").val(data[1]); 
	});    
                    
/////////////////////////
	$("#diagnostico7").keypress(function() {
		palabra = $("#diagnostico7").val(); // Completa la palabra
	});
	$("#diagnostico7").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#diagnostico7").result(function(event, data, formatted) {
		$("#cie7").val(data[1]); 
	});   

/////////////////////////////////
	$("#diagnostico8").keypress(function() {
		palabra = $("#diagnostico8").val(); // Completa la palabra
	});
	$("#diagnostico8").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#diagnostico8").result(function(event, data, formatted) { 
		$("#cie8").val(data[1]); 
	});  

////////////////////////////						
	$("#diagnosticorespuesta").keypress(function() {
		palabra = $("#diagnosticorespuesta").val(); // Completa la palabra
	});
	$("#diagnosticorespuesta").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#diagnosticorespuesta").result(function(event, data, formatted) {
		$("#cierespuesta").val(data[1]); 
	});
                    
                    
/////////////////////////////////                    
	$("#diagnostico").keypress(function() {
		palabra = $("#diagnostico").val(); // Completa la palabra
	});
	$("#diagnosticorespuesta").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#diagnostico").result(function(event, data, formatted) {
		$("#cie").val(data[1]); 
	});  

//////////////////////////////////
	$("#diagnostico").keypress(function() {
		palabra = $("#diagnostico").val(); // Completa la palabra
	});
   $("#diagnostico").autocomplete("./mvc/vista/listaCIE10.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
   }); 
	$("#diagnostico").result(function(event, data, formatted) {
   	$("#cie10").val(data[1]); 
	});   

/**** Fin de Búsqueda de Diagnósticos ****/

/******** Busquedas de Profesionales ********/
	
///////////////////////////////////
	$("#buscar_profesional").keypress(function() {
		palabra = $("#profesional").val(); // Completa la palabra
	});
	$("#buscar_profesional").autocomplete("./mvc/vista/buscar_personal.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false				
	});  
	$("#buscar_profesional").result(function(event, data, formatted) {
		$("#buscar_profesional").val(data[1]);
	});

// Evento al escribir sobre el cuadro de texto
	$("#profesional").keypress(function() {
		palabra = $("#profesional").val(); // Completa la palabra
	});
	$("#profesional").autocomplete("./mvc/vista/buscar_personal.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});  
	$("#profesional").result(function(event, data, formatted) {
		console.log(data);
		$("#cedprofesional").val(data[1]);
	});

// Evento al escribir sobre el cuadro de texto
	$("#profesional2").keypress(function() {
		palabra = $("#profesional2").val(); // Completa la palabra
	});
	$("#profesional2").autocomplete("./mvc/vista/buscar_personal.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});  
	$("#profesional2").result(function(event, data, formatted) {
		$("#cedprofesional2").val(data[1]); 
	});

// Evento al escribir sobre el cuadro de texto
	$("#profesional3").keypress(function() {
		palabra = $("#profesional3").val(); // Completa la palabra
	});
	$("#profesional3").autocomplete("./mvc/vista/buscar_personal.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});  
	$("#profesional3").result(function(event, data, formatted) {
		$("#cedprofesional3").val(data[1]);
	});
				
/***** Fin de Búsquedas de profesional ****/				
						
            
 /****** Búsquedas de pacientes *********/
// Evento al escribir sobre el cuadro de texto
   $("#busqueda").keypress(function() {
		palabra = $("#busqueda").val(); // Completa la palabra
	});
	$("#busqueda").autocomplete("./mvc/vista/buscar_pacientes.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#busqueda").result(function(event, data, formatted) {
		$("#busqueda").val(data[1]); 
	});
 // Evento al escribir sobre el cuadro de texto
	$("#paciente").keypress(function() {
		palabra = $("#paciente").val(); // Completa la palabra
	});
   $("#paciente").autocomplete("./mvc/vista/buscar_pacientes.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#paciente").result(function(event, data, formatted) {
		$("#cedpaciente").val(data[1]); 
	}); 
	
/***** Fin de Búsquedas de pacientes ****/

			
/****** Búsqueda de medicamentos *********/	
// Evento al escribir sobre el cuadro de texto
	$("#medicamentos").keypress(function() {
		palabra = $("#medicamentos").val(); // Completa la palabra
	});
	$("#medicamentos").autocomplete("./mvc/vista/buscar_medicamento.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#medicamentos").result(function(event, data, formatted) {
   	$("#medicamentos").val(data[0]); 
		$("#idmedicamentos").val(data[1]);
	}); 
	
	
	// Evento al escribir sobre el cuadro de texto
	$("#medicamento").keypress(function() {
		palabra = $("#medicamento").val(); // Completa la palabra
	});
	$("#medicamento").autocomplete("./mvc/vista/buscar_medicamento.php"+palabra, {                        
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	$("#medicamento").result(function(event, data, formatted) {
   	$("#medicamento").val(data[0]); 
		$("#idmedicamento").val(data[1]);
	}); 
/***** Fin de Búsquedas de medicamentos ****/			                        
});            