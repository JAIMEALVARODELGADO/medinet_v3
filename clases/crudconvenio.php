<?php
/**
 * crud
 */
class crudconvenio{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO convenio_encabezado (id_eps, numero_conv, fecha_conv, observacion_conv,estado_conv)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','A')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idconv){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_convenio, numero_conv, id_eps, fecha_conv,observacion_conv FROM convenio_encabezado WHERE id_convenio='$idconv'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_convenio' => $ver[0],
			'numero_conv' => $ver[1], 
			'id_eps' => $ver[2], 
			'fecha_conv' => $ver[3], 
			'observacion_conv' => $ver[4]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE convenio_encabezado SET numero_conv='$datos[1]', fecha_conv='$datos[2]', observacion_conv='$datos[3]' WHERE id_convenio='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idconv){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM convenio_encabezado WHERE id_convenio='$idconv'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idconv){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_conv FROM convenio_encabezado WHERE id_convenio='$idconv'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE convenio_encabezado SET estado_conv='$estado' WHERE id_convenio='$idconv'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
