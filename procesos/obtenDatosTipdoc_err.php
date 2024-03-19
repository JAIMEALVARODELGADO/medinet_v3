<?php
	require_once "../clases/conexion.php";
	require_once "../clases/crudeps.php";

	//$obj=new crudeps();
	//echo json_encode($obj->obtenDatos($_POST['ideps']));
	/*$obj=new conectar();
	$conexion=$obj->conexion();
	$sql="SELECT codi_det,descripcion_det FROM vw_tipo_ident ORDER BY descripcion_det";
    $res=mysqli_query($conexion,$sql);*/


	/*$sql="SELECT id_eps,codigo_eps, nit_eps, nombre_eps, direccion_eps, telefono_eps, contacto_eps FROM eps WHERE id_eps='$ideps'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_eps' => $ver[0],
			'codigo_eps' => $ver[1], 
			'nit_eps' => $ver[2], 
			'nombre_eps' => $ver[3], 
			'direccion_eps' => $ver[4], 
			'telefono_eps' => $ver[5], 
			'contacto_eps' => $ver[6]
			);
		return $datos;*/

if(!empty($_GET['id'])){
    //DB details
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '*****';
    $dbName = 'noprog';
    
    //Create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    
    if ($db->connect_error) {
        die("Unable to connect database: " . $db->connect_error);
    }
    
    //get content from database
    $query = $db->query("SELECT * FROM cms_content WHERE id = {$_GET['id']}");
    
    if($query->num_rows > 0){
        $cmsData = $query->fetch_assoc();
        echo '<h4>'.$cmsData['title'].'</h4>';
        echo '<p>'.$cmsData['content'].'</p>';
    }else{
        echo 'Content not found....';
    }
}else{
    echo 'Content not found....';
}
?>
