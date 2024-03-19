<?php
/**
 * crud
 */
class crudlogin{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		/*$sql="INSERT INTO eps (codigo_eps,nit_eps,nombre_eps,direccion_eps,telefono_eps,contacto_eps)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')";
		return mysqli_query($conexion,$sql);*/
	}

	public function obtenDatos($usuario,$login){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_persona,login_usu,password_usu,nombre FROM vw_usuario WHERE login_usu='$usuario' AND password_usu='$login' AND estado_usu='A'";
		//echo "<br>".$sql;
		$sql=mysqli_query($conexion,$sql);
		if(mysqli_num_rows($sql)==0){
			$datos=array(
			'id_persona' => '',
			'nombre_usu' => '');
		}
		else{
			$row=mysqli_fetch_row($sql);
			$datos=array(
			'id_persona' => $row[0],
			'nombre_usu' => $row[3]
			);
		}
		return $datos;
	}

	/*public function actualizar($datos){
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
	}*/
}
?>
