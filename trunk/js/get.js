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
  var actionPage = './?url=editreceta&idsoap='+parametros.idsoap+'&id='+parametros.id+'&idimp='+parametros.impresion+'&t='+parametros.t+'&idc='+parametros.idc+'&idr='+parametros.idr;		   
	
  $.getJSON("./mvc/vista/get_medicamento.php",            
	  { receta: id }, 
	  function(data){
	    var newAction= actionPage + "&receta=" +id; 
							 		  					  
		 $("#form_receta").attr("action", newAction);			  	 
	    $('.idmedicamento').val(data.medicid);
	    $('.medicamento').val(data.medicamento);
	    $('.forma').val(data.forma);
	    $('.concentracion').val(data.concent);
	    $('.unidad').val(data.unidad);
	    $('.dosis').val(data.dosis);
	    $('.cant').val(data.cantidad);
	    $('.frec').val(data.frecuencia);
	    $('.via').val(data.via);
	    $('.tratamiento').val(data.frecuencia);
	    $('.periodo').val(data.periodo);
	    $('.indicacion').val(data.indicaciones);
  	});
}