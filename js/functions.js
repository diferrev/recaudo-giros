
//Agrega separador de miles al campo Valor del Formulario 
//de Recaudo mientras se esta digitando.


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

function validaTransaccion()
{
	var t = $("#transaccion").val();
	if(t == 0){
		alert("No ha seleccionado el tipo de TRANSACCIÓN.");
		$("#transaccion").focus();
	}
}

function convertirValor(v)
{
	valor = v.replace(/\./g,"");
	valor = valor.replace(/\s/g,"");
	return valor;
}

function limpiaFormulario(f){
	$(f).get(0).reset();
	$("#puntodeventa").focus();
}

function transaccionOk(text){
	
	var alert = $("#alert");
	alert.addClass("alert-success");
	alert.html(text);
	alert.slideDown(400).delay(2500).slideUp(400,function(){
		alert.html("");
		alert.removeClass("alert-success");
	});

}

function transaccionError(text){

	var alert = $("#alert");
	alert.addClass("alert-danger");
	alert.html(text);
	alert.slideDown(400).delay(2000).slideUp(400,function(){
		alert.html("");
		alert.removeClass("alert-danger");
	});

}

function imprimirRecibo(fechayhorapc,cedulacajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valor,nombretransaccion,consecutivo,observaciones) {
		if (notReady()) { return; }
		// Send characters/raw commands to qz using "append"
		// This example is for EPL.  Please adapt to your printer language
		// Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
		qz.append("Apuestas Azar S.A.\n\n");
		qz.append("Recaudo Efectivo Giros v2.0\n\n");
		qz.append("Fecha y Hora: "+fechayhorapc+"\n");
		qz.append("Cajero: "+cedulacajero+" ADRIANA NARANJO OLARTE\n");
		qz.append("Ccosto: "+centrodecosto+"\n");
		qz.append("Punto: "+nombrepuntodeventa+"\n");
		qz.append("Colocador: "+cedulacolocador+" - "+nombrescolocador+"\n");
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
 
function reimprimirRecibo(){
	
	var fechayhorapc = localStorage.fechayhoraPC;
	var cedulacajero = localStorage.cedulacajero;
	var centrodecosto = localStorage.centrodecosto;
	var nombrepuntodeventa = localStorage.nombrepuntodeventa;
	var cedulacolocador = localStorage.cedulacolocador;
	var nombrescolocador = localStorage.nombrescolocador;
	var valorString = localStorage.valor;
	var transaccion = localStorage.transaccion;
	var nombretransaccion = localStorage.nombretransaccion;
	var consecutivo = localStorage.consecutivo;
	var observaciones = localStorage.observaciones;
		
	imprimirRecibo(fechayhorapc,cedulacajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones);
		localStorage.clear();
	$("#reimprimir").addClass("disabled");
}