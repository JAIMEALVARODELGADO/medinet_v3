<?php
session_start();

class crudcita{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE agenda_horario SET estado_agh='US' WHERE id_agh='$datos[3]'";
		//echo $sql;
		mysqli_query($conexion,$sql);
		
		$sql="INSERT INTO agenda_cita (id_agh, id_persona, id_eps, estado_agc, observacion_agc, operador_agc)
		VALUES ('$datos[3]','$datos[0]','$datos[1]','Solicitada','$datos[4]','$_SESSION[gusuario_log]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}


	public function cancelar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE agenda_horario SET estado_agh='PE' WHERE id_agh='$datos[1]'";
		//echo "<br>".$sql;
		mysqli_query($conexion,$sql);

		if(!empty($datos[0])){
			$sql="UPDATE agenda_cita SET observacion_agc='$datos[2]' WHERE id_agc='$datos[0]'";
			//echo "<br>".$sql;
			mysqli_query($conexion,$sql);
		}

		$sql="UPDATE agenda_cita SET estado_agc='Cancelada' WHERE id_agc='$datos[0]'";
		//echo "<br>".$sql;
		return mysqli_query($conexion,$sql);
	}

	public function trasladar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE agenda_horario SET id_persona=$datos[2] WHERE id_agh='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

}
?>
