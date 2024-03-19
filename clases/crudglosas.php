<?php
session_start();
/**
 * crud
 */
class crudglosas{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$valor_fav_glo=0;
		$valor_fav_eps=0;
		//if($datos[8]!=''){$valor_fav_glo=$datos[8];}
		//if($datos[9]!=''){$valor_fav_eps=$datos[9];}
		$sql="INSERT INTO glosa (fecharecep_glo,id_eps,id_factura,valor_glo,motivo_glo,fechaentrega_glo,responsable_resp_glo,fecha_envio_glo,valor_fav_glo,valor_fav_eps,guia_glo,operador_glo)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$datos[7]','$valor_fav_glo','$valor_fav_eps','$datos[8]','$_SESSION[gusuario_log]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idglosa){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT id_glosa,fecharecep_glo,id_eps,glosa.id_factura,valor_glo,motivo_glo,fechaentrega_glo,responsable_resp_glo,fecha_envio_glo,valor_fav_glo,valor_fav_eps,guia_glo,factura_encabezado.numero_fac
		FROM glosa 
		INNER JOIN factura_encabezado ON factura_encabezado.id_factura=glosa.id_factura
		WHERE id_glosa='$idglosa'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_glosa' => $ver[0],
			'fecharecep_glo' => $ver[1],
			'id_eps' => $ver[2],
			'id_factura' => $ver[3],
			'valor_glo' => $ver[4],
			'motivo_glo' => $ver[5],
			'fechaentrega_glo' => $ver[6],
			'responsable_resp_glo' => $ver[7],
			'fecha_envio_glo' => $ver[8],
			'valor_fav_glo' => $ver[9],
			'valor_fav_eps' => $ver[10],
			'guia_glo' => $ver[11],
			'numero_fac' => $ver[12]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		//fecharecep_glo='$datos[1]',id_eps='$datos[2]',id_factura='$datos[3]'
		$sql="UPDATE glosa SET valor_glo='$datos[1]', motivo_glo='$datos[2]', fechaentrega_glo='$datos[3]',responsable_resp_glo='$datos[4]',fecha_envio_glo='$datos[5]',guia_glo='$datos[6]', respuesta_glo='$datos[7]' WHERE id_glosa='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idconv){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM convenio_encabezado WHERE id_convenio='$idconv'";
		//echo $sql;
		//return mysqli_query($conexion,$sql);
	}

	public function cerrar($idglosa){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE glosa SET estado_glo='C' WHERE id_glosa='$idglosa'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
