<?php
require_once "../clases/conexion.php";
/*require_once "../clases/crudadjunto.php";
$obj=new crudadjunto();*/
$mensaje = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.*/
$obj=new conectar();
$sql="INSERT INTO consulta_adjunto (id_aten,descripcion_adj)
		VALUES ('$_POST[id_aten]','$_POST[descripcion_adj]')";
//echo $sql;
//return mysqli_query($conexion,$sql);*/
$conexion=$obj->conexion();
$res=mysqli_query($conexion,$sql);
if($res==1){
	$id_adjunto=mysqli_insert_id($conexion);
	//echo "<br>id_adjunto".$id_adjunto;

	$ruta = '../adjuntos/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
	foreach ($_FILES as $archivo){ //Iteramos el arreglo de archivos
		if($archivo['error'] == UPLOAD_ERR_OK ){//Si el archivo se paso correctamente Ccontinuamos 
			$NombreOriginal = $archivo['name'];//Obtenemos el nombre original del archivo
			$temporal = $archivo['tmp_name']; //Obtenemos la ruta Original del archivo
			$extension=explode(".", $NombreOriginal);//Obtengo la extension del archivo
			$extension=end($extension);
			$nuevonombre=$id_adjunto.".".$extension;
			$destino = $ruta.$nuevonombre;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo
			move_uploaded_file($temporal, $destino); //Movemos el archivo temporal a la ruta especificada		
		}
		if ($archivo['error']==''){ //Si no existio ningun error, retornamos un mensaje por cada archivo subido
			$mensaje .= 'Archivo '.$NombreOriginal.' Subido correctamente.';
			$sql="UPDATE consulta_adjunto SET archivo_adj='$nuevonombre' WHERE id_adjunto='$id_adjunto'";
			//echo $sql;
			$res=mysqli_query($conexion,$sql);
		}
		if ($archivo['error']!=''){//Si existio algún error retornamos un el error por cada archivo.
			$mensaje .= 'No se pudo subir el archivo '.$NombreOriginal.' debido al siguiente Error: n'.$archivo['error']; 
		}
	}
}
else{
	$mensaje="Hubo un problema al tratar de subir el archivo o descripción del mismo";
}

echo $mensaje;// Regresamos los mensajes generados al cliente
?>
