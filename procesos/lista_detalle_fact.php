<?php
	require_once "../clases/conexion.php";

	function getListasRep($fac_){
		$obj=new conectar();
		$conexion=$obj->conexion();		
		$sql="SELECT id_detfac,descripcion_cdet
		FROM vw_factura_detalle WHERE numero_fac='$fac_' ORDER BY descripcion_cdet";
		//echo $sql;
		$result=mysqli_query($conexion,$sql);
		$listas="<option value=''></option>";
		while($row=mysqli_fetch_row($result)){
			$listas.="<option value='$row[0]'>$row[1]</option>";
		}
		return $listas;
	}
	echo getListasRep($_GET['factura']);
?>
