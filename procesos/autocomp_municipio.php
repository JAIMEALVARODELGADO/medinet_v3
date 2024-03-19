<?php
//require("mn_funciones.php");
require_once "../clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "
SELECT DISTINCT codigo_mun,nombre_mun AS nombre FROM municipio
		WHERE nombre_mun LIKE '%$q%' ORDER BY nombre_mun";
//echo $sql;
$rsd=mysqli_query($conexion,$sql);
if($rsd){
    while($rs=mysqli_fetch_row($rsd)){
        $cid = $rs[0];		
        $cname = $rs[1];
        echo "$cname|$cid\n";
    }
}
?>
<p><font color="#000000">no encontrado</font></p>
