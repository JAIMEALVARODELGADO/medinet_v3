<?php
require("valida_sesion.php");
//echo $_POST['id_con'];
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$confor="SELECT id_form,tipo_iden,numero_iden_per,nombre,edad,direccion_per,telefono_per,nombre_eps,fecha_aten,id_profesional,identificacion_profe,nombre_profe,nombre_eps,tipo_afiliado FROM vw_formula_encabezado WHERE id_aten='$_POST[id_aten]'";
//echo $confor;
$confor=mysqli_query($conexion,$confor);
$rowfor=mysqli_fetch_row($confor);
$id_form=$rowfor[0];
$tipo_iden=$rowfor[1];
$numero_iden_per=$rowfor[2];
$nombre=$rowfor[3];
$edad=$rowfor[4];
$direccion_per=$rowfor[5];
$telefono_per=$rowfor[6];
$nombre_eps=$rowfor[7];
$fecha_aten=$rowfor[8];
$id_profesional=$rowfor[9];
$identificacion_profe=$rowfor[10];
$nombre_profe=$rowfor[11];
$nombre_eps=$rowfor[12];
$tipo_afiliado=$rowfor[13];

$conprof="SELECT numero_iden_per,nombre,profesion_usu,registro_usu FROM vw_usuario WHERE id_persona='$id_profesional'";
//echo $conprof;
$conprof=mysqli_query($conexion,$conprof);
$rowprof=mysqli_fetch_row($conprof);
$identif_prof=$rowprof[0];
$nombre_prof=$rowprof[1];
$profesion=$rowprof[2];
$registro=$rowprof[3];

$dx_cod="";
$condx="SELECT vw_consulta.dxprinc_cod FROM vw_consulta WHERE id_aten='$_POST[id_aten]'";
//echo $condx;
$condx=mysqli_query($conexion,$condx);
if(mysqli_num_rows($condx)<>0){
    $rowdx=mysqli_fetch_row($condx);
    $dx_cod=$rowdx[0];
}
else{
    $condx="SELECT vw_procedimiento.dxprinc_proc FROM vw_procedimiento WHERE id_aten='$_POST[id_aten]'";
    //echo $condx;
    $condx=mysqli_query($conexion,$condx);
    if(mysqli_num_rows($condx)<>0){
        $rowdx=mysqli_fetch_row($condx);
        $dx_cod=$rowdx[0];
    }
}


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
                <h7><b>FORMULA MEDICA</b></h7>
                <!--<div class="p-3 mb-2 bg-secondary text-white"><b>HISTORIA CLINICA</b></div>-->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">Fecha:  <?php echo $fecha_aten;?></div>
                <div class="col-sm-6" align="right">Fórmula Número:  <?php echo $id_form;?></div>
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
            <div class="row">
                <div class="col-sm-8">Diagnóstico: <?php echo $dx_cod;?></div>                
                <div class="col-sm-4">EPS: <?php echo $nombre_eps;?></div>                
            </div>
            <div class="row">
                <div class="col-sm-8"></div>                
                <div class="col-sm-4">Tipo de Afiliado: <?php echo $tipo_afiliado;?></div>
            </div>            
        </div>

        <div class="card text-center">
            <div class="card-header">
                <h7><b>MEDICAMENTOS</b></h7>                
            </div>            
        </div>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th scope="col">NOMBRE</th>
              <th scope="col">DOSIS</th>
              <th scope="col">FRECUENCIA</th>
              <th scope="col">VIA</th>
              <th scope="col">TIEMPO</th>
              <th scope="col">CANTIDAD</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $conmed="SELECT nombre_mto,dosis_det,frecuencia_det,via_admin,tiempo_trat_det,cantidad_det,observacion_det
                FROM vw_formula_detalle WHERE id_aten='$_POST[id_aten]'";
                //echo $conmed;
                $conmed=mysqli_query($conexion,$conmed);
                if(mysqli_num_rows($conmed)<>0){
                    while($rowmed=mysqli_fetch_row($conmed)){
                    ?>
                        <tr>
                          <td><?php echo $rowmed[0];?></th>
                          <td><?php echo $rowmed[1];?></td>
                          <td><?php echo $rowmed[2];?></td>
                          <td><?php echo $rowmed[3];?></td>
                          <td><?php echo $rowmed[4];?></td>
                          <td align="right"><?php echo $rowmed[5];?></td>                          
                        </tr>                        
                        <tr>
                            <td colspan="6">Observación: <?php echo $rowmed[6];?></th>                            
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