function evaluar(obj,exp){
    //
    /*
    if(obj.value != "")
    {
        $(obj).next().attr("class","icon-checkmark");
    }
    else
        $(obj).next().attr("class","icon-close");   
    */
}
function evaluateToSend(){
    if(window.ImgPortada.files.length > 0 && window.Titulo.value != "" && window.Editorial.value != "" && window.Autor.value != "" && window.Idioma.value != "" && window.fechaDia.value != "0" && window.fechaMes.value != "0" && window.fechaAnio.value != "0" && window.Descripcion.value != "" && window.Precio.value != "")
        return true;
    return false;
}
function getForms(form){
    $.ajax({
        beforeSend:function(){
            $(".panel").html('<img width="40" id="loadingData" src="../public/imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
        },
        url:"./getForms/"+form,
        type:"post",
        data:{form:form},
        success:function(data){
            $(".panel").html(data);
        }
    });
}
function getTableRows(tabla) {
	$.ajax({
		beforeSend:function(){
			$(".panel").html('<img width="40" id="loadingData" src="../public/imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
		},
		url:"./getTableRows/"+tabla,
		type:"post",
		data:{tabla:tabla},
		success:function(data){
			$(".panel").html(data);
		}
	});
}
function saveBook(){
    if(evaluateToSend()){
        var formData = new FormData($("#formUploading")[0]);
        $.ajax({
            beforeSend:function(){
                $(".loadingData").css({"visibility":"visible"});
            },
            url:"../Productos/guardarLibro/",
            type:"post",
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data){
                $(".loadingData").css({"visibility":"hidden"});
                $(".panel").prepend(data);
                $("#formUploading")[0].reset();
            }
        });
    }
    else 
        alert("Rellene todos los campos");
}
function getExplorerFile(){
	$(".imgFile").click();
}
function UploadImg(tipo){
    if(window.FileReader){
        var formData = new FormData($("#formUploading")[0]);
        $.ajax({
            url: '../Productos/getBase64',  
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                if(tipo=="Perfil"){
                    $("#btnUploadImgPerfil").html("<img src='../public/imagenes/loading1.gif' style='margin-top:-20px;'>");     
                }
                else {
                    $("#btnUploadImg").html("<img src='../public/imagenes/loading1.gif' style='margin-top:-20px;'>");     
                }
            },
            //una vez finalizado correctamente
            success: function(data){
                    $("#imgPortada").attr("src","data:image/jpeg;base64,"+data);
                    $("#btnUploadImg").html("+");
                    $("#btnUploadImg").attr("class","color-transparent");


                    $("#imgPerfil").attr("src","data:image/jpeg;base64,"+data);
                    $("#btnUploadImgPerfil").html("+");
                    $("#btnUploadImgPerfil").attr("class","color-transparent");

            },
            //si ha ocurrido un error
            error: function(){
                alert("Error al subir la imagen");
            }
        });   
    }
    else {
        alert("Actualice a un navegador como Google chrome ó Mozilla Firefox");
    }
}
function UpdateUsers(){
    if(window.FileReader){
        var formData = new FormData($("#formUploading")[0]);
        $.ajax({
            url: '../cPanel/editarPerfil/',  
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                $(".loadingData").css({"visibility":"visible"});
            },
            //una vez finalizado correctamente
            success: function(data){
                getForms('Perfil');
                setTimeout(function(){
                    $(".panel").prepend(data);
                },100);
                $(".loadingData").css({"visibility":"hidden"});
            },
            //si ha ocurrido un error
            error: function(){
                alert("No es posible modificar los datos en este momento");
            }
        });   
    }
    else {
        alert("Actualice a un navegador como Google chrome ó Mozilla Firefox");
    }
}
function ChangePassword(){
    if(window.FileReader){
        var formData = new FormData($("#formUploading")[0]);
        $.ajax({
            url: '../cPanel/changePassword',  
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                $(".loadingData").css({"visibility":"visible"});
            },
            //una vez finalizado correctamente
            success: function(data){
                $(".panel").prepend(data);
                $(".loadingData").css({"visibility":"hidden"});
            },
            //si ha ocurrido un error
            error: function(){
                alert("No es posible modificar los datos en este momento");
            }
        });   
    }
    else {
        alert("Actualice a un navegador como Google chrome ó Mozilla Firefox");
    }
}
function signout() {
    $.ajax({
        beforeSend:function(){
        },
        url:"../Login/LogOut",
        type:"post",
        success:function(data){
            if(data==2)
                location.href="../";
            else
                alert("Respuesta: "+data);                              
        }
    });
}