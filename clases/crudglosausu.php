<?php
/**
 * crud
 */
class crudglosausu{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="INSERT INTO concepto_persona (id_persona,id_conglo)
		VALUES ('$datos[0]','$datos[1]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idconper){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_conper,id_persona,id_conglo FROM vw_glosa_persona WHERE id_conper='$idconper'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_conper' => $ver[0],			
			'id_persona' => $ver[1],
			'id_conglo' => $ver[2]			
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE concepto_persona SET id_conglo='$datos[1]' WHERE id_conper='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idconper){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="DELETE FROM concepto_persona WHERE id_conper='$idconper'";
		return mysqli_query($conexion,$sql);
	}
	
}
?>
