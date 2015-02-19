
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
		alert('Solo se permiten números');
	input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}