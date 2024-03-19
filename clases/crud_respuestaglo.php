<?php
session_start();
/**
 * crud
 */
class crud_respuestaglo{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$id_detfac=0;
		if($datos[0]!=''){$id_detfac=$datos[0];}
		$sql="INSERT INTO glosa_respuesta (id_glosa,id_detfac,id_persona,fechacont_resp,id_conglo,valoracepta_resp,observacion_resp) VALUES ('$_SESSION[gid_glosa]','$id_detfac','$_SESSION[gusuario_log]','$datos[1]','$datos[2]','$datos[3]','$datos[4]')";
		//echo $sql;
		$query=mysqli_query($conexion,$sql);
		$this->act_valor();
		return ($query);
	}

	public function obtenDatos($idresp){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_resp, id_detfac, fechacont_resp,id_conglo,valoracepta_resp,observacion_resp FROM glosa_respuesta WHERE id_resp='$idresp'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_resp' => $ver[0],
			'id_detfac' => $ver[1], 
			'fechacont_resp' => $ver[2], 
			'id_conglo' => $ver[3], 
			'valoracepta_resp' => $ver[4],
			'observacion_resp' => $ver[5]
			);		
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE glosa_respuesta SET id_detfac='$datos[1]', fechacont_resp='$datos[2]', id_conglo='$datos[3]', valoracepta_resp='$datos[4]',observacion_resp='$datos[5]' WHERE id_resp='$datos[0]'";
		//echo $sql;
		$query=mysqli_query($conexion,$sql);
		$this->act_valor();
		return ($query);
	}

	private function act_valor(){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$constot="SELECT SUM(valoracepta_resp) AS valoracepta FROM glosa_respuesta WHERE estado_resp='A' AND id_glosa='$_SESSION[gid_glosa]'";
		$constot=mysqli_query($conexion,$constot);
		$rowtot=mysqli_fetch_row($constot);
		$valoracepta=$rowtot[0];		
		$sql="UPDATE glosa SET valor_fav_eps='$valoracepta',valor_fav_glo=valor_glo-$valoracepta WHERE id_glosa='$_SESSION[gid_glosa]'";
		mysqli_query($conexion,$sql);		
	}

	public function anular($idresp){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE glosa_respuesta SET estado_resp='N' WHERE id_resp='$idresp'";
		$query=mysqli_query($conexion,$sql);
		$this->act_valor();
		return ($query);
	}
}
?>
