<?php
/**
 * crud
 */
class crudcups{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO cups (codigo_cups,descripcion_cups,estado_cups,norma_cups)
		VALUES ('$datos[0]','$datos[1]','A','$datos[2]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idcups){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_cups,codigo_cups,descripcion_cups,norma_cups FROM cups WHERE id_cups='$idcups'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_cups' => $ver[0],
			'codigo_cups' => $ver[1], 
			'descripcion_cups' => $ver[2],
			'norma_cups' => $ver[3]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE cups SET codigo_cups='$datos[1]', descripcion_cups='$datos[2]',norma_cups='$datos[3]' WHERE id_cups='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idcups){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_cups FROM cups WHERE id_cups='$idcups'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE cups SET estado_cups='$estado' WHERE id_cups='$idcups'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
