function alerts(t,a){
	var alert = $("#alert");
	alert.addClass(a);
	alert.html(t);
	alert.slideDown(400).delay(2500).slideUp(400,function(){
		alert.html("");
		alert.removeClass(a);
	});
}
function redireccionar(p) {
	location.href=p;
} 
function cargarContenido(div,url,a){
	
	$(this).click(function(event){
    event.preventDefault();
	});
	
	$(div).load(url);
}
//DEVUELVE SI EL CAMPO ESTA VACIO O NO
function vacio(c){
	c = c.val();
	c = c.toString();
	if(c.length == 0){
		return true;
	}else{
		return false;
	}
}

//AGREGA SEPARACION DE MILES
function formatearValor(input)
{
	var num = input.value.replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	}
	//Si el usuario esta ingresando cualquier caracter 
	//que no sea numero saltara el ALERT y borrara lo escrito
	else{ 
		alert('Solo se permiten números.');
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}

//VALIDA SI EL TEXTO DE UN CAMPO ES NUMERICO, SE EJECUTA CADA VEZ QUE SUELTA UNA TECLA
function validaNumero(input)
{
	var num = input.value;
	if(isNaN(num))
	{
		alert("Solo se permiten números en el campo VALOR");
		input.value = "";
		input.focus();
	}
}

//VALIDA SI SE HA SELECCIONA UN TIPO DE TRANSACCION AL PASAR AL CAMPO VALOR
function validaTransaccion()
{
	var t = $("#transaccion").val();
	if(t == 0){
		alert("No ha seleccionado el tipo de TRANSACCIÓN.");
		$("#transaccion").focus();
	}
}

//ELIMINA LOS SEPARADORES DE MILES Y ESPACIOS
function convertirValor(v)
{
	valor = v.replace(/\./g,"");
	valor = valor.replace(/\s/g,"");
	return valor;
}

//LIMPIA TODOS LOS CAMPOS UN FORMULARIO
function limpiaFormulario(f){
	$(f).get(0).reset();
	$("#puntodeventa").focus();
}

//MUESTRA UN ALERT DE TRANSACCION EXITOSA
function transaccionOk(text){
	
	var alert = $("#alert");
	alert.addClass("alert-success");
	alert.html(text);
	alert.slideDown(400).delay(2500).slideUp(400,function(){
		alert.html("");
		alert.removeClass("alert-success");
	});

}

//MUESTRA UN ALERT DE TRANSACCION FALLIDA
function transaccionError(text){

	var alert = $("#alert");
	alert.addClass("alert-danger");
	alert.html(text);
	alert.slideDown(400).delay(2000).slideUp(400,function(){
		alert.html("");
		alert.removeClass("alert-danger");
	});

}

//IMPRIME RECIBO
function imprimirRecibo(fechayhorapc,cedulacajero,nombrescajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valor,nombretransaccion,consecutivo,observaciones,tipotransaccion){
		if (notReady()) { return; }
		// Send characters/raw commands to qz using "append"
		// This example is for EPL.  Please adapt to your printer language
		// Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
		qz.append("Apuestas Azar S.A.\n");
		qz.append("Recaudo Efectivo Giros v2.0\n\n");
		qz.append(tipotransaccion+"\n");
		qz.append("Fecha y Hora: "+fechayhorapc+"\n");
		qz.append("Cajero: "+cedulacajero+"\n"+nombrescajero+"\n");
		qz.append("Ccosto: "+centrodecosto+"\n");
		qz.append("Punto: "+nombrepuntodeventa+"\n");
		qz.append("Colocador: "+cedulacolocador+"\n"+nombrescolocador+"\n");
		qz.append("Valor: "+valor+"\n");
		qz.append("Concepto: "+nombretransaccion+"\n");
		qz.append("# Consecutivo: "+consecutivo+"\n");
		qz.append("Observaciones: "+observaciones+"\n\n\n");
		qz.append("__________________    __________________\n");
		qz.append("Frm Recolector             Frm Colocador\n");
		qz.append("\n\n\n\n\n\n\n\n");
			
		// Tell the applet to print.
		qz.print();
			
		// Remove reference to this function
		window['qzDoneAppending'] = null;
}

//REIMPRIME RECIBO
function reimprimirRecibo(){
	
	var fechayhorapc = localStorage.fechayhoraPC;
	var cedulacajero = localStorage.cedulacajero;
	var nombrescajero = localStorage.nombrescajero;
	var centrodecosto = localStorage.centrodecosto;
	var nombrepuntodeventa = localStorage.nombrepuntodeventa;
	var cedulacolocador = localStorage.cedulacolocador;
	var nombrescolocador = localStorage.nombrescolocador;
	var valorString = localStorage.valor;
	var transaccion = localStorage.transaccion;
	var nombretransaccion = localStorage.nombretransaccion;
	var consecutivo = localStorage.consecutivo;
	var observaciones = localStorage.observaciones;
	var tipotransaccion = localStorage.tipotransaccion;
		
	imprimirRecibo(fechayhorapc,cedulacajero,nombrescajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
		localStorage.clear();
	$("#reimprimir").addClass("disabled");
	$("#reversarultimo").addClass("disabled");
}