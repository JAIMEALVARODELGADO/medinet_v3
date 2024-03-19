<?php
session_start();
/**
 * crud
 */
class crudusuario{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$idcon=0;
		$guardado=0;		
		$sql="INSERT INTO usuario(id_persona, login_usu, password_usu, profesion_usu, registro_usu, cargo_usu, agendar_usu, estado_usu,tomasignos_usu,examenfis_usu) VALUES('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','A','$datos[7]','$datos[8]')";
		//echo $sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}

	public function obtenDatos($idusu){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_persona,login_usu,password_usu,profesion_usu,registro_usu,cargo_usu,agendar_usu,tomasignos_usu,examenfis_usu FROM usuario WHERE id_persona='$idusu'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_persona' => $ver[0],
			'login_usu' => $ver[1],
			'password_usu' => $ver[2],
			'profesion_usu' => $ver[3], 
			'registro_usu' => $ver[4], 
			'cargo_usu' => $ver[5], 
			'agendar_usu' => $ver[6],
			'tomasignos_usu' => $ver[7],
			'examenfis_usu' => $ver[8]
			);
		return $datos;
	}

	public function obtenDatosexamen($idusu){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT usuario.id_persona,examenfisico_medico.id_mef
		FROM usuario 
		LEFT JOIN examenfisico_medico ON examenfisico_medico.id_persona=usuario.id_persona
		WHERE usuario.id_persona='$idusu'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_persona' => $ver[0],
			'id_mef' => $ver[1]		
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		if($datos[2]<>$datos[3]){
			$passw=sha1($datos[2]);
			$sql="UPDATE usuario SET password_usu='$passw' WHERE id_persona='$datos[0]'";
			//echo $sql;
			mysqli_query($conexion,$sql);
		}

		$sql="UPDATE usuario SET login_usu='$datos[1]', profesion_usu='$datos[4]', registro_usu='$datos[5]', cargo_usu='$datos[6]', agendar_usu='$datos[7]', tomasignos_usu='$datos[8]', examenfis_usu='$datos[9]' WHERE id_persona='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function actualizar_examen($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		$sqlexamenprof="SELECT id_exmed,id_mef,id_persona FROM examenfisico_medico WHERE id_persona='$datos[0]'";
		//echo $sqlexamenprof;				
		$sqlexamenprof=mysqli_query($conexion,$sqlexamenprof);
		if(mysqli_num_rows($sqlexamenprof)==0){
			$sql="INSERT INTO examenfisico_medico(id_mef,id_persona) VALUES ($datos[1],$datos[0])";
		}
		else{
			$sql="UPDATE examenfisico_medico SET id_mef='$datos[1]' WHERE id_persona='$datos[0]'";
		}
		if($datos[1]==0){
			$sql="DELETE FROM examenfisico_medico WHERE id_persona='$datos[0]'";
		}
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}


	public function cambiarestado($idusu){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_usu FROM usuario WHERE id_persona='$idusu'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";
		}
		else{
			$estado="A";
		}
		$sql="UPDATE usuario SET estado_usu='$estado' WHERE id_persona='$idusu'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
