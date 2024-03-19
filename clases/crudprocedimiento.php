<?php
session_start();
/**
 * crud
 */
class crudprocedimiento{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$idaten=0;
		$guardado=0;
		$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
		//echo "<br>".$conhis;
		$conhis=mysqli_query($conexion,$conhis);
		if(mysqli_num_rows($conhis)==0){
			$sql="INSERT INTO atencion(id_agc,id_profesional,estado_aten) VALUES('$_SESSION[gid_agc]','$_SESSION[gusuario_log]','A')";
			echo "<br>".$sql;
			$guardado=mysqli_query($conexion,$sql);
			$id_aten=mysqli_insert_id($conexion);
			$sql="UPDATE agenda_cita SET estado_agc='En Atencion' WHERE id_agc='$_SESSION[gid_agc]'";
			mysqli_query($conexion,$sql);
		}
		else{
			$rowhis=mysqli_fetch_row($conhis);
			$id_aten=$rowhis[0];
		}

		//Aqui guardo el procedimiento
		$dxrelac_proc=$datos[4];
		$complic_proc=$datos[5];
		$forma_proc=$datos[6];
		if($datos[4]==''){$dxrelac_proc=0;}
		if($datos[5]==''){$complic_proc=0;}
		if($datos[6]==''){$forma_proc=0;}
		
		$sql="INSERT INTO procedimiento (id_aten,id_cups,ambito_proc,finalidad_proc,dxprinc_proc,dxrelac_proc,complic_proc,forma_proc,observacion_proc) VALUES ('$id_aten','$datos[0]','$datos[1]','$datos[2]','$datos[3]','$dxrelac_proc','$complic_proc','$forma_proc','$datos[7]')";
		//echo "<br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		//echo "guardado... ".$guardado;
		return $guardado;
	}

	public function obtenDatos($idproc){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		$sql="SELECT id_procedimiento,id_cups,ambito_proc,finalidad_proc,descrip_dxpr,dxprinc_proc,descrip_dxrel,dxrelac_proc,descrip_compli,complic_proc,forma_proc,observacion_proc FROM vw_procedimiento WHERE id_procedimiento='$idproc'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_procedimiento' => $ver[0],
			'id_cups' => $ver[1],
			'ambito_proc' => $ver[2],
			'finalidad_proc' => $ver[3],
			'dxprinc' => $ver[4],
			'dxprinc_proc' => $ver[5],
			'dxrelac' => $ver[6],
			'dxrelac_proc' => $ver[7],
			'complic' => $ver[8],
			'complic_proc' => $ver[9], 
			'forma_proc' => $ver[10],
			'observacion_proc' => $ver[11]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		$dxrelac_proc=$datos[5];
		$complic_proc=$datos[6];
		$forma_proc=$datos[7];
		if($datos[5]==''){$dxrelac_proc=0;}
		if($datos[6]==''){$complic_proc=0;}
		if($datos[7]==''){$forma_proc=0;}

		$sql="UPDATE procedimiento SET id_cups='$datos[1]', ambito_proc='$datos[2]', finalidad_proc='$datos[3]', dxprinc_proc='$datos[4]', dxrelac_proc='$dxrelac_proc', complic_proc='$complic_proc', forma_proc='$forma_proc',observacion_proc='$datos[8]' WHERE id_procedimiento='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idproc){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM procedimiento WHERE id_procedimiento='$idproc'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
