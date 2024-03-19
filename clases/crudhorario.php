<?php
session_start();
/**
 * crud
 */
class crudhorario{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;

		$semana=array();
		if($datos[7]=='S'){array_push($semana,0);}
		if($datos[8]=='S'){array_push($semana,1);}
		if($datos[9]=='S'){array_push($semana,2);}
		if($datos[10]=='S'){array_push($semana,3);}
		if($datos[11]=='S'){array_push($semana,4);}
		if($datos[12]=='S'){array_push($semana,5);}
		if($datos[13]=='S'){array_push($semana,6);}
		//echo "<br>elemento::: ".$semana[0];
		$fecha=$datos[1];
		$fecha_fin=$datos[3];
		$minutos=$datos[5];
		$turnos=$datos[6];
		while($fecha<=$fecha_fin){
			$dia=date("w",strtotime($fecha));
			//echo "<br>Dia::".$dia;
			if(in_array($dia, $semana)) {
    			$fechadia=$fecha.' '.$datos[2];
				$fechadia_fin=$fecha.' '.$datos[4];
				while($fechadia<=$fechadia_fin){
					//echo "<br>".$fechadia;
					$fechadia = strtotime ( '+'.$minutos.' minute' , strtotime($fechadia) ) ; 
					$fechadia = date ( 'Y-m-j H:i:s' , $fechadia);
					//echo "<br>Fecha resultado dia::: ".$fechadia;
					for($c=1;$c<=$turnos;$c++){
						$sql="INSERT INTO agenda_horario(id_persona, fecha_agh, estado_agh, operador_agh)
						VALUES ('$datos[0]','$fechadia','PE','$_SESSION[gusuario_log]')";
						//echo "<br>".$sql;
						$guardado=mysqli_query($conexion,$sql);
					}
				}
			}
			$fecha = strtotime ( '+1 day' , strtotime($fecha) ) ; 
			$fecha = date ( 'Y-m-j' , $fecha);
			//echo "<br><br>Fecha resultado".$fecha;
		}		
		return $guardado;
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

	public function eliminar($idagh){
		$obj=new conectar();
		$conexion=$obj->conexion();		

		$sql="DELETE FROM agenda_horario WHERE id_agh='$idagh' AND estado_agh='PE'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
