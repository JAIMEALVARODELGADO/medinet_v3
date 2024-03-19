<?php
session_start();
/**
 * crud
 */
class crudact_convenio{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO convenio_detalle (id_convenio, id_servicio, descripcion_cdet, tipo_cdet, codigo_cdet, valor_cdet, estado_cdet)
		VALUES ('$_SESSION[gid_convenio]','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','A')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idcdet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_cdet, descripcion_cdet, tipo_cdet, codigo_cdet,valor_cdet FROM convenio_detalle WHERE id_cdet='$idcdet'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_cdet' => $ver[0],
			'descripcion_cdet' => $ver[1], 
			'tipo_cdet' => $ver[2], 
			'codigo_cdet' => $ver[3], 
			'valor_cdet' => $ver[4]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE convenio_detalle SET descripcion_cdet='$datos[1]', tipo_cdet='$datos[2]', codigo_cdet='$datos[3]', valor_cdet='$datos[4]' WHERE id_cdet='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	/*public function eliminar($idconv){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM convenio_encabezado WHERE id_convenio='$idconv'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}*/

	public function cambiarestado($idcdet){
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
	}
}
?>
