$(function(){				
  $("#show1").click(function(){		
	$("#mostrar_ocultar1").toggle("1000");
	$("#mostrar_ocultar2").hide();
	$("#mostrar_ocultar3").hide();
	$("#mostrar_ocultar4").hide();
  });
   $("#show2").click(function(){
	$("#mostrar_ocultar2").toggle("1000");
	$("#mostrar_ocultar1").hide();
	$("#mostrar_ocultar3").hide();
	$("#mostrar_ocultar4").hide();
  });
   $("#show3").click(function(){
	$("#mostrar_ocultar3").toggle("1000");
	$("#mostrar_ocultar2").hide();
	$("#mostrar_ocultar1").hide();
	$("#mostrar_ocultar4").hide();
  });
   $("#show4").click(function(){
	$("#mostrar_ocultar4").toggle("1000");
	$("#mostrar_ocultar1").hide();
	$("#mostrar_ocultar3").hide();
	$("#mostrar_ocultar2").hide();
  });		
});