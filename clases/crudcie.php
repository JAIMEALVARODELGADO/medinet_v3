<?php
/**
 * crud
 */
class crudcie{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO cie (codigo_cie,descripcion_cie,estado_cie)
		VALUES ('$datos[0]','$datos[1]','A')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idcie){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_cie,codigo_cie,descripcion_cie FROM cie WHERE id_cie='$idcie'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_cie' => $ver[0],
			'codigo_cie' => $ver[1], 
			'descripcion_cie' => $ver[2]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE cie SET codigo_cie='$datos[1]', descripcion_cie='$datos[2]' WHERE id_cie='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idcie){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_cie FROM cie WHERE id_cie='$idcie'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE cie SET estado_cie='$estado' WHERE id_cie='$idcie'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
