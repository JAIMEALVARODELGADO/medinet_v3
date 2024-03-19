<?php
/**
 * crud
 */
class crudpersona{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO persona (tipo_iden_per,numero_iden_per,pnom_per,snom_per,pape_per,sape_per,fnac_per,sexo_per,direccion_per,telefono_per,email_per)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]','$datos[9]','$datos[10]')";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idpersona){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT persona.id_persona, persona.tipo_iden_per, persona.numero_iden_per, persona.pnom_per, persona.snom_per, persona.pape_per, persona.sape_per, persona.fnac_per,persona.sexo_per, persona.direccion_per,persona.telefono_per,persona.email_per FROM persona 
			WHERE id_persona='$idpersona'";
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_persona' => $ver[0],
			'tipo_iden_per' => $ver[1], 
			'numero_iden_per' => $ver[2], 
			'pnom_per' => $ver[3],
			'snom_per' => $ver[4], 
			'pape_per' => $ver[5], 
			'sape_per' => $ver[6], 
			'fnac_per' => $ver[7],
			'sexo_per' => $ver[8],
			'direccion_per' => $ver[9],
			'telefono_per' => $ver[10],
			'email_per' => $ver[11]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE persona SET tipo_iden_per='$datos[1]', numero_iden_per='$datos[2]', pnom_per='$datos[3]', snom_per='$datos[4]', pape_per='$datos[5]', sape_per='$datos[6]', fnac_per='$datos[7]', sexo_per='$datos[8]', direccion_per='$datos[9]', telefono_per='$datos[10]', email_per='$datos[11]' WHERE id_persona='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($ideps){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM eps WHERE id_eps='$ideps'";
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatospaciente($idpersona){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_persona,codigo_mun,zona,tipo_usuario,etnia, nivel_educ, id_ciuo, estado_civ FROM paciente 
			WHERE id_persona='$idpersona'";
		//echo "<br>".$sql;	
		$row=mysqli_query($conexion,$sql);
		if(mysqli_num_rows($row)<>0){
			$ver=mysqli_fetch_row($row);
			$datos=array(
			'id_persona' => $ver[0],
			'codigo_mun' => $ver[1], 
			'zona' => $ver[2], 
			'tipo_usuario' => $ver[3],
			'etnia' => $ver[4], 
			'nivel_educ' => $ver[5], 
			'id_ciuo' => $ver[6], 
			'estado_civ' => $ver[7]
			);			
		}
		else{
			$datos=array(
			'id_persona' => $idpersona,
			'codigo_mun' => '', 
			'zona' => '', 
			'tipo_usuario' => '',
			'etnia' => '', 
			'nivel_educ' => '', 
			'id_ciuo' => '', 
			'estado_civ' => ''
			);
		}		
		return $datos;
	}

	public function actualizarpaciente($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$consulta="SELECT id_persona FROM paciente WHERE id_persona='$datos[0]'";
		//echo $consulta;
		$consulta=mysqli_query($conexion,$consulta);
		if(mysqli_num_rows($consulta)==0){
			$sql="INSERT INTO paciente(id_persona,codigo_mun, zona, tipo_usuario, etnia, nivel_educ, id_ciuo, estado_civ) VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]','$datos[5]', '$datos[6]', '$datos[7]')";
		}
		else{
			$sql="UPDATE paciente SET codigo_mun='$datos[1]', zona='$datos[2]', tipo_usuario='$datos[3]', etnia='$datos[4]', nivel_educ='$datos[5]', id_ciuo='$datos[6]', estado_civ='$datos[7]' WHERE id_persona='$datos[0]'";	
		}
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

}
?>
