<?php
//require("mn_funciones.php");
require_once "../clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
$sql = "SELECT DISTINCT id_cie,descripcion AS nombre FROM vw_cie
		WHERE descripcion LIKE '%$q%' ORDER BY descripcion";
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
