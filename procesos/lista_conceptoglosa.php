<?php
	session_start();
	require_once "../clases/conexion.php";

	function getListasRep(){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		$sql="SELECT id_conglo,CONCAT(codigo_conglo,' ',descripcion_conglo) AS descripcion FROM vw_glosa_persona 
		WHERE id_persona='$_SESSION[gusuario_log]'
		ORDER BY codigo_conglo";		
		$result=mysqli_query($conexion,$sql);
		$listas="<option value=''></option>";
		while($row=mysqli_fetch_row($result)){
			$listas.="<option value='$row[0]'>$row[1]</option>";
		}
		return $listas;
	}
	echo getListasRep();
?>
