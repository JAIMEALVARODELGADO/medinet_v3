<?php
require_once "../clases/conexion.php";

$mensaje = '';
$obj = new conectar();
$conexion = $obj->conexion();

// Validar que se reciban los datos necesarios
if(!isset($_POST['id_aten']) || !isset($_POST['descripcion_adj']) || !isset($_POST['archivo_base64'])){
    echo "Error: Faltan datos requeridos";
    exit;
}

$id_aten = mysqli_real_escape_string($conexion, $_POST['id_aten']);
$descripcion_adj = mysqli_real_escape_string($conexion, $_POST['descripcion_adj']);
$archivo_base64 = $_POST['archivo_base64'];
$nombre_archivo = isset($_POST['nombre_archivo']) ? $_POST['nombre_archivo'] : 'documento.pdf';

// Validar que el archivo base64 no esté vacío
if(empty($archivo_base64)){
    echo "Error: El archivo está vacío";
    exit;
}

// Insertar el registro en la base de datos con el archivo en base64
$sql = "INSERT INTO consulta_adjunto (id_aten, descripcion_adj, archivo_adj) 
        VALUES ('$id_aten', '$descripcion_adj', '$archivo_base64')";
//echo $sql;
$res = mysqli_query($conexion, $sql);

if($res){
    $id_adjunto = mysqli_insert_id($conexion);
    $mensaje = "Archivo '$nombre_archivo' guardado correctamente con ID: $id_adjunto";
} else {
    $mensaje = "Error al guardar el archivo: " . mysqli_error($conexion);
}

echo $mensaje;
?>