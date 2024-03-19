<?php
require("valida_sesion.php");

require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$confac="SELECT id_factura,numero_fac, tipoiden_per, numero_iden_per, nombre_pac, direccion_per, telefono_per, numero_conv, nombre_eps, SUBSTR(fecha_fac,1,10), valortot_fac, copago_fac, descuento_fac, valorneto_fac, esta_fac, identif_operador, nombre_operador,fechacierre_fac,prefijo_fac,nombre_formapago
FROM vw_factura WHERE id_factura='$_POST[id_factura]'";
//echo $confac;
$confac=mysqli_query($conexion,$confac);
$rowfac=mysqli_fetch_row($confac);
$id_factura=$rowfac[0];
$numero_fac=$rowfac[1];
$tipoiden_per=$rowfac[2];
$numero_iden_per=$rowfac[3];
$nombre_pac=$rowfac[4];
$direccion_per=$rowfac[5];
$telefono_per=$rowfac[6];
$numero_conv=$rowfac[7];
$nombre_eps=$rowfac[8];
$fecha_fac=$rowfac[9];
$valortot_fac=$rowfac[10];
$copago_fac=$rowfac[11];
$descuento_fac=$rowfac[12];
$valorneto_fac=$rowfac[13];
$esta_fac=$rowfac[14];
$identif_operador=$rowfac[15];
$nombre_operador =$rowfac[16];
$fechacierre_fac =$rowfac[17];
$prefijo_fac =$rowfac[18];
$nombre_formapago =$rowfac[19];
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
        
        <div class="card text-center">
            <div class="card-header">
                <h7><b>PREFACTURA</b></h7>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">Fecha:  <?php echo $fecha_fac;?></div>
                <div class="col-sm-4">Fecha de Cierre:  <?php echo $fechacierre_fac;?></div>
                <div class="col-sm-4" align="right"><b>Número:  <?php echo $prefijo_fac.'  '.$numero_fac;?></b></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Tipo de Identificacion:  <?php echo $tipoiden_per;?></div>
                <div class="col-sm-4">Número:  <?php echo $numero_iden_per;?></div>
                <div class="col-sm-4">Nombre:  <?php echo $nombre_pac;?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Dirección:  <?php echo $direccion_per;?></div>
                <div class="col-sm-4">Teléfono:  <?php echo $telefono_per;?></div>
                <div class="col-sm-4">EPS:  <?php echo $nombre_eps;?></div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">Forma de Pago:  <?php echo $nombre_formapago;?></div>
            </div>
        </div>
        <?php
            if($esta_fac=='N'){
                ?>
                    <div class="card border-light" style="width: 15rem;">
                        <img class="card-img-top" src="imagenes/anulada.JPG">
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
              <th scope="col">CODIGO</th>
              <th scope="col">DESCRIPCION</th>
              <th scope="col">CANTIDAD</th>
              <th scope="col">VALOR UNITARIO</th>
              <th scope="col">VALOR TOTAL</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $condet="SELECT codigo_cdet, descripcion_cdet, cantidad_detfac, valor_unit_detfac, valor_total FROM vw_factura_detalle WHERE id_factura='$_POST[id_factura]'";
                //echo $condet;
                $condet=mysqli_query($conexion,$condet);
                if(mysqli_num_rows($condet)<>0){
                    while($rowdet=mysqli_fetch_row($condet)){
                    ?>
                        <tr>
                          <td><?php echo $rowdet[0];?></th>
                          <td><?php echo $rowdet[1];?></td>
                          <td align="right"><?php echo number_format($rowdet[2],2,'.',',');?></td>
                          <td align="right"><?php echo number_format($rowdet[3],2,'.',',');?></td>
                          <td align="right"><?php echo number_format($rowdet[4],2,'.',',');?></td>
                        </tr>
                    <?php
                    }
                }
            ?>
            <tr>
                <td colspan="4" align="right">Valor Total:</td>
                <td align="right"><b><?php echo number_format($valortot_fac,2,'.',',');?></b></td>
            </tr>
            <tr>
                <td colspan="4" align="right">Valor Copago:</td>
                <td align="right"><b><?php echo number_format($copago_fac,2,'.',',');?></b></td>
            </tr>
            <tr>
                <td colspan="4" align="right">Valor Descuento:</td>
                <td align="right"><b><?php echo number_format($descuento_fac,2,'.',',');?></b></td>
            </tr>
            <tr>
                <td colspan="4" align="right">Valor Neto:</td>
                <td align="right"><b><?php echo number_format($valorneto_fac,2,'.',',');?></b></td>
            </tr>   
          </tbody>
        </table>
        

        <div class="card border-light" style="width: 15rem;">
            <?php
                $firma='imagenes/firmas/'.$identif_operador.'.jpg';
                //echo $firma;
            ?>
            <img class="card-img-top" src="<?php echo $firma;?>" alt="<?php echo $identif_prof;?>">        
        </div>
        <div class="card-body">
            <div class="col-sm-12">Facturador: <?php echo $nombre_operador;?></div>
            <div class="col-sm-12">Identificación: <?php echo $identif_operador;?></div>
        </div>

    </div>
</body>

</html>

<script type="text/javascript">
function imprimir() {
    window.print();
    window.close();
}
</script>