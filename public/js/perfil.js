function miscompras(){
	$.ajax({
		beforeSend:function(){
			console.log("espere");
			$(".panel").html('<img width="40" id="loadingData" src="../imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
		},
		url:"Perfil/listarCompras",
		type:"post",
		data:{tabla:"misCompras"},
		success:function(data){
			$(".misCompras").html(data);
		}
	});
}
function getExplorerFile(){
	$("#ImgPerfil").click();
}
function UploadImg(tipo){
    $("#btnSubmit").click();
}