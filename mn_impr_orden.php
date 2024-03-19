<?php
require("valida_sesion.php");
//echo $_POST['id_con'];
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$conaten="SELECT id_aten,tipoident,numero_iden_per,nombre,edad,direccion_per,telefono_per,nombre_eps,fecha_aten,id_profesional
FROM vw_atencion WHERE id_aten='$_POST[id_aten]'";
//echo $conaten;
$conaten=mysqli_query($conexion,$conaten);
$rowaten=mysqli_fetch_array($conaten);
$tipo_iden=$rowaten['tipoident'];
$numero_iden_per=$rowaten['numero_iden_per'];
$nombre=$rowaten['nombre'];
$edad=$rowaten['edad'];
$direccion_per=$rowaten['direccion_per'];
$telefono_per=$rowaten['telefono_per'];
$nombre_eps=$rowaten['nombre_eps'];
$fecha_aten=$rowaten['fecha_aten'];
$id_profesional=$rowaten['id_profesional'];

$conprof="SELECT numero_iden_per,nombre,profesion_usu,registro_usu FROM vw_usuario WHERE id_persona='$id_profesional'";
//echo $conprof;
$conprof=mysqli_query($conexion,$conprof);
$rowprof=mysqli_fetch_row($conprof);
$identif_prof=$rowprof[0];
$nombre_prof=$rowprof[1];
$profesion=$rowprof[2];
$registro=$rowprof[3];

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
                <h7><b>ORDENES</b></h7>                
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">Fecha:  <?php echo $fecha_aten;?></div>
                <div class="col-sm-6" align="right"></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Tipo de Identificacion:  <?php echo $tipo_iden;?></div>
                <div class="col-sm-4">Número:  <?php echo $numero_iden_per;?></div>
                <div class="col-sm-4">Nombre:  <?php echo $nombre;?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Dirección:  <?php echo $direccion_per;?></div>
                <div class="col-sm-4">Teléfono:  <?php echo $telefono_per;?></div>
                <div class="col-sm-4">Edad:  <?php echo $edad;?></div>
            </div>            
        </div>
        
        <?php
            $sql="SELECT id_ord,tipoorden
            FROM  vw_consulta_orden
            WHERE id_aten='$_POST[id_aten]'";
            //echo $sql;        
            $result=mysqli_query($conexion,$sql);
        
            if($_POST['id_aten']!=0){
            ?>
                <div>
                    <?php
                        while($row=mysqli_fetch_row($result)){
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-10"><b><?php echo $row[1];?></b></div>                            
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $consdet="SELECT id_ord_det,codigo_cups,descripcion_cups,observacion_det FROM vw_orden_detalle WHERE id_ord='$row[0]'";
                                        //echo $consdet;
                                        $consdet=mysqli_query($conexion,$consdet);
                                        if(mysqli_num_rows($consdet)<>0){
                                            ?>
                                                <table class="table table-hover table-sm table-bordered font13" id="tablaorden">
                                                    <thead style="background-color: #2574a9;color: white; font-weight: bold;">
                                                        <tr>
                                                            <td>Código</td>
                                                            <td>Descripción</td>
                                                            <td>Observación</td>                                                
                                                        </tr>
                                                    </thead>
                                                    <tbody style="background-color: white">
                                                        <?php
                                                            while($rowdet=mysqli_fetch_row($consdet)){
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $rowdet[1];?></td>
                                                                    <td><?php echo $rowdet[2];?></td>
                                                                    <td><?php echo $rowdet[3];?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php
                                        }
                                        ?>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            <?php
            }
        ?>


        <div class="card border-light" style="width: 15rem;">
            <?php
                $firma='imagenes/firmas/'.$identif_prof.'.jpg';
                //echo $firma;
            ?>
            <img class="card-img-top" src="<?php echo $firma;?>" alt="<?php echo $identif_prof;?>">        
        </div>
        <div class="card-body">
            <div class="col-sm-12">Profesional: <?php echo $nombre_prof;?></div>
            <div class="col-sm-12"><?php echo $profesion;?></div>
            <div class="col-sm-12">Registro: <?php echo $registro;?></div>
        </div>

    </div>
</body>

</html>

<script type="text/javascript">
//function imprimir() {
    //window.print();
    //window.close();
//}
</script>