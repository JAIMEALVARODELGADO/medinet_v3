<?php
/**
 * crud
 */
class crudentidad{		
	public function obtenDatos($ident){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_ent,nombre_ent,direccion_ent,telefono_ent,textofactura_ent,tipoiden_ent,numeroiden_ent,codigopres_ent,prefijofac_ent,tituloenc_ent,nombreenc_ent FROM entidad WHERE id_ent='$ident'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_ent' => $ver[0],
			'nombre_ent' => $ver[1], 
			'direccion_ent' => $ver[2],
			'telefono_ent' => $ver[3],
			'textofactura_ent' => $ver[4],
			'tipoiden_ent' => $ver[5],
			'numeroiden_ent' => $ver[6],
			'codigopres_ent' => $ver[7],
			'prefijofac_ent' => $ver[8],
			'tituloenc_ent' => $ver[9],
			'nombreenc_ent' => $ver[10]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE entidad SET nombre_ent='$datos[1]', direccion_ent='$datos[2]', telefono_ent='$datos[3]', textofactura_ent='$datos[4]', tipoiden_ent='$datos[5]', numeroiden_ent='$datos[6]', codigopres_ent='$datos[7]',prefijofac_ent='$datos[8]',tituloenc_ent='$datos[9]',nombreenc_ent='$datos[10]' WHERE id_ent='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
