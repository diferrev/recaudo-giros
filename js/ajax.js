//DECLARANDO EL OBJETO PARA LAS LLAMADAS AJAX
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

//DEVUELVE LA FECHA Y HORA DEL PC
function fechayhoraPC()
{
	var fecha = new Date();
	var dia,mes,anio,hora,min,seg,fechayhoraPC;
	
	dia = fecha.getDate();
	if((dia.toString()).length == 1){
		dia = "0" + dia;
	}
	
	mes = fecha.getMonth() + 1;
	if((mes.toString()).length == 1){
		mes = "0" + mes;
	}
	
	hora = fecha.getHours();
	if((hora.toString()).length == 1){
		hora = "0" + hora;
	}
	
	min = fecha.getMinutes();
	if((min.toString()).length == 1){
		min = "0" + min;
	}
	
	seg = fecha.getSeconds();
	if((seg.toString()).length == 1){
		seg = "0" + seg;
	}
	
	fechayhoraPC = dia+"/"+mes+"/"+fecha.getFullYear()+" "+hora+":"+min+":"+seg;
	return fechayhoraPC;
}

//FUNCION QUE DEVUELVE EL CENTRODECOSTO AL SELECCIONAR UN PUNTO DE VENTA
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

//FUNCION QUE DEVUELVE NOMBRES Y APELLIDOS DEL COLOCADOR SEGUN LA CEDULA DIGITADA
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

//FUNCION QUE DEVUELVE EL NUMERO DE CONSECUTIVO DEL RECAUDO SEGUN 
//PUNTODEVENTA, CEDULACOLOCADO Y TIPO DE TRANSACCION
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

//REGISTRA EL RECAUDO
function registrarRecaudo(){
	
	var fechayhorapc = fechayhoraPC();
	var cedulacajero = 31431938;
	var puntodeventa = $("#puntodeventa").val();
	var nombrepuntodeventa = $("#puntodeventa option:selected").html();
	var centrodecosto = $("#centrodecosto").val();
	var cedulacolocador = $("#cedulacolocador").val();
	var nombrescolocador = $("#nombrescolocador").val();
	var transaccion = $("#transaccion").val();
	var nombretransaccion = $("#transaccion option:selected").html();
	var consecutivo = $("#consecutivo").val();
	var observaciones = $("#observaciones").val();
	if(!observaciones)
	{
		observaciones = "";
	}
	var tipotransaccion = "";
	var valorString = $("#valor").val();
	var valor = convertirValor(valorString);
	
	if(valorString){
		if(isNaN(valor) == true){
			alert("El campo VALOR no debe contener espacios en blanco");
			$("#valor").val("");
			$("#valor").focus();
		}
		else{
			localStorage.setItem('fechayhoraPC',fechayhorapc);
			localStorage.setItem('cedulacajero',cedulacajero);
			localStorage.setItem('puntodeventa',puntodeventa);
			localStorage.setItem('centrodecosto',centrodecosto);
			localStorage.setItem('nombrepuntodeventa',nombrepuntodeventa);
			localStorage.setItem('cedulacolocador',cedulacolocador);
			localStorage.setItem('nombrescolocador',nombrescolocador);
			localStorage.setItem('valor',valorString);
			localStorage.setItem('transaccion',transaccion);
			localStorage.setItem('nombretransaccion',nombretransaccion);
			localStorage.setItem('consecutivo',consecutivo);
			localStorage.setItem('observaciones',observaciones);
			localStorage.setItem('tipotransaccion',tipotransaccion);

			ajax = objetoAjax();
			
			ajax.open("POST","procedures/insertar-registro.php",true);
			ajax.onreadystatechange = function() {
			 
				if (ajax.readyState==1) {
					
				}
				if (ajax.readyState==4) {
					
					if(ajax.responseText == "OK"){
						
						imprimirRecibo(fechayhorapc,cedulacajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
						limpiaFormulario("#formRecaudo");
						$("#reversarultimo").removeClass("disabled");
						$("#reimprimir").removeClass("disabled");
						
					}
					else{
						transaccionError(ajax.responseText);
					}

				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("fechayhorapc="+fechayhorapc+"&cedulacajero="+cedulacajero+"&cedulacolocador="+cedulacolocador+"&puntodeventa="+puntodeventa+"&transaccion="+transaccion+"&consecutivo="+consecutivo+"&valor="+valor+"&observaciones="+observaciones)
		}
	}
	else{
		alert("No ha ingresado un valor para la transacción");
	}
}

//REVERSA UN RECAUDO ESPECIFICADO
function reversarRecaudo(){
	
	var fechayhorapc = fechayhoraPC();
	var cedulacajero = 31431938;
	var puntodeventa = $("#puntodeventa").val();
	var nombrepuntodeventa = $("#puntodeventa option:selected").html();
	var centrodecosto = $("#centrodecosto").val();
	var cedulacolocador = $("#cedulacolocador").val();
	var nombrescolocador = $("#nombrescolocador").val();
	var transaccion = $("#transaccion").val();
	var nombretransaccion = $("#transaccion option:selected").html();
	var consecutivo = $("#consecutivo").val();
	var observaciones = $("#observaciones").val();
	if(!observaciones)
	{
		observaciones = "";
	}
	
	var tipotransaccion = "Reversa pago";
	var valorString = $("#valor").val();
	var valor = convertirValor(valorString);
	
	if(valorString){
		if(isNaN(valor) == true){
			alert("El campo VALOR no debe contener espacios en blanco");
			$("#valor").val("");
			$("#valor").focus();
		}
		else{
			
			valor = "-" + valor;
			valorString = "-" + valorString;
			localStorage.setItem('fechayhoraPC',fechayhorapc);
			localStorage.setItem('cedulacajero',cedulacajero);
			localStorage.setItem('puntodeventa',puntodeventa);
			localStorage.setItem('centrodecosto',centrodecosto);
			localStorage.setItem('nombrepuntodeventa',nombrepuntodeventa);
			localStorage.setItem('cedulacolocador',cedulacolocador);
			localStorage.setItem('nombrescolocador',nombrescolocador);
			localStorage.setItem('valor',valorString);
			localStorage.setItem('transaccion',transaccion);
			localStorage.setItem('nombretransaccion',nombretransaccion);
			localStorage.setItem('consecutivo',consecutivo);
			localStorage.setItem('observaciones',observaciones);
			localStorage.setItem('tipotransaccion',tipotransaccion);

			
			ajax = objetoAjax();
			
			ajax.open("POST","procedures/insertar-registro.php",true);
			ajax.onreadystatechange = function() {
			 
				if (ajax.readyState==1) {
					
				}
				if (ajax.readyState==4) {
					
					if(ajax.responseText == "OK"){
						
						imprimirRecibo(fechayhorapc,cedulacajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
						limpiaFormulario("#formRecaudo");
						$("#reversarultimo").addClass("disabled");
						$("#reimprimir").removeClass("disabled");
						
					}
					else{
						transaccionError(ajax.responseText);
					}

				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("fechayhorapc="+fechayhorapc+"&cedulacajero="+cedulacajero+"&cedulacolocador="+cedulacolocador+"&puntodeventa="+puntodeventa+"&transaccion="+transaccion+"&consecutivo="+consecutivo+"&valor="+valor+"&observaciones="+observaciones)
		}
	}
	else{
		alert("No ha ingresado un valor para la transacción");
	}
}

//REVERSA EL ÚLTIMO RECAUDO REGISTRADO
function reversarUltimoRecaudo(){
	
	var fechayhorapc = fechayhoraPC();
	var cedulacajero = localStorage.cedulacajero;
	var centrodecosto = localStorage.centrodecosto;
	var puntodeventa = localStorage.puntodeventa;
	var nombrepuntodeventa = localStorage.nombrepuntodeventa;
	var cedulacolocador = localStorage.cedulacolocador;
	var nombrescolocador = localStorage.nombrescolocador;
	var valorString = "-" + localStorage.valor;
	var transaccion = localStorage.transaccion;
	var nombretransaccion = localStorage.nombretransaccion;
	var consecutivo = localStorage.consecutivo;
	consecutivo = parseInt(consecutivo) + 1;
	
	var observaciones = localStorage.observaciones;
	var tipotransaccion = "Reversa pago";
	var valor = convertirValor(valorString);
		
	localStorage.setItem('fechayhoraPC',fechayhorapc);
	localStorage.setItem('cedulacajero',cedulacajero);
	localStorage.setItem('centrodecosto',centrodecosto);
	localStorage.setItem('puntodeventa',puntodeventa);
	localStorage.setItem('nombrepuntodeventa',nombrepuntodeventa);
	localStorage.setItem('cedulacolocador',cedulacolocador);
	localStorage.setItem('nombrescolocador',nombrescolocador);
	localStorage.setItem('valor',valorString);
	localStorage.setItem('transaccion',transaccion);
	localStorage.setItem('nombretransaccion',nombretransaccion);
	localStorage.setItem('consecutivo',consecutivo);
	localStorage.setItem('observaciones',observaciones);
	localStorage.setItem('tipotransaccion',tipotransaccion);

			
	ajax = objetoAjax();
			
	ajax.open("POST","procedures/insertar-registro.php",true);
	ajax.onreadystatechange = function() {
			 
		if (ajax.readyState==1) {
						
		}
		if (ajax.readyState==4) {
						
			if(ajax.responseText == "OK"){
							
				imprimirRecibo(fechayhorapc,cedulacajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
				limpiaFormulario("#formRecaudo");
				$("#reversarultimo").addClass("disabled");
				
			}
			else{
				transaccionError(ajax.responseText);
			}

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechayhorapc="+fechayhorapc+"&cedulacajero="+cedulacajero+"&cedulacolocador="+cedulacolocador+"&puntodeventa="+puntodeventa+"&transaccion="+transaccion+"&consecutivo="+consecutivo+"&valor="+valor+"&observaciones="+observaciones)
}