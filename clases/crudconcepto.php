<?php
/**
 * crud
 */
class crudconcepto{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO detalle_grupo (id_grupo,descripcion_det,valor_det)
		VALUES ('$datos[0]','$datos[1]','$datos[2]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idconcep){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT codi_det,id_grupo,descripcion_det,valor_det FROM detalle_grupo WHERE codi_det='$idconcep'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_detalle' => $ver[0],
			'id_grupo' => $ver[1], 
			'descripcion_det' => $ver[2],
			'valor_det' => $ver[3]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE detalle_grupo SET id_grupo='$datos[1]', descripcion_det='$datos[2]',valor_det='$datos[3]' WHERE codi_det='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
