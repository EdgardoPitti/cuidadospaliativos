function getVarsUrl(){
    var url= location.search.replace("?", "");
    var arrUrl = url.split("&");
    var urlObj={};   
    for(var i=0; i<arrUrl.length; i++){
        var x= arrUrl[i].split("=");
        urlObj[x[0]]=x[1]
    }
    return urlObj;
} 
function obtener(id){
 
  	  var parametros = getVarsUrl();		  		  				
  var actionPage = './?url=editreceta&idsoap='+parametros.idsoap+'&id='+parametros.id+'&t='+parametros.t+'&idc='+parametros.idc+'&idrecipe='+parametros.idrecipe;		   
	
  $.getJSON("./mvc/vista/get_medicamento.php",            
	  { receta: id }, 
	  function(data){
	    var newAction= actionPage + "&receta=" +id; 
							 		  					  
		 $("#form_receta").attr("action", newAction);			  	 
	    $('.idmedicamento').val(data.medicid);
	    $('.medicamento').val(data.medicamento);
	    $('.cant').val(data.cantidad);
	    $('.frec').val(data.frecuencia);
	    $('.via').val(data.via);
	    $('.tratamiento').val(data.tratamiento);
	    $('.periodo').val(data.periodo);
	    $('.indicacion').val(data.indicaciones);
  	});
}

function mostrar(btn){
	$.getJSON('./mvc/vista/get_rda.php',
		{rda: btn.id},
		function(data){
			$('#zona').html(data.zona);
			$('#paciente').html(data.paciente);
			$('#frecuencia').html(data.frecuencia);
			$('#tipo_atencion').html(data.tipo_atencion);
			$('#cie10').html(data.cie10);
			$('#prof_diag').html(data.prof_diag);
			$('#actividad').html(data.actividad);
			$('#prof_act').html(data.prof_act);
			$('#estado').html(data.estado);
			$('#referido').html(data.referido);
			$('#observacion').html(data.observacion);
		}
	);
}