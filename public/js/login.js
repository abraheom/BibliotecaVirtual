function keyPress(event){
	if(event.keyCode==13)
		Login();
}
function Login() {
	var email = document.getElementById('loginEmail');
	var pass = document.getElementById('loginPassword');
	if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(document.getElementById('loginEmail').value))
		alert("Este no parece ser un email real");
	else {
		if(pass.value == "")
			alert("No ha ingresado una contraseña");
		else
		{
			$.ajax({
				beforeSend:function(){
					$("#loginLogs").html('');
					$("#loadingData").css({"visibility":"visible"});
				},
				url:"Login/LogIn",
				type:"post",
				data:{funcion:"login",Email:email.value,Pass:pass.value},
				success:function(data){
					console.log(data);
					$("#loadingData").css({"visibility":"hidden"});
					if(data==2)
						window.location="Perfil";
					if(data==1)
						$("#loginLogs").html('La contraseña es incorrecta.');							
					if(data==0)
						$("#loginLogs").html('Esta cuenta no esta registrada.');								
				}
			});
		}
	}
}
function logout() {
	$.ajax({
		beforeSend:function(){
			$("#loadingData").css({"visibility":"visible"});
		},
		url:"Login/LogOut",
		type:"post",
		data:{funcion:"logout"},
		success:function(data){
			$("#loadingData").css({"visibility":"hidden"});
			if(data==2)
				location.reload();
			else
				alert("Respuesta: "+data);								
		}
	});
}