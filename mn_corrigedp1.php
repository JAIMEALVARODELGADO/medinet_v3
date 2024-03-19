<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Actualizando Datos Personales</h4>
                    </div>
                    <div class="card-body">

                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="sr-only">100% Complete</span>
                      </div>  
                    </div>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            $error=0;
                            $cont=1;

                            $consulta_datos="SELECT atencion.id_aten,atencion.id_agc,atencion.fecha_aten,agenda_cita.id_persona,persona.tipo_iden_per,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,persona.fnac_per,persona.sexo_per,persona.direccion_per,persona.telefono_per,consulta_dpersonales.numeroiden_dp,consulta_dpersonales.id_con_dp
                            FROM atencion
                            INNER JOIN consulta_dpersonales ON consulta_dpersonales.id_aten=atencion.id_aten
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            WHERE persona.numero_iden_per<>consulta_dpersonales.numeroiden_dp";
                            //echo $consulta_datos;
                            $consulta_datos=mysqli_query($conexion,$consulta_datos);
                            while($row=mysqli_fetch_array($consulta_datos)){
                                //echo "<br>".$row['numero_iden_per']." ".$row['nombre'];
                                $sql="UPDATE consulta_dpersonales SET tipoiden_dp='$row[tipo_iden_per]',numeroiden_dp='$row[numero_iden_per]',nombre_dp='$row[nombre]',fechanac_dp='$row[fnac_per]',genero_dp='$row[sexo_per]',direccion_dp='$row[direccion_per]',telefono_dp='$row[telefono_per]'
                                WHERE id_con_dp=$row[id_con_dp]";
                                //echo "<br>".$sql;
                                mysqli_query($conexion,$sql);
                                echo "<br>".mysqli_affected_rows($conexion);
                            }
                            

                            ?>                            
                        </div>                        
                        <div class="alert alert-success" role="alert">
                            <br>Proceso finalizado
                        </div>
                    </div>
                    
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

