<?php
require("valida_sesion.php");

require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$conccob="SELECT id_ccobro, numero_ccob, fecha_ccob, fechaini_ccob, fechafin_ccob, nombre_eps, nit_eps, concepto_ccob, estado_ccob
FROM vw_cuentacobro WHERE id_ccobro='$_POST[id_ccobroD]'";
//echo $conccob;
$conccob=mysqli_query($conexion,$conccob);
$rowccob=mysqli_fetch_row($conccob);
$id_ccobro=$rowccob[0];
$numero_ccob=$rowccob[1];
//$fecha_ccob=$rowccob[2];
$fechaini_ccob=$rowccob[3];
$fechafin_ccob=$rowccob[4];
$nombre_eps=$rowccob[5];
$nit_eps=$rowccob[6];
$concepto_ccob=$rowccob[7];
$estado_ccob=$rowccob[8];

$fecha_ccob=date_create($rowccob[2]);
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes=$meses[date('m', strtotime($rowccob[2]))-1];
$fecha_ccob=date_format($fecha_ccob,"d").' de '.$mes.' de '.date_format($fecha_ccob,"Y");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>

    <?php 
        require_once "scripts.php";
    ?>
</head>

<body>
    <div class="container-fluid">
        <?php
            require("encabezado_prn.php");
        ?>

        <div class="row">
            <div class="col-sm-12">San Juan de Pasto, <?php echo $fecha_ccob;?></h7></div>
        </div>
        
        <div class="card text-center">
            <div class="card-header">
                <h7><b>CUENTA DE COBRO</b></h7>
            </div>
        </div>        
        <div class="card-body">
            <div class="row">                
                <div class="col-sm-12" align="center"><b>Número:  <?php echo $numero_ccob;?></b></div>
            </div>
            <div class="row">                
                <div class="col-sm-12" align="center"><?php echo $nombre_eps;?></div>
            </div>            
            <div class="row">                
                <div class="col-sm-12" align="center"><?php echo $nit_eps;?></div>
            </div>
            <div class="row">                
                <div class="col-sm-12" align="center">DEBE A:</div>
            </div>
            <div class="row">                
                <div class="col-sm-12" align="center"><b><?php echo $nombre_ent;?></b></div>
            </div>
            <div class="row">                
                <div class="col-sm-12" align="center">POR CONCEPTO DE:</div>
            </div>
            <div class="row">                
                <div class="col-sm-12" align="center"><?php echo $concepto_ccob;?></div>
            </div>
        </div>
        <?php
            if($estado_ccob=='A'){
                ?>
                    <div class="card border-light" style="width: 15rem;">
                        <div class="col-sm-12">CUENTA DE COBRO SIN TERMINAR</div>
                    </div>
                <?php
            }
        ?>
        <div class="card text-center">
            <div class="card-header">
                <h7><b>DETALLE</b></h7>                
            </div>            
        </div>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th scope="col">FACTURA</th>
              <th scope="col">FECHA</th>
              <th scope="col">NOMBRE</th>
              <th scope="col">VALOR</th>              
            </tr>
          </thead>
          <tbody>
            <?php
                $total=0;
                $condet="SELECT numero_fac, SUBSTR(fecha_fac,1,10), nombre_pac, valorneto_fac FROM vw_factura WHERE id_ccobro='$_POST[id_ccobroD]'";
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
                        </tr>
                    <?php
                    $total+=$rowdet[3];
                    }
                }
            ?>
            <tr>
                <td colspan="3" align="right">Total:</td>
                <td align="right"><b><?php echo number_format($total,2,'.',',');?></b></td>
            </tr>
          </tbody>
        </table>
        
        <div class="card-body">
            <div class="col-sm-12">Atentamente,</div>
            <br>
            <br>
            <br>
            <div class="col-sm-3"><hr></div>
            
            <div class="col-sm-12">Identificación:</div>
        </div>

    </div>
</body>

</html>

<script type="text/javascript">
//function imprimir() {
    window.print();
    //window.close();
//}
</script>