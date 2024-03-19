<?php
session_start();
/**
 * crud
 */
class crudcuentacobro{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="INSERT INTO factura_cuentacobro (numero_ccob,fecha_ccob,fechaini_ccob,fechafin_ccob,id_eps,concepto_ccob,estado_ccob,id_operador)
		VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]','A','$_SESSION[gusuario_log]')";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function obtenDatos($idccob){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_ccobro,numero_ccob, id_eps, fecha_ccob, fechaini_ccob, fechafin_ccob, concepto_ccob FROM factura_cuentacobro WHERE id_ccobro='$idccob'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_ccobro' => $ver[0],
			'numero_ccob' => $ver[1], 
			'id_eps' => $ver[2], 
			'fecha_ccob' => $ver[3], 
			'fechaini_ccob' => $ver[4], 
			'fechafin_ccob' => $ver[5], 
			'concepto_ccob' => $ver[6]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE factura_cuentacobro SET numero_ccob='$datos[1]', fecha_ccob='$datos[2]', fechaini_ccob='$datos[3]', fechafin_ccob='$datos[4]', concepto_ccob='$datos[5]' WHERE id_ccobro='$datos[0]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function cerrar($idccob){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE factura_cuentacobro SET estado_ccob='C' WHERE id_ccobro='$idccob'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
