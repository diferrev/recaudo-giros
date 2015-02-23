
//Agrega separador de miles al campo Valor del Formulario 
//de Recaudo mientras se esta digitando.

function noBlankSpace(n)
{
	for(i=0;i<n;i++){
		if(n.charAt(i) != " "){
			return true;
		}
	}
	return false;
}
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
	var caracter = ".";
	valor = v.replace(caracter,"");
	valor = parseInt(valor);
	
	return valor;
}

function limpiaFormulario(f){
	$(f).get(0).reset();
}

function transaccionOk(text){
	
	var alert = $("#alert");
	alert.addClass("alert-success");
	alert.html(text);
	alert.slideDown(400).delay(2000).slideUp(400,function(){
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

function impRegistrarPago() {
		if (notReady()) { return; }
		// Send characters/raw commands to qz using "append"
		// This example is for EPL.  Please adapt to your printer language
		// Hint:  Carriage Return = \r, New Line = \n, Escape Double Quotes= \"
		qz.append("Apuestas Azar S.A.\n\n");
		qz.append("Recaudo Efectivo Giros v2.0\n\n");
		qz.append("Fecha y Hora: 23/02/2015 17:00:00\n");
		qz.append("Cajero: 31431938 ADRIANA NARANJO OLARTE\n");
		qz.append("ccosto: 1081 - CARTAGO\n");
		qz.append("Punto: GALES 3 - C. NORTE\n");
		qz.append("Colocador: 1112762042 - MARIA ALEJANDRA HERNANDEZ\n");
		qz.append("Valor: 150.000\n");
		qz.append("Concepto: 1 - PUNTOS RECAUDOS DEL DIA\n");
		qz.append("# Consecutivo: 2\n");
		qz.append("Observaciones: HOLA SOY UN OBSERVACION\n\n\n");
		qz.append("_____________    ____________\n");
		qz.append("Frm Recolector     Frm Asesor\n");
		qz.append("\n\n\n\n\n\n\n\n");
			
		// Tell the applet to print.
		qz.print();
			
		// Remove reference to this function
		window['qzDoneAppending'] = null;
		
	 }

