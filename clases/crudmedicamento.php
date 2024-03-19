<?php
/**
 * crud
 */
class crudmedicamento{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO medicamento (codigoatc_mto,nombre_mto,estado_mto,tipo_mto)
		VALUES ('$datos[0]','$datos[1]','A','$datos[2]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idmed){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_medicamento,codigoatc_mto,nombre_mto,tipo_mto FROM medicamento WHERE id_medicamento='$idmed'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_medicamento' => $ver[0],
			'codigoatc_mto' => $ver[1], 
			'nombre_mto' => $ver[2],
			'tipo_mto' => $ver[3],
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE medicamento SET codigoatc_mto='$datos[1]', nombre_mto='$datos[2]',tipo_mto='$datos[3]' WHERE id_medicamento='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function cambiarestado($idmed){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_mto FROM medicamento WHERE id_medicamento='$idmed'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE medicamento SET estado_mto='$estado' WHERE id_medicamento='$idmed'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
