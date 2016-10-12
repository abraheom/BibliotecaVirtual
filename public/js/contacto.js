function evaluar(obj)
{
	if(window.Name.value.length =="")
		window.Name.style.outline="1px solid red";
	else
		window.Name.style.outline="1px solid #55DA52";

	if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(window.Email.value))
		window.Email.style.outline="1px solid red";
	else
		window.Email.style.outline="1px solid #55DA52";

	if(!/^\d{4}-\d{4}$/.test(telefono.value))
		window.telefono.style.outline="1px solid red";
	else
		window.telefono.style.outline="1px solid #55DA52";

	if(window.mensaje.value=="" && window.mensaje.innerTEXT==undefined)
		window.mensaje.style.outline="1px solid red";
	else
		window.mensaje.style.outline="1px solid #55DA52";
}
function evaluarTelefono(){
	var numTel = window.telefono;
	if(numTel.value.length <= 8){
		console.log("ok");
		if(/^\d{4}$/.test(numTel.value))
			numTel.value =numTel.value+"-";
	}
	else {
		event.preventDefault();
	}
}
function enviarMensaje()
{
	if( (window.Name.value != "") && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(window.Email.value)) && (window.telefono.value != "") && (window.mensaje.value != "" && /^\d{4}-\d{4}$/.test(telefono.value)) )
	{
		var formData = new FormData($("#formRegistro")[0]);
		$.ajax({
		    beforeSend:function(){
		        //$(".panel").html('<img width="40" id="loadingData" src="../imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
		    },
		    url:"Contacto/guardarMensaje",
		    type:"post",
		    data:formData,
		    cache: false,
		    contentType: false,
		    processData: false,
		    success:function(data){
				window.divRegistro.innerHTML="<div style='padding:20px;font-family:arial;background-color:#E5FFE0;border-left:3px solid #60D24F;'>Tu peticion ha sido enviada correctamente.<br><br>En pocos segundos estaras siendo redireccionado a la pagina principal...</div>";
		    }
		});
		setInterval(function(){
			location.href="index.php";
		},5000);
	}
	else 
		alert("Complete los campos correctamente\nLos campos con borde rojo son incorrectos")
}