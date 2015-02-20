
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