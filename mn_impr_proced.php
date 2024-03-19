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
                <h7><b>DATOS PERSONALES</b></h7>                
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

        <div class="card text-center">
            <div class="card-header">
                <h7><b>PROCEDIMIENTOS</b></h7>                
            </div>            
        </div>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th scope="col">PROCEDIMIENTO</th>
              <th scope="col">AMBITO</th>
              <th scope="col">FINALIDAD</th>              
            </tr>
          </thead>
          <tbody>
            <?php
                $conproc="SELECT vw_procedimiento.descripcion_cups,vw_procedimiento.ambito_descrip,vw_procedimiento.finalidad_descrip,vw_procedimiento.observacion_proc
                FROM vw_procedimiento
                WHERE vw_procedimiento.id_aten='$_POST[id_aten]'";
                //echo $conproc;
                $conproc=mysqli_query($conexion,$conproc);
                if(mysqli_num_rows($conproc)<>0){
                    while($rowproc=mysqli_fetch_row($conproc)){
                    ?>
                        <tr>
                          <td><?php echo $rowproc[0];?></th>
                          <td><?php echo $rowproc[1];?></td>
                          <td><?php echo $rowproc[2];?></td>
                        </tr>                        
                        <tr>
                            <td colspan="6">Observación: <?php echo $rowproc[3];?></th>                            
                        </tr>

                    <?php
                    }
                }
            ?>            
          </tbody>
        </table>



        


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