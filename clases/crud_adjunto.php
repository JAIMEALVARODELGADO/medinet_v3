<?php
/**
 * crud
 */
class crudadjunto{
	
	public function agregar($datos){
		//$obj=new conectar();
		//echo "<br>".$datos[0];
		//echo "<br>".$datos[1];
		/*$conexion=$obj->conexion();

		$sql="INSERT INTO medicamento (codigoatc_mto,nombre_mto,estado_mto,tipo_mto)
		VALUES ('$datos[0]','$datos[1]','A','$datos[2]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);*/
		//return($mensaje);

	}

	public function obtenDatos($idadj){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_adjunto,descripcion_adj,archivo_adj FROM consulta_adjunto WHERE id_adjunto='$idadj'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_adjunto' => $ver[0],
			'descripcion_adj' => $ver[1],
			'archivo_adj' => $ver[2]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE consulta_adjunto SET descripcion_adj='$datos[1]' WHERE id_adjunto='$datos[0]'";
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idadj){
		//Aqui elimino el archivo
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT archivo_adj FROM consulta_adjunto WHERE id_adjunto='$idadj'";
		//echo $sql;
		$cons=mysqli_query($conexion,$sql);
		$row=mysqli_fetch_row($cons);
		if(!empty($row[0])){
			$archivo="../adjuntos/".$row[0];
			unlink($archivo);
		}
		
		$sql="DELETE FROM consulta_adjunto WHERE id_adjunto='$idadj'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
