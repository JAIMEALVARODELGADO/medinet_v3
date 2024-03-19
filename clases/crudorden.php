<?php

class crudorden{
	public function agregarord($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;

		$consorden="SELECT id_ord FROM consulta_orden WHERE id_aten='$datos[0]' AND tipo_ord='$datos[1]'";
		//echo "<br>".$consorden;
		$consorden=mysqli_query($conexion,$consorden);
		if(mysqli_num_rows($consorden)!=0){
			$roworden=mysqli_fetch_row($consorden);
			$id_ord=$roworden[0];
		}
		else{
			$sql="INSERT INTO consulta_orden(id_aten, tipo_ord)
			VALUES ('$datos[0]','$datos[1]')";
			$guardado=mysqli_query($conexion,$sql);
			$id_ord=mysqli_insert_id($conexion);
		}
		$sql="INSERT INTO consulta_orden_detalle(id_ord,id_cups,observacion_det)
		VALUES('$id_ord','$datos[2]','$datos[3]')";
		//echo "<br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		
		return $guardado;
	}

	public function obtenDatos($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_ord_det,id_cups,observacion_det,descripcion_cups FROM vw_orden_detalle WHERE id_ord_det='$iddet'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_ord_det' => $ver[0],
			'id_cups' => $ver[1], 
			'observacion_det' => $ver[2], 
			'descripcion_cups' => $ver[3]
			);
		return $datos;
	}

	public function actualizardet($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE consulta_orden_detalle SET id_cups='$datos[1]', observacion_det='$datos[2]' WHERE id_ord_det='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminarorden($idord){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM consulta_orden_detalle WHERE id_ord='$idord'";
		//echo "<br>".$sql;
		mysqli_query($conexion,$sql);

		$sql="DELETE FROM consulta_orden WHERE id_ord='$idord'";
		//echo "<br>".$sql;
		
		return mysqli_query($conexion,$sql);
	}

	public function eliminardetalle($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM consulta_orden_detalle WHERE id_ord_det='$iddet'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

}
?>
