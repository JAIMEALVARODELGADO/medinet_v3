<?php 
/* la key deben previamente obtenerla en su zona de usuairo*/
$key = "43575-20y07l18i13e48k23d567gwzEA";
$baseurl ="http://api.creasms.com";
$mensaje = urlencode("mensaje de ejemplo de sms");
$pais = "57";
$movil = "3008313000";
$remitente = "Jaime";
$url = "$baseurl/web/enviar.php?key=$key&pais=$pais&movil=$movil&
remitente=$remitente&mensaje=$mensaje"; $resultado=@file_get_contents($url);
/* los valores retornados pueden ser
#OK#;1234567890 Donde, #OK# indica que se ha enviado, y el número 1234567890 es el código de identificación para el sms y consultas de estado.
1 Todo esta correcto, se ha realizado el envío.
-5 No tiene Activado envios Externos.
-10 Ip No válida.
-15 Error de autentificación.
-20 No dispone de Créditos suficientes para realizar el envío.
-25 No es posible enviar el sms a ese Pais.
-30 El número al que desea enviar, es incorrecto.
-35 El Remitente que desea usar, no esta activo o validado.
-40 El texto a enviar es superior al permitido (160)
-50 El Pais al que intentas enviar no esta autorizado. 
-100 Error Genérico, faltan parametros o error desconocido.
*/
if (strstr($resultado,"#OK#")){
echo "Mensaje Enviado, con el identificador:".strrchr($resultado, ';');
} else {
//algun error
echo "Error : $resultado";
}; ?>