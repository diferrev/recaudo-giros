function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!="undefined") {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//FUNCION QUE TRAE EL CENTRO DE COSTO AL EVENTO ONCHANGE
//DEL CAMPO PUNTODEvENTA

function consultarCcosto(){
	
	var puntodeventa = $("#puntodeventa").val();
	var centrodecosto = $("#centrodecosto");
	
	ajax = objetoAjax();
	
	ajax.open("POST","procedures/consultar-ccosto.php",true);
	
	ajax.onreadystatechange = function() {
	 
		if (ajax.readyState==1) {

			centrodecosto.val("CARGANDO CENTRO DE COSTO");
		}
		if (ajax.readyState==4) {

			centrodecosto.val(ajax.responseText);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("puntodeventa="+puntodeventa)
	
}