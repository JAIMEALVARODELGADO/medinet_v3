<?php
session_start();
require_once "../clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
//$q = strtoupper($_GET["q"]);
$q = $_GET["q"];
if (!$q) RETURN;
$sql = "SELECT DISTINCT id_cdet,descripcion_cdet,valor_cdet FROM convenio_detalle
		WHERE estado_cdet='A' AND id_convenio='$_SESSION[gid_convenio]' AND descripcion_cdet LIKE '%$q%'";
//echo $sql;
$rsd=mysqli_query($conexion,$sql);
if($rsd){
    while($rs=mysqli_fetch_row($rsd)){
        $cid = $rs[0];		
        $cname = $rs[1];
        $valor =  $rs[2];
        echo "$cname|$cid|$valor\n";
    }
}
?>
<p><font color="#000000">no encontrado</font></p>
