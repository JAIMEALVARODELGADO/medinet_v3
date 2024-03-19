<?php
/**
 * crud
 */
class crudeps{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO eps (codigo_eps,nit_eps,nombre_eps,direccion_eps,telefono_eps,contacto_eps)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($ideps){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_eps,codigo_eps, nit_eps, nombre_eps, direccion_eps, telefono_eps, contacto_eps FROM eps WHERE id_eps='$ideps'";
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
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE eps SET codigo_eps='$datos[1]', nit_eps='$datos[2]', nombre_eps='$datos[3]', direccion_eps='$datos[4]', telefono_eps='$datos[5]', contacto_eps='$datos[6]' WHERE id_eps='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($ideps){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM eps WHERE id_eps='$ideps'";
		return mysqli_query($conexion,$sql);
	}
}
?>
