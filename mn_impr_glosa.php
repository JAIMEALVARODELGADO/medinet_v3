<?php
require("valida_sesion.php");

require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$conglo="SELECT vw_glosa.id_glosa,vw_glosa.fecharecep_glo,vw_glosa.nombre_eps,vw_glosa.numero_fac,vw_glosa.valorneto_fac,vw_glosa.valor_glo,vw_glosa.motivo_glo,vw_glosa.fechaentrega_glo,vw_glosa.nombre_responsable,vw_glosa.fecha_envio_glo,vw_glosa.valor_fav_glo,vw_glosa.valor_fav_eps,vw_glosa.guia_glo
FROM vw_glosa WHERE id_glosa='$_POST[id_glosa]'";
//echo $conglo;
$conglo=mysqli_query($conexion,$conglo);
$rowglo=mysqli_fetch_row($conglo);
$id_glosa=$rowglo[0];
$fecharecep_glo=$rowglo[1];
$nombre_eps=$rowglo[2];
$numero_fac=$rowglo[3];
$valorneto_fac=$rowglo[4];
$valor_glo=$rowglo[5];
$motivo_glo=$rowglo[6];
$fechaentrega_glo=$rowglo[7];
$nombre_responsable=$rowglo[8];
$fecha_envio_glo=$rowglo[9];
$valor_fav_glo=$rowglo[10];
$valor_fav_eps=$rowglo[11];
$guia_glo=$rowglo[12];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php 
        require_once "scripts.php";
    ?>
</head>

<body onload="imprimir()">
    <div class="container-fluid">
        <?php
            require("encabezado_prn.php");
        ?>
        <div class="card text-center">
            <div class="card-header">
                <h7><b>GLOSA</b></h7>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">Fecha de Recepción:</div>
                <div class="col-sm-2"><?php echo $fecharecep_glo;?></div>
                <div class="col-sm-2">Factura:</div>
                <div class="col-sm-3"><?php echo $numero_fac;?></div>
                <div class="col-sm-2">Valor de la factura:</div>            
                <div class="col-sm-1" align="right"><?php echo number_format($valorneto_fac,2,'.',',');?></div>
            </div>
            <div class="row">
                <div class="col-sm-2">Fecha de Entrega:</div>
                <div class="col-sm-2"><?php echo $fechaentrega_glo;?></div>
                <div class="col-sm-2">EPS:</div>
                <div class="col-sm-3"><?php echo $nombre_eps;?></div>
                <div class="col-sm-2">Valor Glosa:</div>
                <div class="col-sm-1" align="right"><?php echo number_format($valor_glo,2,'.',',');?></div>
            </div>
            <div class="row">
                <div class="col-sm-2">Fecha de Envío:</div>
                <div class="col-sm-2"><?php echo $fecha_envio_glo;?></div>
                <div class="col-sm-2">Responsable:</div>
                <div class="col-sm-3"><?php echo $nombre_responsable;?></div>
                <div class="col-sm-2">Valor a Favor:</div>
                <div class="col-sm-1" align="right"><?php echo number_format($valor_fav_glo,2,'.',',');?></div>
            </div>
            <div class="row">
                <div class="col-sm-2">Guia:</div>
                <div class="col-sm-2"><?php echo $guia_glo;?></div>
                <div class="col-sm-5"></div>                
                <div class="col-sm-2">Valor a Favor de la Eps:</div>
                <div class="col-sm-1" align="right"><?php echo number_format($valor_fav_eps,2,'.',',');?></div>
            </div>
            <div class="row">
                <div class="col-sm-12">Motivo de Glosa:  <?php echo $motivo_glo;?></div>
            </div>
        </div>
        
        <div class="card text-center">
            <div class="card-header">
                <h7><b>SEGUIMIENTO</b></h7>                
            </div>            
        </div>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th scope="col">FECHA</th>
              <th scope="col">CODIGO</th>
              <th scope="col">DESCRIPCION</th>
              <th scope="col">VALOR ACEPTADO</th>
              <th scope="col">OBSERVACION</th>
              <th scope="col">RESPONSABLE</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $total=0;
                $condet="SELECT vw_glosa_respuesta.fechacont_resp,vw_glosa_respuesta.codigo_conglo,vw_glosa_respuesta.descripcion_conglo,vw_glosa_respuesta.valoracepta_resp,vw_glosa_respuesta.observacion_resp,vw_glosa_respuesta.nombre_responsable FROM vw_glosa_respuesta WHERE id_glosa='$_POST[id_glosa]'";
                //echo $condet;
                $condet=mysqli_query($conexion,$condet);
                if(mysqli_num_rows($condet)<>0){
                    while($rowdet=mysqli_fetch_row($condet)){
                    ?>
                        <tr>
                          <td><?php echo $rowdet[0];?></th>
                          <td><?php echo $rowdet[1];?></td>
                          <td><?php echo $rowdet[2];?></td>
                          <td align="right"><?php echo number_format($rowdet[3],2,'.',',');?></td>
                          <td><?php echo $rowdet[4];?></td>
                          <td><?php echo $rowdet[5];?></td>                          
                        </tr>
                    <?php
                    $total=$total+$rowdet[3];
                    }
                }
            ?>
            <tr>
                <td colspan="3" align="right">Total Aceptado:</td>
                <td align="right"><b><?php echo number_format($total,2,'.',',');?></b></td>
            </tr>            
          </tbody>
        </table>
        

        <!--<div class="card border-light" style="width: 15rem;">
            <?php
                $firma='imagenes/firmas/'.$identif_operador.'.jpg';
                //echo $firma;
            ?>
            <img class="card-img-top" src="<?php echo $firma;?>" alt="<?php echo $identif_prof;?>">        
        </div>
        <div class="card-body">
            <div class="col-sm-12">Facturador: <?php echo $nombre_operador;?></div>
            <div class="col-sm-12">Identificación: <?php echo $identif_operador;?></div>
        </div>-->
    </div>
</body>

</html>

<script type="text/javascript">
function imprimir() {
    //window.print();
    //window.close();
}
</script>