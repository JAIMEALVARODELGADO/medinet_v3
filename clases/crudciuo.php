<?php
/**
 * crud
 */
class crudciuo{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO ciuo (codigo_ciuo,descripcion_ciu,estado_ciuo)
		VALUES ('$datos[0]','$datos[1]','A')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idciuo){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_ciuo,codigo_ciuo,descripcion_ciu FROM ciuo WHERE id_ciuo='$idciuo'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_ciuo' => $ver[0],
			'codigo_ciuo' => $ver[1], 
			'descripcion_ciu' => $ver[2]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE ciuo SET codigo_ciuo='$datos[1]', descripcion_ciu='$datos[2]' WHERE id_ciuo='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idciuo){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_ciuo FROM ciuo WHERE id_ciuo='$idciuo'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE ciuo SET estado_ciuo='$estado' WHERE id_ciuo='$idciuo'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
