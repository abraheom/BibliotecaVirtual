function desplegar(obj,articulo){
	document.getElementById("divEstructura").style.display="none";
	if(articulo=="estilos") {
		if(document.getElementById('infoEstilos').style.display=="none"){
			obj.innerHTML="<img src='imagenes/down.gif'> Estructuras web en estilos";
			document.getElementById('infoEstilos').style.display="inherit";
		}
		else {
			obj.innerHTML="<img src='imagenes/right.gif'>  Estructuras web en estilos";
			document.getElementById('infoEstilos').style.display="none";
		}
		
	}
	else {
		if(document.getElementById('infoArchivos').style.display=="none"){
			obj.innerHTML="<img src='imagenes/down.gif'> Estructuras web en archivos";
			document.getElementById('infoArchivos').style.display="inherit";
		}
		else {
			obj.innerHTML="<img src='imagenes/right.gif'>  Estructuras web en archivos";
			document.getElementById('infoArchivos').style.display="none";
		}
	}
}