<?php
/**
 * crud
 */
class crudfurips_persona{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="INSERT INTO furips_persona (tipo_ident,numero_ident,pape_per,sape_per,pnom_per,snom_per,direccion_per,telefono_per,municipio_per)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$datos[8]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idpersona){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_persona,tipo_ident,numero_ident,pape_per,sape_per,pnom_per,snom_per,direccion_per,telefono_per,municipio_per FROM furips_persona WHERE id_persona='$idpersona'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_persona' => $ver[0],
			'tipo_ident' => $ver[1], 
			'numero_ident' => $ver[2], 
			'pape_per' => $ver[3], 
			'sape_per' => $ver[4],
			'pnom_per' => $ver[5],
			'snom_per' => $ver[6],
			'direccion_per' => $ver[7],
			'telefono_per' => $ver[8],
			'municipio_per' => $ver[9]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE furips_persona SET tipo_ident='$datos[1]',numero_ident='$datos[2]',pape_per='$datos[3]',sape_per='$datos[4]',pnom_per='$datos[5]',snom_per='$datos[6]',direccion_per='$datos[7]',telefono_per='$datos[8]',municipio_per='$datos[9]' WHERE id_persona='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}	
}
?>
