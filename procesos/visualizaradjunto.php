<?php

require_once "../clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

try {
    
    // Verificar que se recibió el ID del adjunto
    if (!isset($_GET['id_adjunto']) || empty($_GET['id_adjunto'])) {
        die('Error: ID de adjunto no proporcionado');
    }
    
    $id_adjunto = $_GET['id_adjunto'];
    
    $sql="SELECT id_adjunto,descripcion_adj,archivo_adj FROM consulta_adjunto WHERE id_adjunto='$id_adjunto'";
    //echo $sql;
    $row=mysqli_query($conexion,$sql);
    $resultado = mysqli_fetch_array($row);

    
    if (!$resultado) {
        die('Error: Documento no encontrado');
    }
    
    $archivo_base64 = $resultado['archivo_adj'];
    
    // Verificar que hay contenido
    if (empty($archivo_base64)) {
        die('Error: El documento está vacío');
    }
    
    // Si el base64 incluye el prefijo "data:application/pdf;base64,", lo removemos
    if (strpos($archivo_base64, 'data:application/pdf;base64,') === 0) {
        $archivo_base64 = substr($archivo_base64, strlen('data:application/pdf;base64,'));
    }
    
    // Decodificar el base64
    $pdf_contenido = base64_decode($archivo_base64);
    
    if ($pdf_contenido === false) {
        die('Error: No se pudo decodificar el documento');
    }
    
    // Enviar headers para mostrar el PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="documento_' . $id_adjunto . '.pdf"');
    header('Content-Length: ' . strlen($pdf_contenido));
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    
    // Enviar el contenido del PDF
    echo $pdf_contenido;
    
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>