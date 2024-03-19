<?php
session_start();
/**
 * crud
 */
class crudfactura{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		
		
		//if($datos[5]<>'' AND mysqli_num_rows($conconvenio)<>0){		
		$sql="INSERT INTO factura_encabezado (id_persona, id_convenio, fecha_fac, fechaini_fac, fechafin_fac, operador_fac, valortot_fac, valorneto_fac, esta_fac,formapago_fac)
			VALUES ('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$_SESSION[gusuario_log]','0','0','A','$datos[7]')";
		//echo "<br><br>".$sql;
		$guardado=mysqli_query($conexion,$sql);
		$id_factura=mysqli_insert_id($conexion);
		$id_convenio=$datos[1];
		if($datos[5]<>''){
			//$identificador=$datos[6];
			//Aqui guardo el detalle de la factura de consulta
			if(isset($datos[6])){
				foreach($datos[6] as $id_con){
					$conconvenio="SELECT id_cdet,codigo_cdet,valor_cdet,estado_cdet FROM vw_convenio_detalle WHERE id_convenio='$id_convenio' AND estado_cdet='A' AND codigoatc_mto=(
					SELECT codigo_cups FROM vw_consulta WHERE id_con='$id_con')";
					//echo "<br><br>".$conconvenio;
					$conconvenio=mysqli_query($conexion,$conconvenio);

					$row=mysqli_fetch_row($conconvenio);
					$id_cdet=$row[0];
					$valor_cdet=$row[2];

					$sql="INSERT INTO factura_detalle(id_factura,tipo_detfac, id_con, id_cdet, cantidad_detfac, valor_unit_detfac)
					VALUES ('$id_factura','C','$id_con','$id_cdet','1','$valor_cdet')";
					//echo "<br><br>".$sql;
					$guardado=mysqli_query($conexion,$sql);
					//echo "<br><br>id_con:::".$datos[5];

					if($guardado==1 AND !empty($datos[5])){
						$sql="UPDATE consulta SET facturado_con='S' WHERE id_con='$id_con'";
						mysqli_query($conexion,$sql);
						//echo "<br><br>".$sql;
					}
				}
			}

			//Aqui guardo el detalle de la factura de procedimientos
			if(isset($datos[6])){
				foreach($datos[6] as $id_con){
					$conconvenio="SELECT id_cdet,codigo_cdet,valor_cdet,estado_cdet FROM vw_convenio_detalle WHERE estado_cdet='A' AND codigoatc_mto=(
					SELECT codigo_cups FROM vw_procedimiento WHERE id_convenio='$id_convenio' AND id_procedimiento='$id_con')";
					//echo "<br><br>".$conconvenio;
					$conconvenio=mysqli_query($conexion,$conconvenio);

					$row=mysqli_fetch_row($conconvenio);
					$id_cdet=$row[0];
					$valor_cdet=$row[2];

					$sql="INSERT INTO factura_detalle(id_factura,tipo_detfac, id_con, id_cdet, cantidad_detfac, valor_unit_detfac)
					VALUES ('$id_factura','P','$id_con','$id_cdet','1','$valor_cdet')";
					//echo "<br><br>".$sql;
					$guardado=mysqli_query($conexion,$sql);
					//echo "<br><br>id_con:::".$datos[5];

					if($guardado==1 AND !empty($datos[5])){
						$sql="UPDATE procedimiento SET facturado_proc='S' WHERE id_procedimiento='$id_con'";
						mysqli_query($conexion,$sql);
						//echo "<br><br>".$sql;
					}
				}
			}

			$constotal="SELECT SUM(cantidad_detfac*valor_unit_detfac) AS total FROM factura_detalle WHERE id_factura='$id_factura'";
			//echo "<br>".$constotal;
			$constotal=mysqli_query($conexion,$constotal);
			$row=mysqli_fetch_row($constotal);
			$total=$row[0];			

			$sql="UPDATE factura_encabezado SET valortot_fac='$total', valorneto_fac='$total' WHERE id_factura='$id_factura'";
			//echo "<br>".$sql;
			mysqli_query($conexion,$sql);
		}		
		return $guardado;
	}

	public function obtenDatos($idfac){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_factura,nombre_pac,nombre_eps,numero_conv,fecha_fac,valortot_fac,copago_fac,descuento_fac,formapago_fac FROM vw_factura WHERE id_factura='$idfac'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_factura' => $ver[0],
			'nombre_pac' => $ver[1], 
			'nombre_eps' => $ver[2], 
			'numero_conv' => $ver[3], 
			'fecha_fac' => $ver[4],
			'valortot_fac' => $ver[5],
			'copago_fac' => $ver[6],
			'descuento_fac' => $ver[7],
			'formapago_fac' => $ver[8]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$constotal="SELECT SUM(cantidad_detfac*valor_unit_detfac) AS total FROM factura_detalle WHERE id_factura='$datos[0]'";
		$constotal=mysqli_query($conexion,$constotal);
		$row=mysqli_fetch_row($constotal);
		$total=$row[0];
		$neto=$total-$datos[2]-$datos[3];

		$sql="UPDATE factura_encabezado SET fecha_fac='$datos[1]',formapago_fac='$datos[2]', valortot_fac='$total',copago_fac='$datos[3]', descuento_fac='$datos[4]', valorneto_fac='$neto' WHERE id_factura='$datos[0]'";		
		return mysqli_query($conexion,$sql);
	}

	public function anular($idfac){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE factura_encabezado SET esta_fac='N' WHERE id_factura='$idfac'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function cerrar($idfac){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$hoy=date("Y-m-d");
		$sql="SELECT numerofac_ent,prefijofac_ent FROM entidad";
		//echo $sql;
		$sql=mysqli_query($conexion,$sql);
		$row=mysqli_fetch_row($sql);
		$numerofac_ent=$row[0];
		$prefijofac_ent=$row[1];
		$nuevonum=$numerofac_ent+1;
		$sql="UPDATE entidad SET numerofac_ent='$nuevonum'";
		//echo $sql;
		mysqli_query($conexion,$sql);
		$sql="UPDATE factura_encabezado SET esta_fac='C',fechacierre_fac='$hoy', numero_fac='$numerofac_ent', prefijo_fac='$prefijofac_ent' WHERE id_factura='$idfac'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function actualizarcopago($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$constotal="SELECT SUM(cantidad_detfac*valor_unit_detfac) AS total FROM factura_detalle WHERE id_factura='$_SESSION[gid_factura]'";
		$constotal=mysqli_query($conexion,$constotal);
		$row=mysqli_fetch_row($constotal);
		$total=$row[0];
		$neto=$total-$datos[0]-$datos[1];

		$sql="UPDATE factura_encabezado SET valortot_fac='$total',copago_fac='$datos[0]', descuento_fac='$datos[1]', valorneto_fac='$neto' WHERE id_factura='$_SESSION[gid_factura]'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function relacionar($idfac,$idccobro){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE factura_encabezado SET id_ccobro='$idccobro' WHERE id_factura='$idfac'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	public function quitarrelacion($idfac){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="UPDATE factura_encabezado SET id_ccobro=NULL WHERE id_factura='$idfac'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}
}
?>
