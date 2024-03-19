<?php
session_start();
/**
 * crud
 */
class crudabono{
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$consulta_concil="SELECT id_conciliacion,saldo_concil FROM glosa_conciliacion WHERE id_factura='$datos[1]'";
		$consulta_concil=mysqli_query($conexion,$consulta_concil);				
		if(mysqli_num_rows($consulta_concil)<>0){
			$rowconcil=mysqli_fetch_row($consulta_concil);			
			$saldo=$rowconcil[1]-$datos[4];			
			$sql="UPDATE glosa_conciliacion SET saldo_concil='$saldo' WHERE id_conciliacion='$rowconcil[0]'";
			mysqli_query($conexion,$sql);			
		}

		$sql="INSERT INTO glosa_abono (id_eps,id_factura,fecha_abono,documento_abono,valor_abono,dias_mora_abono,observacion_abono,operador_abono)
			VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','$datos[6]','$_SESSION[gusuario_log]')";
		//echo "<br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}

	public function obtenDatos($idabono){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="SELECT id_abono,id_eps,id_factura,fecha_abono,documento_abono,valor_abono,dias_mora_abono,observacion_abono,numero_fac FROM vw_glosa_abono WHERE id_abono='$idabono'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array('id_abono' => $ver[0],
			'id_eps' => $ver[1],
			'id_factura' => $ver[2],
			'fecha_abono' => $ver[3],
			'documento_abono' => $ver[4],
			'valor_abono' => $ver[5],			
			'dias_mora_abono' => $ver[6],
			'observacion_abono' => $ver[7],
			'numero_fac' => $ver[8]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="UPDATE glosa_abono SET fecha_abono='$datos[2]',documento_abono='$datos[3]',valor_abono='$datos[4]',	dias_mora_abono='$datos[5]',observacion_abono='$datos[6]' WHERE id_abono='$datos[0]'";
		//echo $sql;
		$guardado=mysqli_query($conexion,$sql);

		//Aqui consulto si existe una conciliación.
		$consulta_concil="SELECT id_conciliacion,saldo_concil FROM glosa_conciliacion WHERE id_factura='$datos[1]'";
		$consulta_concil=mysqli_query($conexion,$consulta_concil);				
		if(mysqli_num_rows($consulta_concil)<>0){
			$rowconcil=mysqli_fetch_row($consulta_concil);
			$id_conciliacion=$rowconcil[0];
			//Aqui consulto el saldo
			$consaldo="SELECT (factura_encabezado.valorneto_fac)-(SUM(glosa_abono.valor_abono)) AS saldo 
			FROM factura_encabezado 
			INNER JOIN glosa_abono ON glosa_abono.id_factura=factura_encabezado.id_factura
			WHERE factura_encabezado.id_factura='$datos[1]'";
			//echo $consalado;
			$consaldo=mysqli_query($conexion,$consaldo);
			$rowsaldo=mysqli_fetch_row($consaldo);
			$saldo=$rowsaldo[0];
			//echo $saldo;
			$sql="UPDATE glosa_conciliacion SET saldo_concil='$saldo' WHERE id_conciliacion='$id_conciliacion'";
			//echo $sql;
			mysqli_query($conexion,$sql);			
		}
		return $guardado;
	}

	public function eliminar($idabono){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		//Aqui consulto el identificador de la factura, para actualizar el saldo en la conciliacion
		$consulta_fac="SELECT id_factura FROM glosa_abono WHERE id_abono='$idabono'";
		$consulta_fac=mysqli_query($conexion,$consulta_fac);
		$rowfac=mysqli_fetch_row($consulta_fac);
		$id_factura=$rowfac[0];

		$sql="DELETE FROM glosa_abono WHERE id_abono='$idabono'";
		//echo $sql;
		$borrado=mysqli_query($conexion,$sql);

		//Aqui consulto si existe una conciliación.		
		$consulta_concil="SELECT id_conciliacion,saldo_concil FROM glosa_conciliacion WHERE id_factura='$id_factura'";
		$consulta_concil=mysqli_query($conexion,$consulta_concil);				
		if(mysqli_num_rows($consulta_concil)<>0){
			$rowconcil=mysqli_fetch_row($consulta_concil);
			$id_conciliacion=$rowconcil[0];
			//Aqui consulto el saldo
			$consaldo="SELECT factura_encabezado.valorneto_fac,(factura_encabezado.valorneto_fac)-(SUM(glosa_abono.valor_abono)) AS saldo
			FROM factura_encabezado
			INNER JOIN glosa_abono ON glosa_abono.id_factura=factura_encabezado.id_factura			
			WHERE factura_encabezado.id_factura='$id_factura'";
			//echo $consaldo;
			$consaldo=mysqli_query($conexion,$consaldo);
			$rowsaldo=mysqli_fetch_row($consaldo);
			//$saldo=$rowsaldo[1];
			if(is_null($rowsaldo[1])){
				$saldo=$rowsaldo[0];}
			else{
				$saldo=$rowsaldo[1];}
			//echo $saldo;
			$sql="UPDATE glosa_conciliacion SET saldo_concil='$saldo' WHERE id_conciliacion='$id_conciliacion'";
			//echo $sql;
			mysqli_query($conexion,$sql);
		}
		return $borrado;
	}

	public function cerrar($idabono){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="UPDATE glosa_abono SET estado_abono='C' WHERE id_abono='$idabono'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
