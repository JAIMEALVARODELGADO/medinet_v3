<?php
session_start();
/**
 * crud
 */
class crudmedicameformula{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$idaten=0;
		$guardado=0;
		//Aqui verifico si la formula existe, si no la creo
		$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
		//echo "<br>".$conhis;
		$conhis=mysqli_query($conexion,$conhis);
		if(mysqli_num_rows($conhis)!=0){
			$rowhis=mysqli_fetch_row($conhis);
			$id_aten=$rowhis[0];
		}
		$confor="SELECT id_form FROM consulta_formula WHERE id_aten='$id_aten'";
		//echo "<br>".$confor;
		$confor=mysqli_query($conexion,$confor);
		if(mysqli_num_rows($confor)==0){
			$sql="INSERT INTO consulta_formula(id_aten) VALUES('$id_aten')";
			//echo "<br>".$sql;
			$guardado=mysqli_query($conexion,$sql);
			$id_form=mysqli_insert_id($conexion);
		}
		else{
			$rowfor=mysqli_fetch_row($confor);
			$id_form=$rowfor[0];	
		}
		//Aqui guardo el detalle de la formula		
		$sql="INSERT INTO consulta_formula_detalle (id_form,id_medicamento,dosis_det,frecuencia_det,via_det,tiempo_trat_det,cantidad_det,observacion_det) VALUES ('$id_form','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]')";
		//echo "<br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}

	public function obtenDatos($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_form_det,id_form, id_medicamento,nombre_mto,dosis_det, frecuencia_det, via_det, tiempo_trat_det,cantidad_det, observacion_det FROM vw_formula_detalle WHERE id_form_det='$iddet'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_det' => $ver[0],
			'id_medicamento' => $ver[2],
			'nombre_mto' => $ver[3],
			'dosis_det' => $ver[4], 
			'frecuencia_det' => $ver[5], 
			'via_det' => $ver[6], 
			'tiempo_trat_det' => $ver[7], 
			'cantidad_det' => $ver[8],
			'observacion_det' => $ver[9]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE consulta_formula_detalle SET id_medicamento='$datos[1]', dosis_det='$datos[2]', frecuencia_det='$datos[3]', via_det='$datos[4]', tiempo_trat_det='$datos[5]', cantidad_det='$datos[6]', observacion_det='$datos[7]' WHERE id_form_det='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM consulta_formula_detalle WHERE id_form_det='$iddet'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
