<?php
session_start();
/**
 * crud
 */
class cruddetalle_paquete{
	
	public function agregar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$sql="INSERT INTO medicamento_paquete(id_medicamento_pq, id_medicamento, cantidad_medpq,estado_medpq)
		VALUES ('$_SESSION[gid_medicamento_pq]','$datos[0]','$datos[1]','A')";
		//echo $sql;
		$guardado=mysqli_query($conexion,$sql);
		return $guardado;
	}

	public function obtenDatos($idmed){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="SELECT id_medpq,id_medicamento_pq,nombre_mto, cantidad_medpq FROM vw_medicamento_paquete WHERE id_medpq='$idmed'";
		//echo $sql;
		$row=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($row);
		$datos=array(
			'id_medpq' => $ver[0],
			'id_medicamento' => $ver[1],
			'nombre_mto' => $ver[2],
			'cantidad_medpq' => $ver[3]
			);
		return $datos;
	}

	public function actualizar($datos){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$guardado=0;
		$sql="UPDATE medicamento_paquete SET id_medicamento='$datos[1]' , cantidad_medpq='$datos[2]' WHERE id_medpq='$datos[0]'";
		$guardado=mysqli_query($conexion,$sql);		
		return $guardado;
	}

	public function cambiarestado($idmedpq){
		$obj=new conectar();
		$conexion=$obj->conexion();
		$estado="A";
		$conestado="SELECT estado_medpq FROM medicamento_paquete WHERE id_medpq='$idmedpq'";
		//echo $conestado;
		$conestado=mysqli_query($conexion,$conestado);
		$rowest=mysqli_fetch_row($conestado);
		if($rowest[0]=='A'){
			$estado="I";}
		else{
			$estado="A";}
		$sql="UPDATE medicamento_paquete SET estado_medpq='$estado' WHERE id_medpq='$idmedpq'";
		//echo $sql;
		return mysqli_query($conexion,$sql);
	}

	
	/*public function eliminar($iddet){
		$obj=new conectar();
		$conexion=$obj->conexion();

		$sql="DELETE FROM factura_detalle WHERE id_detfac='$iddet'";
		$guardado=mysqli_query($conexion,$sql);
		if($guardado==1){
			$objt=new cruddetalle();
			$objt->totalizar();
		}
		return $guardado;
	}*/
}
?>
