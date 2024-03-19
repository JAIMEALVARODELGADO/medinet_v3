<?php
	require_once "../clases/conexion.php";

	function getListasRep(){
		$obj=new conectar();
		$conexion=$obj->conexion();
		
		$sql="SELECT vw_usuario.id_persona,nombre FROM vw_usuario INNER JOIN concepto_persona ON concepto_persona.id_persona=vw_usuario.id_persona WHERE estado_usu='A' GROUP BY vw_usuario.id_persona,nombre ORDER BY nombre";
		$result=mysqli_query($conexion,$sql);
		$listas="<option value=''></option>";
		while($row=mysqli_fetch_row($result)){
			$listas.="<option value='$row[0]'>$row[1]</option>";
		}
		return $listas;
	}
	echo getListasRep();
?>
