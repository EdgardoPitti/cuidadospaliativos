$(document).ready(function(){
                                
	var consulta;
																	  
	 //hacemos focus al campo de b�squeda
	$("#buscar").focus();
																								
	//comprobamos si se pulsa una tecla
	$("#buscar").keyup(function(e){
								 
		  //obtenemos el texto introducido en el campo de b�squeda
		  consulta = $("#buscar").val();
																	   
		  //hace la b�squeda
																			  
		  $.ajax({
				type: "POST",
				url: "./mvc/vista/buscarpaciente.php",
				data: "b="+consulta,
				dataType: "html",
			   /* beforeSend: function(){
					  //imagen de carga
					  $("#resultado").html("<p align='center'><img src='ajax-loader.gif' /></p>");
				},*/
				error: function(){
					  alert("error petici�n ajax");
				},
				success: function(data){                                                    
					  $("#resultado").empty();
					  $("#resultado").append(data);
				}
		  });                                                           
	});                                                     
});
