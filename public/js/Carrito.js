$(function(){
	modifiCounterProducts();
});
function addToCar(obj,id,cantidad){
	if($(obj).attr("class") == "btnRemoveToCar") {
		$(obj).html("<span>+</span> Añadir al carrito");
		$(obj).attr("class","btnAddToCar");
		removeProduct(obj,id);
		animateCarrito();
	}
	else {
		$.ajax({
			beforeSend:function(){
				//$("#loadingData").css({"visibility":"visible"});
			},
			url:"Carrito/agregaCar",
			type:"post",
			data:{Id:id,Cantidad:1},
			success:function(data){
				$(obj).html("<span>-</span> Quitar del carrito");
				$(obj).attr("class","btnRemoveToCar");

				$("#loadingData").css({"visibility":"hidden"});
				$(".divVistaCarrito2").html(data);
				animateCarrito();	
				modifiCounterProducts();
			}
		});
	}
}
function removeProduct(obj,id) {
	$.ajax({
		beforeSend:function(){
			//$("#loadingData").css({"visibility":"visible"});
		},
		url:"Carrito/borrarCar",
		type:"post",
		data:{Id:id},
		success:function(data){
			$("#loadingData").css({"visibility":"hidden"});
			$(".divVistaCarrito2").html(data);
			$(".btnRemoveToCar").each(function(ind,obj){
				if($(obj).data("objetoproductoid")==id){
					$(obj).html("<span>+</span> Añadir al carrito");
					$(obj).attr("class","btnAddToCar");
				}
			});
			modifiCounterProducts();
		}
	});
}
function modifiCounterProducts(){
	if($(".divVistaCarrito2 table tr").length==0)
			$(".countProduct").html($(".divVistaCarrito2 table tr").length);							
		else 
			$(".countProduct").html($(".divVistaCarrito2 table tr").length-1);
}
function aumentarProducto(id,cant){
	$.ajax({
		beforeSend:function(){
			//$("#loadingData").css({"visibility":"visible"});
		},
		url:"Carrito/agregaCar",
		type:"post",
		data:{Id:id,Cantidad:cant+1},
		success:function(data){
			$("#loadingData").css({"visibility":"hidden"});
			$(".divVistaCarrito2").html(data);
		}
	});
}
function reducirProducto(id,cant){
	if(cant>1){
		$.ajax({
			beforeSend:function(){
				//$("#loadingData").css({"visibility":"visible"});
			},
			url:"Carrito/agregaCar",
			type:"post",
			data:{Id:id,Cantidad:cant-1},
			success:function(data){
				$("#loadingData").css({"visibility":"hidden"});
				$(".divVistaCarrito2").html(data);
			}
		});
	}
}
function animateCarrito(){
	$(".carrito").animate({"top":30},50);
	$(".carrito").animate({"top":10},50);
	$(".carrito").animate({"top":30},50);
	$(".carrito").animate({"top":10},50);
	$(".carrito").animate({"top":20},50);
}
function animateDivRequireSesion(){
	$(".divRequireSesion").animate({"margin-top":-80},50);
	$(".divRequireSesion").animate({"margin-top":-60},50);
	$(".divRequireSesion").animate({"margin-top":-80},50);
	$(".divRequireSesion").animate({"margin-top":-60},50);
	$(".divRequireSesion").animate({"margin-top":-70},50);
}
function focusLogin(){
	$(".divRequireSesion").remove();
	$("body").animate({"scrollTop":0},function(){
		$("aside").prepend("<div class='divRequireSesion'><div class='div1'>Es necesario iniciar sesion para hacer una compra</div><div class='trianguloRequireSesion'></div></div>");
		$("#loginEmail").focus();
		animateDivRequireSesion();
	});

}
function getFormPagoCompra() {
	$("body").prepend("<div class='ventanaEmergente'></div>");
	$(".ventanaEmergente").fadeIn();
	$.ajax({
		beforeSend:function(){
			$(".divVistaCarrito2").append('<img width="20" id="loadingData" src="public/imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
		},
		url:"Carrito/pagarCompra",
		type:"post",
		success:function(data){
			$("#loadingData").remove();
			$(".ventanaEmergente").html(data);
			$(".ventanaEmergente-contenido").animate({"margin-top":100},400);
		}
	});
}
function ventanaEmergente_Close(){
  $(".ventanaEmergente").fadeOut(function(){
    $(".ventanaEmergente").remove();
  });  
}
function EjecutarCompra() {
	if(evaluarPago()){
		$.ajax({
			beforeSend:function(){
				$(".ventanaEmergente-contenido .btnEjecutarCompra").after('<img width="20" id="loadingData" src="public/imagenes/loading.gif" style="margin-top:4px;margin-left:5px;visibility:visible;position:absolute;">');
			},
			url:"Carrito/guardarCompra",
			type:"post",
			data:{
				NombreSegunTargeta:$("#NombreSegunTargeta").val(),
				BancoEmisor:$("#BancoEmisor").val(),
				NumeroTargeta:$("#NumeroTargeta").val(),
				TipoTargeta:$("#TipoTargeta").val(),
				mesv:$("#venceMes").val(),
				aniov:$("#venceAnio").val()
			},
			success:function(data){
				$(".ventanaEmergente-contenido").html(data);
				setTimeout(function(){
					ventanaEmergente_Close();
					window.location="Productos";
				},6000);
			}
		});
	}
}
function evaluarPago() {
	var nombre = $("#NombreSegunTargeta");
	var banco = $("#BancoEmisor");
	var numero = $("#NumeroTargeta");
	var mes = $("#venceMes");
	var anio = $("#venceAnio");
	if(nombre.val().length <= 2){
		nombre.focus();
		return false;
	}
	if(banco.val().length <= 2){
		banco.focus();
		return false;
	}
	if(!EvaluarTarjeta(numero.val())){
		numero.focus();
		return false;
	}
	if(!VenceTJ(mes.val(),anio.val())){
		mes.focus();
		return false;
	}
	return true;
}
function EvaluarTarjeta(numero_tarjeta) {
	var cc = numero_tarjeta;
	var sumaPar=0;
	var sumaImpar=0;
	for(var i=0;i<cc.length;i++){
		if(i%2==0){
			if(parseInt(cc.substring(i,i+1))*2 > 9)
				sumaImpar+=parseInt(cc.substring(i,i+1))*2-9;
			else
				sumaImpar+=parseInt(cc.substring(i,i+1))*2;
		}
		else
			sumaPar+=parseInt(cc.substring(i,i+1));
	}
	var suma = sumaPar+sumaImpar;
	var MOD=suma%10;
	if(MOD==0)
		return true;
	else
		return false;
}
function VenceTJ(mes,anio) {
	var vmes = parseInt(mes);
	var vanio = parseInt(anio);
	var ahora = new Date();
	if ((vmes <= ahora.getMonth()+1) && (vanio<=ahora.getFullYear())){
		return false;
	} else {
		return true;
	}
}