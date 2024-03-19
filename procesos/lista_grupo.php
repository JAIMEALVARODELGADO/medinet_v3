<?php
	require_once "../clases/conexion.php";

	function getListasRep(){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		$sql="SELECT id_grupo,descripcion_grupo FROM grupos ORDER BY descripcion_grupo";
		//echo $sql;
		$result=mysqli_query($conexion,$sql);
		$listas="<option value=''></option>";
		while($row=mysqli_fetch_row($result)){
			$listas.="<option value='$row[0]'>$row[1]</option>";
		}
		return $listas;
	}
	echo getListasRep();
?>
