function expandDetails(obj,tabla,id) {
    $("body").prepend("<div class='ventanaEmergente'></div>");
    $(".ventanaEmergente").fadeIn();
	$.ajax({
        beforeSend:function(){
            $(".ventanaEmergente").html('<img width="40" id="loadingData" src="../imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
        },
        url:"../cPanel/getDetails/",
        type:"post",
        data:{"Tabla":tabla,"Id":id},
        success:function(data){
            $(".ventanaEmergente").html(data);
            $(".ventanaEmergente-contenido").animate({"margin-top":"7%"},700);
        }
    });
}
function editRows(obj,tabla,id) {  
    $("body").prepend("<div class='ventanaEmergente'></div>");
    $(".ventanaEmergente").fadeIn();
    $.ajax({
        beforeSend:function(){
            $(".ventanaEmergente").html('<img width="40" id="loadingData" src="../public/imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
        },
        url:"../cPanel/editRows/",
        type:"post",
        data:{"Tabla":tabla,"Id":id},
        success:function(data){
            $(".ventanaEmergente").html(data);
            $(".ventanaEmergente-contenido").animate({"margin-top":"3%"},700);
        }
    });
}
//Borrar Registro
function deleteUser(obj,tabla,id) {
    $("body").prepend("<div class='ventanaEmergente'><div class='ventanaEmergente-contenido' align='center'>Eliminar "+tabla+"<label class='ventanaEmergente-btnClose' onclick='ventanaEmergente_Close()'>x</label><hr size='0'><div><p>¿Seguro que desea eliminar a <b>"+$(obj).parent().parent().children().next().next().html()+"</b>?</p></div><div class='ventanaEmergente-botones' align='right'><input type='button' value='Cancelar' onclick='ventanaEmergente_Close()'><input type='button' value='Eliminar' onclick='EliminarRegistro(\""+tabla+"\","+id+")'></div></div></div>");
    $(".ventanaEmergente").fadeIn();
    $(".ventanaEmergente-contenido").animate({"margin-top":"7%"},700);
}
function EliminarRegistro(tabla,id){
    $.ajax({
        beforeSend:function(){
            $(".ventanaEmergente-contenido").html('<img width="40" id="loadingData" src="../public/imagenes/loading.gif" style="display:block;margin:auto;visibility:visible;">');
        },
        url:"../cPanel/deleteRows",
        type:"post",
        data:{"Tabla":tabla,"Id":id},
        success:function(data){
            console.log(data);
            ventanaEmergente_Close();
            setTimeout(function(){
                $("table.tablaReportes tr").each(function(ind,obj){
                    if($(obj).children().html()==id){
                        $(obj).css("background-color","#FFC4C4");
                        $(obj).fadeOut(900,function(){
                            $(obj).remove();
                        });
                    }
                });
                $("table.tablaReportes tr").each(function(ind,obj){
                    if($(obj).children().next().html()==id){
                        $(obj).css("background-color","#FFC4C4");
                        $(obj).fadeOut(900,function(){
                            $(obj).remove();
                        });
                    }
                });
            },1300);                
        }
    });
}
function ventanaEmergente_Close(){
  $(".ventanaEmergente").fadeOut(function(){
    $(".ventanaEmergente").remove();
  });  
}
function BuscarRegistros(tabla){
    var textoBusqueda = $(".campoBuscador").val();
    var ContTd;
    $(".tablaReportes tr").each(function(ind, obj){
        
        if(ind == 0){
            ContTd = $(".tr-th td").length;
        }
        if(ind != 0) {
            $(obj).remove();
        }
    });
    $(".divToBtnViewAll").remove();
    $.ajax({
        beforeSend:function(){
            $(".divToTable .tablaReportes").append("<tr class='trCarga'><td colspan='"+ContTd+"'><img width='40' id='loadingData' src='../imagenes/loading.gif' style='display:block;margin:auto;visibility:visible;'></td></tr>");

        },
        url:"./findRows",
        type:"post",
        data:{"Tabla":tabla,"Busqueda":textoBusqueda},
        success:function(data){
            $(".trCarga").remove();
            $(".divToTable .tablaReportes").append(data);
            if(textoBusqueda!="")
                $(".panel").append("<div align='center' class='divToBtnViewAll'><label class='btnViewAll' onclick=\"javascript: $('.campoBuscador').val('');BuscarRegistros('"+tabla+"');this.remove();\">Ver todo</label></div>");
        }
    });
    var textoBusqueda = $(".campoBuscador").val();
}

var updateImagen="no";
function UpdateRows(table,id){
    var datos={};
    if(table=="Usuarios"){
        datos={Tabla:table,"Id":id,"tipoUsuario":$("#EditTipoUsuario").val(),"Nombres":$("#EditNombres").val(),"Apellidos":$("#EditApellidos").val(),"Email":$("#EditEmail").val(),"Password":$("#EditPassword").val(),"FechaNacimiento":$("#EditNacimiento").val(),"Telefono":$("#EditTelefono").val(),"Direccion":$("#EditDireccion").val()};
    }
    if(table=="Productos"){
        datos = new FormData($("#formUploading")[0]);
        datos.Tabla=table;
    }
    if(table=="Contactos"){
        datos={Tabla:table,"Id":id,"Nombre":$("#EditNombre").val(),"Email":$("#EditEmail").val(),"Telefono":$("#EditTelefono").val(),"Mensaje":$("#EditMensaje").val()};
    }
    alert("Reparar esta parte...");
    if(table=="Productos"){
	    $.ajax({
	        beforeSend:function(){
	            //$(".divToTable .tablaReportes").append("<tr class='trCarga'><td colspan='"+ContTd+"'><img width='40' id='loadingData' src='../imagenes/loading.gif' style='display:block;margin:auto;visibility:visible;'></td></tr>");
	        },
	        url:"../cPanel/updateRows/",
	        type:"post",
	        data:datos,
	        //necesario para subir archivos via ajax
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){            
	            $(".ventanaEmergente-contenido").html(data);
	            setTimeout(function(){
	                ventanaEmergente_Close(); 
	                getTableRows(table.toLowerCase());               
	            },3000);

	        }
	    });
    }
    else {
	    $.ajax({
	        beforeSend:function(){
	            //$(".divToTable .tablaReportes").append("<tr class='trCarga'><td colspan='"+ContTd+"'><img width='40' id='loadingData' src='../imagenes/loading.gif' style='display:block;margin:auto;visibility:visible;'></td></tr>");
	        },
	        url:"../cPanel/updateRows/",
	        type:"post",
	        data:datos,
	        success:function(data){            
	            $(".ventanaEmergente-contenido").html(data);
	            setTimeout(function(){
	                ventanaEmergente_Close(); 
	                getTableRows(table.toLowerCase());               
	            },3000);

	        }
	    });
    }
}
function EditarPortada(id){
    if(window.FileReader){
        var formData = new FormData($("#formUploading")[0]);
        $.ajax({
            url: '../cPanel/editarPortada/',  
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){

            },
            //una vez finalizado correctamente
            success: function(data){
                    $(".imgPortada").attr("src","data:image/jpeg;base64,"+data);
                    updateImagen="si";
                    /*$("#btnUploadImg").html("+");
                    $("#btnUploadImg").attr("class","color-transparent");


                    $("#imgPerfil").attr("src",data+"?time=" + new Date());
                    $("#btnUploadImgPerfil").html("+");
                    $("#btnUploadImgPerfil").attr("class","color-transparent");
                    */

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