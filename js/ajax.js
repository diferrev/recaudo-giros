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

//LOGIN
function login(){

	var username = $("#username").val();
	var password = $("#password").val();
	
	ajax = objetoAjax();

	ajax.open("POST","procedures/login.php",true);
		
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if( ajax.responseText == "OK" ){
				alerts("Su usuario y contraseña son correctos","alert-success");
				setTimeout("redireccionar('/recaudogiros')", 1000)
			}else{
				alerts("Su usuario y contraseña son incorrectos","alert-warning");
				limpiaFormulario("#formLogin");
				$("#username").focus();
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("username="+username+"&password="+password)
}

//LOGOUT
function logout(a){
	
	$(this).click(function(event){
    event.preventDefault();
	});
	
	ajax = objetoAjax();

	ajax.open("GET","procedures/logout.php",true);
		
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			setTimeout("redireccionar('/recaudogiros/login.php')", 500)
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send()
}

//CAMBIA PASSWORD
function cambiarPwd(){
	
	if(vacio($("#pwdactual")) == true){
		alert("El campo de contraseña actual no puede estar vacio.");
		$("#pwdactual").focus();
	}else if(vacio($("#pwdnuevo1")) == true){
		alert("El campo de contraseña nueva no puede estar vacio.");
		$("#pwdnuevo1").focus();
	}else if(vacio($("#pwdnuevo2")) == true){
		alert("El campo de confirmar contraseña nueva no puede estar vacio.");
		$("#pwdnuevo2").focus();
	}else{
		var username = $("#username").val();
		var pwdactual = $("#pwdactual").val();
		var pwdnuevo1 = $("#pwdnuevo1").val();
		var pwdnuevo2 = $("#pwdnuevo2").val();
		if(pwdnuevo1 == pwdnuevo2){
			ajax = objetoAjax();
			ajax.open("POST","procedures/cambiar-passwd.php",true);
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4) {
					if(ajax.responseText == "OK"){
						alert("Cambio de contraseña realizado correctamente, se cerrará la sesión.");
						logout();
					}else{
						error = ajax.responseText;
						alerts("La constraseña actual no es correcta","alert-warning");
						$("#pwdactual").val("").focus();
					}
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("username="+username+"&pwdactual="+pwdactual+"&pwdnuevo="+pwdnuevo1);
		}else{
			alerts("Las nuevas contraseñas no coinciden.","alert-warning");
		}
	}
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

//FUNCION QUE DEVUELVE EL NUMERO DE CONSECUTIVO DEL RECAUDO SEGUN PUNTODEVENTA, CEDULACOLOCADO Y TIPO DE TRANSACCION
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
	var cedulacajero = $("#cedulacajero").text();
	var nombrescajero = $("#nombrescajero").text();
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
			localStorage.setItem('nombrescajero',nombrescajero);
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
			ajax.onreadystatechange = function(){
				if (ajax.readyState==4) {
					
					if(ajax.responseText == "OK"){
						
						imprimirRecibo(fechayhorapc,cedulacajero,nombrescajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
						limpiaFormulario("#formRecaudo");
						$("#reversarultimo").removeClass("disabled").removeAttr("disabled");
						$("#reimprimir").removeClass("disabled").removeAttr("disabled");
						
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
	var cedulacajero = $("#cedulacajero").text();
	var nombrescajero = $("#nombrescajero").text();
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
			localStorage.setItem('nombrescajero',nombrescajero);
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
						
						imprimirRecibo(fechayhorapc,cedulacajero,nombrescajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
						limpiaFormulario("#formRecaudo");
						$("#reversarultimo").addClass("disabled").attr("disabled","disabled");
						$("#reimprimir").removeClass("disabled").removeAttr("disabled");
						
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

//REVERSA EL RECAUDO
function reversarUltimoRecaudo(){
	var fechayhorapc = fechayhoraPC();
	var cedulacajero = localStorage.cedulacajero;
	var nombrescajero = localStorage.nombrescajero;
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
	localStorage.setItem('nombrescajero',nombrescajero);
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
	ajax.onreadystatechange = function(){
		if (ajax.readyState==4) {
						
			if(ajax.responseText == "OK"){
							
				imprimirRecibo(fechayhorapc,cedulacajero,nombrescajero,centrodecosto,nombrepuntodeventa,cedulacolocador,nombrescolocador,valorString,nombretransaccion,consecutivo,observaciones,tipotransaccion);
				limpiaFormulario("#formRecaudo");
				$("#reversarultimo").addClass("disabled").attr("disabled","disabled");
			}
			else{
				transaccionError(ajax.responseText);
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("fechayhorapc="+fechayhorapc+"&cedulacajero="+cedulacajero+"&cedulacolocador="+cedulacolocador+"&puntodeventa="+puntodeventa+"&transaccion="+transaccion+"&consecutivo="+consecutivo+"&valor="+valor+"&observaciones="+observaciones)
}

function crearCajero(){
	if(vacio($("#documento")) == true){
		alert("El campo de Documento debe estar rellenado");
	}
	else if(vacio($("#nombrecajero")) == true){
		alert("El campo de Nombres debe estar rellenado");
	}
	else if(vacio($("#apellido1cajero")) == true){
		alert("El campo de Primer Apellido debe estar rellenado");
	}
	else if($("#centrodecosto").val() == "NULL"){
		alert("Debe seleccionar el Centro de Costo del cajero");
	}
	else{
		var cedulacajero = $("#documento").val();
		var nombrescajero = $("#nombrecajero").val();
		var apellido1cajero = $("#apellido1cajero").val();
		var apellido2cajero = $("#apellido2cajero").val();
		var centrodecosto = $("#centrodecosto").val();
		if(!apellido2cajero)
		{
		apellido2cajero = "";
		}

		ajax = objetoAjax();

		ajax.open("POST","procedures/admin/crear-cajero.php",true);
		ajax.onreadystatechange = function() {
		 
			if (ajax.readyState == 4) {
				if(ajax.responseText == "OK"){
					alerts("Cajero creado correctamente","alert-success");
					limpiaFormulario("#formCrearCajero");
				}else{
					var error = ajax.responseText;
					alerts(error,"alert-danger");
					limpiaFormulario("#formCrearCajero");
				}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("cedulacajero="+cedulacajero+"&nombrescajero="+nombrescajero+"&apellido1cajero="+apellido1cajero+"&apellido2cajero="+apellido2cajero+"&centrodecosto="+centrodecosto)
	}
}

function editarCajero(c){
	ajax = objetoAjax();
	ajax.open("POST","admin/editar-cajero.php",true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			$("#content-admin").html(ajax.responseText);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("documento="+c)
}

function actualizarCajero(){
	if(vacio($("#documento")) == true){
		alert("El campo de Documento debe estar rellenado");
	}
	else if(vacio($("#nombrecajero")) == true){
		alert("El campo de Nombres debe estar rellenado");
	}
	else if(vacio($("#apellido1cajero")) == true){
		alert("El campo de Primer Apellido debe estar rellenado");
	}
	else if($("#centrodecosto").val() == "NULL"){
		alert("Debe seleccionar el Centro de Costo del cajero");
	}
	else{
		var cedulacajero = $("#documento").val();
		var nombrescajero = $("#nombrecajero").val();
		var apellido1cajero = $("#apellido1cajero").val();
		var apellido2cajero = $("#apellido2cajero").val();
		var centrodecosto = $("#centrodecosto").val();
		if(!apellido2cajero)
		{
		apellido2cajero = "";
		}
		
		ajax = objetoAjax();

		ajax.open("POST","procedures/admin/actualizar-cajero.php",true);
		ajax.onreadystatechange = function() {
		 
			if (ajax.readyState == 4) {
				if(ajax.responseText == "OK"){
					editarCajero(cedulacajero);
					setTimeout(function(){
						alerts("Cajero actualizado correctamente","alert-success");
					},500);
				}else{
					var error = ajax.responseText;
					alerts(error,"alert-danger");
					limpiaFormulario("#formActualizarCajero");
				}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("cedulacajero="+cedulacajero+"&nombrescajero="+nombrescajero+"&apellido1cajero="+apellido1cajero+"&apellido2cajero="+apellido2cajero+"&centrodecosto="+centrodecosto)
	}
}

function consultarCajero(){
	var cajero = $("#documento").val();
	ajax = objetoAjax();
	ajax.open("POST","procedures/admin/consultar-cajero.php",true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(ajax.responseText == "NULL"){
				alerts("El cajero no existe","alert-danger");
				$("#documento").val("").focus();
			}else{
				$("#nombresyapellidos").val(ajax.responseText);
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("documento="+cajero)
}

function resetearPwd(c){

	var password = c.toString();
	password = "CV" + password.substr(-3);
	
	ajax = objetoAjax();
	ajax.open("POST","procedures/admin/resetear-password.php",true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			if(ajax.responseText == "OK"){
				alert("Contraseña reseteada correctamente para el documento "+c+".");
			}else{
				alert("Ha ocurrido un error por favor intente más tarde.");
			}
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("documento="+c+"&password="+password)
}

function crearUsuario(){
	var cedulacajero = $("#documento").val();
	if(vacio($("#documento")) == true){
		alert("El campo de Documento debe estar rellenado");
	}
	else if(vacio($("#login")) == true){
		alert("El campo de Login debe estar rellenado");
	}
	else if($("#rol").val() == "NULL"){
		alert("Debe seleccionar un rol para el usuario");
	}
	else{
		var login = $("#login").val();
		var rol = $("#rol").val();
		var estado = $("#estado").val();
		var password = cedulacajero.toString();
		password = "CV" + password.substr(-3);
		
		ajax = objetoAjax();

		ajax.open("POST","procedures/admin/crear-usuario.php",true);
		ajax.onreadystatechange = function() {
		 
			if (ajax.readyState == 4) {
				if(ajax.responseText == "OK"){
					alerts("El usuario fue creado correctamente.","alert-success");
					limpiaFormulario("#formCrearUsuario");
				}else{
					alerts(ajax.responseText,"alert-danger");
					limpiaFormulario("#formCrearUsuario");
				}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("documento="+cedulacajero+"&login="+login+"&rol="+rol+"&estado="+estado+"&password="+password)
	}
}

function editarUsuario(c){
	ajax = objetoAjax();
	ajax.open("POST","admin/editar-usuario.php",true);
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4) {
			$("#content-admin").html(ajax.responseText);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("documento="+c)
}

function actualizarUsuario(){
	
	if(vacio($("#login")) == true){
		alert("El campo de Login debe estar rellenado");
	}
	else if($("#rol").val() == "NULL"){
		alert("Debe seleccionar un rol para el usuario");
	}
	else{
		var cedulacajero = $("#documento").val();
		var login = $("#login").val();
		var rol = $("#rol").val();
		var estado = $("#estado").val();
		
		ajax = objetoAjax();

		ajax.open("POST","procedures/admin/actualizar-usuario.php",true);
		ajax.onreadystatechange = function() {
		 
			if (ajax.readyState == 4) {
				if(ajax.responseText == "OK"){
					editarUsuario(cedulacajero);
					setTimeout(function(){
						alerts("Cajero actualizado correctamente","alert-success");
					},500);
				}else{
					var error = ajax.responseText;
					alerts(error,"alert-danger");
					limpiaFormulario("#formActualizarUsuario");
				}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("documento="+cedulacajero+"&login="+login+"&rol="+rol+"&estado="+estado)
	}
}