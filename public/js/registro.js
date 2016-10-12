function evaluar(obj)
{
	if(window.nombres.value =="")
		window.nombres.style.outline="1px solid red";
	else
		window.nombres.style.outline="1px solid #55DA52";
//////////////////////////////////////////////////////
	if(window.apellidos.value =="")
		window.apellidos.style.outline="1px solid red";
	else
		window.apellidos.style.outline="1px solid #55DA52";
//////////////////////////////////////////////////////
	if(window.Password.value =="")
		window.Password.style.outline="1px solid red";
	else
		window.Password.style.outline="1px solid #55DA52";

	if(window.password2.value =="" || window.password2.value != window.Password.value)
		window.password2.style.outline="1px solid red";
	else
		window.password2.style.outline="1px solid #55DA52";
///////////////////////////////////////////////////////////
	if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(window.Email.value))
		window.Email.style.outline="1px solid red";
	else
		window.Email.style.outline="1px solid #55DA52";
	//////////////////////////////////////////////////////
	if(window.fechaDia.value == "0")
		window.fechaDia.style.outline="1px solid red";
	else
		window.fechaDia.style.outline="1px solid #55DA52";
		//////////////////////////////////////////////////////
	if(window.fechaMes.value == "0")
		window.fechaMes.style.outline="1px solid red";
	else
		window.fechaMes.style.outline="1px solid #55DA52";
		//////////////////////////////////////////////////////
	if(window.fechaAnio.value == "0")
		window.fechaAnio.style.outline="1px solid red";
	else
		window.fechaAnio.style.outline="1px solid #55DA52";
///////////////////////////////////////////////////////////
	if(!/^\d{4}-\d{4}$/.test(telefono.value))
		window.telefono.style.outline="1px solid red";
	else
		window.telefono.style.outline="1px solid #55DA52";
///////////////////////////////////////////////////////////
if(window.direccion.value=="" && window.direccion.innerTEXT==undefined)
		window.direccion.style.outline="1px solid red";
	else
		window.direccion.style.outline="1px solid #55DA52";
///////////////////////////////////////////////////////////
if(!window.checkAcepta.checked)
window.checkAcepta.style.outline="1px solid red";
	else
		window.checkAcepta.style.outline="1px solid #55DA52";
}
function evaluarTelefono(){
	var numTel = window.telefono;
	if(numTel.value.length <= 8){
		if(/^\d{4}$/.test(numTel.value))
			numTel.value =numTel.value+"-";
	}
	else {
		event.preventDefault();
	}
}
function Registrar()
{
	if( (window.nombres.value =="") || (window.apellidos.value =="") ||  (window.Password.value =="") || (window.password2.value =="" || window.password2.value != window.Password.value) ||  !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(window.Email.value)) || window.fechaDia.value=="0" || window.fechaMes.value=="0" || window.fechaAnio.value=="0" || (!/^\d{4}-\d{4}$/.test(telefono.value)) || (window.direccion.value=="") || (!window.checkAcepta.checked) )
		alert("Complete los campos correctamente\nLos campos con borde rojo son incorrectos")
	else {
		$.ajax({
			beforeSend:function(){
				$("#loadingDataRegistro").css({"visibility":"visible"});
			},
			url:$("#formRegistro").attr("action"),
			type:$("#formRegistro").attr("method"),
			data:{nombres:window.nombres.value,
				apellidos:window.apellidos.value,
				password:window.Password.value,
				email:window.Email.value,
				fechaNacimiento:window.fechaAnio.value+"-"+window.fechaMes.value+"-"+window.fechaDia.value,
				telefono:window.telefono.value,
				direccion:window.direccion.value
			},
			success:function(data){
				setTimeout(function(){
					$("#loadingDataRegistro").css({"visibility":"hidden"});
					window.divRegistro.innerHTML="<div style='padding:20px;font-family:arial;background-color:#FAEAE6;border-left:3px solid #ED4E2A;''>El Registro está casi completo! Por favor chequea tu email y haz click en el enlace de activación de cuenta.</div>";

				},1000);			
			}
		});
	}
}