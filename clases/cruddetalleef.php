<?php
session_start();
/**
 * crud
 */
class cruddetalleef{	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO det_examenfisico (id_mef, descripcion_def)
		VALUES ('$_SESSION[gid_mef]','$datos[0]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($iddef){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_def, descripcion_def FROM det_examenfisico WHERE id_def='$iddef'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_def' => $ver[0],
			'descripcion_def' => $ver[1]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE det_examenfisico SET descripcion_def='$datos[1]' WHERE id_def='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($iddef){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM det_examenfisico WHERE id_def='$iddef'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	/*public function cambiarestado($idcdet){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_cdet FROM convenio_detalle WHERE id_cdet='$idcdet'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE convenio_detalle SET estado_cdet='$estado' WHERE id_cdet='$idcdet'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}*/
}
?>
