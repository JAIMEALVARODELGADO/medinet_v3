<?php
session_start();
/**
 * crud
 */
class cruddetalle{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;		
		$sql="INSERT INTO factura_detalle(id_factura, id_cdet, cantidad_detfac, valor_unit_detfac)
		VALUES ('$_SESSION[gid_factura]','$datos[0]','$datos[1]','$datos[2]')";
		//echo $sql;
		$guardado=mysqli_query($conexion,$sql);
		if($guardado==1){
			$objt=new cruddetalle();
			$objt->totalizar();			
		}
		return $guardado;
	}

	public function obtenDatos($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_detfac,id_cdet, descripcion_cdet, cantidad_detfac, valor_unit_detfac FROM vw_factura_detalle WHERE id_detfac='$iddet'";		
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_detfac' => $ver[0],
			'id_cdet' => $ver[1],
			'descripcion_cdet' => $ver[2],
			'cantidad_detfac' => $ver[3],
			'valor_unit_detfac' => $ver[4]			
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$sql="UPDATE factura_detalle SET id_cdet='$datos[1]' , cantidad_detfac='$datos[2]', valor_unit_detfac='$datos[3]' WHERE id_detfac='$datos[0]'";
		$guardado=mysqli_query($conexion,$sql);		
		if($guardado==1){
			$objt=new cruddetalle();
			$objt->totalizar();
		}
		return $guardado;
	}

	public function totalizar(){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$sql="SELECT SUM(cantidad_detfac*valor_unit_detfac) AS total  FROM factura_detalle WHERE id_factura='$_SESSION[gid_factura]'";
			//echo "<br>".$sql;
			$sql=mysqli_query($conexion,$sql);
			$row=mysqli_fetch_row($sql);
			$total=$row[0];

			$sql="SELECT copago_fac, descuento_fac FROM factura_encabezado WHERE id_factura='$_SESSION[gid_factura]'";
			//echo "<br>".$sql;
			$sql=mysqli_query($conexion,$sql);
			$row=mysqli_fetch_row($sql);
			$copago_fac=$row[0];
			$descuento_fac=$row[1];
			$valorneto=$total-$copago_fac-$descuento_fac;

			$sql="UPDATE factura_encabezado SET valortot_fac='$total', valorneto_fac='$valorneto' WHERE id_factura='$_SESSION[gid_factura]'";			
			//echo "<br>".$sql;
			mysqli_query($conexion,$sql);
	}

	public function eliminar($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM factura_detalle WHERE id_detfac='$iddet'";
		$guardado=mysqli_query($conexion,$sql);
		if($guardado==1){
			$objt=new cruddetalle();
			$objt->totalizar();
		}
		return $guardado;
	}
}
?>
