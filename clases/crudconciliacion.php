<?php
session_start();
/**
 * crud
 */
class crudconciliacion{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$valor_conciliar=0;
		$valor_entidad=0;
		$valor_eps=0;
		$valor_ratificado=0;
		if($datos[4]!=''){$valor_conciliar=$datos[4];}
		if($datos[5]!=''){$valor_entidad=$datos[5];}
		if($datos[6]!=''){$valor_eps=$datos[6];}
		if($datos[7]!=''){$valor_ratificado=$datos[7];}
		$guardado=0;
		//Aqui verifico si la factura ya fué conciliada
		$consulta_concil="SELECT id_conciliacion FROM glosa_conciliacion WHERE id_factura='$datos[1]'";
		$consulta_concil=mysqli_query($conexion,$consulta_concil);
		if(mysqli_num_rows($consulta_concil)==0){
			//Aqui consulto el valor de la factura
			$consulta_fac="SELECT valorneto_fac FROM factura_encabezado WHERE id_factura='$datos[1]'";
			$consulta_fac=mysqli_query($conexion,$consulta_fac);
			$rowfac=mysqli_fetch_row($consulta_fac);
			$valorneto_fac=$rowfac[0];

			//Aqui consulto los abonos
			$consulta_abo="SELECT SUM(valor_abono) AS valor_abono FROM glosa_abono WHERE id_factura='$datos[1]'";
			$consulta_abo=mysqli_query($conexion,$consulta_abo);
			$rowabo=mysqli_fetch_row($consulta_abo);
			$valor_abono=$rowabo[0];
			$saldo=$valorneto_fac-$valor_abono;

			$sql="INSERT INTO glosa_conciliacion (id_eps,id_factura,fecha_conciliacion,fecha_firma_concil,valor_conciliar,valor_entidad,valor_eps,valor_ratificado,saldo_concil,observacion_concil,operador_concil)
			VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$valor_conciliar','$valor_entidad','$valor_eps','$valor_ratificado','$saldo','$datos[8]','$_SESSION[gusuario_log]')";
			//echo "<br>".$sql;
			$guardado=mysqli_query($conexion,$sql);
		}
		return $guardado;
	}

	public function obtenDatos($idconcil){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="SELECT id_conciliacion,id_eps,id_factura,fecha_conciliacion,fecha_firma_concil,valor_conciliar,valor_entidad,valor_eps,valor_ratificado,observacion_concil,numero_fac
		FROM vw_glosa_conciliacion WHERE id_conciliacion='$idconcil'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('id_conciliacion' => $ver[0],
			'id_eps' => $ver[1],
			'id_factura' => $ver[2],
			'fecha_conciliacion' => $ver[3],
			'fecha_firma_concil' => $ver[4],
			'valor_conciliar' => $ver[5],
			'valor_entidad' => $ver[6],
			'valor_eps' => $ver[7],
			'valor_ratificado' => $ver[8],
			'observacion_concil' => $ver[9],
			'numero_fac' => $ver[10]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		//Aqui consulto el valor de la factura
		$consulta_fac="SELECT valorneto_fac FROM factura_encabezado WHERE id_factura='$datos[1]'";
		$consulta_fac=mysqli_query($conexion,$consulta_fac);
		$rowfac=mysqli_fetch_row($consulta_fac);
		$valorneto_fac=$rowfac[0];

		//Aqui consulto los abonos
		$consulta_abo="SELECT SUM(valor_abono) AS valor_abono FROM glosa_abono WHERE id_factura='$datos[1]'";
		$consulta_abo=mysqli_query($conexion,$consulta_abo);
		$rowabo=mysqli_fetch_row($consulta_abo);
		$valor_abono=$rowabo[0];
		$saldo=$valorneto_fac-$valor_abono;
		
		$sql="UPDATE glosa_conciliacion SET fecha_conciliacion='$datos[2]',fecha_firma_concil='$datos[3]',valor_conciliar='$datos[4]',valor_entidad='$datos[5]',valor_eps='$datos[6]',valor_ratificado='$datos[7]',saldo_concil='$saldo',observacion_concil='$datos[8]' WHERE id_conciliacion='$datos[0]'";
		//echo $sql;		
		return mysqli_query($conexion,$sql);
	}

	public function eliminar($idconcil){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="DELETE FROM glosa_conciliacion WHERE id_conciliacion='$idconcil'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function cerrar($idconcil){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE glosa_conciliacion SET estado_concil='C' WHERE id_conciliacion='$idconcil'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
