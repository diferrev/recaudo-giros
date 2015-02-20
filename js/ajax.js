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
	
	if(puntodeventa != "NULL"){
		ajax = objetoAjax();
		
		ajax.open("POST","procedures/consultar-ccosto.php",true);
		
		ajax.onreadystatechange = function() {
		 
			if (ajax.readyState==1) {

				centrodecosto.val("CARGANDO CENTRO DE COSTO");
			}
			if (ajax.readyState==4) {

				centrodecosto.val(ajax.responseText);
				$("#transaccion").get(0).selectedIndex = 0;
				$("#consecutivo").val("");
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("puntodeventa="+puntodeventa)
	}
	else{
		centrodecosto.val("");
	}
	
}

//FUNCION QUE TRAE NOMBRES Y APELLIDOS DEL COLOCADOR EN EL EVENTO ONCHANGE
//DEL CAMPO CEDULACOLOCADOR

function consultarColocador(){
	
	var cedulacolocador = $("#cedulacolocador").val();
	var nombrescolocador = $("#nombrescolocador");
	
	ajax = objetoAjax();

	ajax.open("POST","procedures/consultar-colocador.php",true);
	ajax.onreadystatechange = function() {
	 
		if (ajax.readyState==1) {
			nombrescolocador.val("CARGANDO NOMBRES Y APELLIDOS");
		}
		if (ajax.readyState==4) {
			if(ajax.responseText == "NULL"){
				alert("El número de documento no corresponde a un colocador existente");
				nombrescolocador.val("");
				$("#cedulacolocador").val("");
				$("#cedulacolocador").focus();;
			}
			else{
				nombrescolocador.val(ajax.responseText);
				$("#transaccion").get(0).selectedIndex = 0;
				$("#consecutivo").val("");
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("cedulacolocador="+cedulacolocador)
	
}

//FUNCION QUE DEVUELVE EL NUMERO DE CONSECUTIVO DEL REGISTRO
//SEGUN LA TRANSACCION

function numConsecutivo(){
	
	var cedulacolocador = $("#cedulacolocador").val();
	var puntodeventa = $("#puntodeventa").val();
	var transaccion = $("#transaccion").val();
	var consecutivo = $("#consecutivo");
	
	if(transaccion != 0){
		if(puntodeventa == "NULL"){
			alert("Debe seleccionar PUNTO DE VENTA");
			$("#puntodeventa").focus();
			$("#transaccion").get(0).selectedIndex = 0;
		}
		else if(!cedulacolocador){
			alert("Debe ingresar COLOCADOR");
			$("#cedulacolocador").focus();
			$("#transaccion").get(0).selectedIndex = 0;
		}
		else{
			ajax = objetoAjax();
			
			ajax.open("POST","procedures/num-transaccion.php",true);
			ajax.onreadystatechange = function() {
			 
				if (ajax.readyState==1) {

					consecutivo.val("CARGANDO CONSECUTIVO");
				}
				if (ajax.readyState==4) {

					consecutivo.val(ajax.responseText);
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("cedulacolocador="+cedulacolocador+"&puntodeventa="+puntodeventa+"&transaccion="+transaccion)
			
		}
	}else{
		consecutivo.val("");
	}
}

//FUNCION QUE DEVUELVE EL NUMERO DE CONSECUTIVO DEL REGISTRO
//SEGUN LA TRANSACCION

function insertarRegistro(){
	
	var cedulacajero = 31431389;
	var puntodeventa = $("#puntodeventa").val();
	var cedulacolocador = $("#cedulacolocador").val();
	var transaccion = $("#transaccion").val();
	var consecutivo = $("#consecutivo").val();
	var observaciones = $("#observaciones").val();
	if(!observaciones)
	{
		observaciones = "NULL";
	}
	
	var valor = $("#valor").val();
	if(noBlankSpace(valor) == false){
		alert("El campo VALOR no debe contener espacios en blanco");
		$("#valor").val("");
		$("#valor").focus();
	}
	else{
		var valor = convertirValor(valor);
		ajax = objetoAjax();
		
		ajax.open("POST","procedures/insertar-registro.php",true);
		ajax.onreadystatechange = function() {
		 
			if (ajax.readyState==1) {

			}
			if (ajax.readyState==4) {

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("cedulacajero="+cedulacajero+"cedulacolocador="+cedulacolocador+"&puntodeventa="+puntodeventa+"&transaccion="+transaccion+"&consecutivo="+consecutivo+"&valor="+valor+"&observaciones="+observaciones)
	}
}
	