<?php
/**
 * crud
 */
class crudexamen{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO mae_examenfisico(descripcion_mef)
		VALUES ('$datos[0]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idmef){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_mef, descripcion_mef FROM mae_examenfisico WHERE id_mef='$idmef'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_mef' => $ver[0],
			'descripcion_mef' => $ver[1]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE mae_examenfisico SET descripcion_mef='$datos[1]' WHERE id_mef='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idmef){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM mae_examenfisico WHERE id_mef='$idmef'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idmef){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_mef FROM mae_examenfisico WHERE id_mef='$idmef'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE mae_examenfisico SET estado_mef='$estado' WHERE id_mef='$idmef'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
