var x=$(document).ready(load);
var nom,regimenconfirmacion,chain,chain2;
	
function llamada_ajax(op){
	// alert(chain);
	// alert(chain2);
	// alert(op);
	if(op=="editar" || op=="eliminar"){
		var id=y.id;
	}else{
		var id="";
	}
	$.ajax({
           async:true,
           type: "POST",
           dataType: "html",
           contentType: "application/x-www-form-urlencoded",
           url:"?ajax=c_TipoHoras_agregar_proceso&accion="+op+"&id="+id,
           data:{"chain":JSON.stringify(chain),"chain2":JSON.stringify(chain2)},
           
           beforeSend:cargando,

           success:llegada,
           timeout:4000,
           error:problemas
         }); 

  return false;
}
function cargando(){}
function llegada(datos){
	// alert(datos);
	if(datos=='true'){
		alert("Se guardo con exito"); 
		window.location='http://auwi.mx/auwi_pruebas/v5/?modulo=c_TipoHoras'; 
	// borrar_datos();
	}else{
		// alert(datos);
		alert("Problemas al guardar");
		window.location='http://auwi.mx/auwi_pruebas/v5/?modulo=c_TipoHoras';
		}
}
function problemas(){
	alert("¡Tiempo excedido!");
	window.location='http://auwi.mx/auwi_pruebas/v5/?modulo=c_TipoHoras';
}
function borrar_datos(){
	$("#nom").val('');
	$("#regimen").val('');

}
function tomar_datos(){
	chain=$("#nom").val();
	chain2=$("#regimen").val();

}



function botones(){

	$("#b3").click(function(){window.location='http://auwi.mx/auwi_pruebas/v5/?modulo=c_TipoHoras';});

	$(".btnAction").click(function(){
		var Accion=$(this).attr('id');

		if(Accion=="borrar"){
				confirmacion=confirm("¿Esta seguro de eliminar este registro?");
			if(confirmacion==true){
				tomar_datos();
				llamada_ajax(Accion);
			}else{}
		}else{
					tomar_datos();
					llamada_ajax(Accion);
		}

	});
}
function getGET(){
   var loc = document.location.href;
   var getString = loc.split('?')[1];
   var GET = getString.split('&');
   var get = {};//this object will be filled with the key-value pairs and returned.

   for(var i = 0, l = GET.length; i < l; i++){
      var tmp = GET[i].split('=');
      get[tmp[0]] = unescape(decodeURI(tmp[1]));
   }
   return get;
}
function load(){
	y=getGET();
	botones();
}