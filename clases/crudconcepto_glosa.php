<?php
/**
 * crud
 */
class crudconcepto_glosa{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO concepto_glosa (id_glosacod,codigo_conglo,descripcion_conglo)
		VALUES ('$datos[0]','$datos[1]','$datos[2]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($id_conglo){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_conglo,id_glosacod,codigo_conglo,descripcion_conglo FROM concepto_glosa WHERE id_conglo='$id_conglo'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_conglo' => $ver[0],
			'id_glosacod' => $ver[1], 
			'codigo_conglo' => $ver[2],
			'descripcion_conglo' => $ver[3]			
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE concepto_glosa SET id_glosacod='$datos[1]', codigo_conglo='$datos[2]',descripcion_conglo='$datos[3]' WHERE id_conglo='$datos[0]'";		
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
