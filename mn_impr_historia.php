<?php
require("valida_sesion.php");
//echo $_POST['id_aten'];
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();

$conhis="SELECT fecha_aten,tipoiden,numeroiden_dp,nombre_dp,direccion_dp,telefono_dp,edad,sexo,estado_civil, descripcion_ciu,motivo_con,enfermedad_con,revisionsist_con,analisis_con,CONCAT(dxprinc_cod,' ',dxprinc) AS dxprinc,tipodx,CONCAT(cierel1.codigo_cie,' ',cierel1.descripcion_cie) AS dxrel1, CONCAT(cierel2.codigo_cie,' ',cierel2.descripcion_cie) AS dxrel2,CONCAT(cierel3.codigo_cie,' ',cierel3.descripcion_cie) AS dxrel3, observacion_con,id_profesional,id_con,plan_con,subjetivo_con,objetivo_con,control_con,violencia_sexual_con, nombre_eps FROM vw_consulta LEFT JOIN cie AS cierel1 on cierel1.id_cie=vw_consulta.dxrela1_con LEFT JOIN cie AS cierel2 on cierel2.id_cie=vw_consulta.dxrela2_con LEFT JOIN cie AS cierel3 on cierel3.id_cie=vw_consulta.dxrela3_con WHERE id_aten='$_POST[id_aten]'";
//echo $conhis;
$conhis=mysqli_query($conexion,$conhis);
$rowhis=mysqli_fetch_row($conhis);
$fecha_aten=$rowhis[0];
$tipoiden=$rowhis[1];
$numeroiden_dp=$rowhis[2];
$nombre_dp=$rowhis[3];
$direccion_dp=$rowhis[4];
$telefono_dp=$rowhis[5];
$edad_dp=$rowhis[6];
$sexo_dp=$rowhis[7];
$estado_civil=$rowhis[8];
$descripcion_ciou=$rowhis[9];
$motivo_con=$rowhis[10];
$enfermedad_con=$rowhis[11];
$revisionsist_con=$rowhis[12];
$analisis_con=$rowhis[13];
$dxprinc=$rowhis[14];
$tipodx=$rowhis[15];
$dxrel1=$rowhis[16];
$dxrel2=$rowhis[17];
$dxrel3=$rowhis[18];
$observacion_con=$rowhis[19];
$id_profesional=$rowhis[20];
$id_con=$rowhis[21];
$plan_con=$rowhis[22];
$subjetivo_con=$rowhis[23];
$objetivo_con=$rowhis[24];
$violencia_sexual_con=$rowhis[26];
$nombre_eps=$rowhis[27];
$conacu="SELECT id_con_acu,tipoiden_acu,numeroiden_acu,nombre_acu,direccion_acu,telefono_acu,parentesco_acu
FROM consulta_acudiente WHERE id_aten='$_POST[id_aten]'";
//echo $conacu;
$conacu=mysqli_query($conexion,$conacu);
if(mysqli_num_rows($conacu)<>0){
    $row=mysqli_fetch_row($conacu);
    $id_con_acu=$row[0];
    $tipoiden_acu=$row[1];
    $numeroiden_acu=$row[2];
    $nombre_acu=$row[3];
    $direccion_acu=$row[4];
    $telefono_acu=$row[5];
    $parentesco_acu=$row[6];
}
else{
    $id_con_acu=0;
    $tipoiden_acu='';
    $numeroiden_acu='';
    $nombre_acu='';
    $direccion_acu='';
    $telefono_acu='';
    $parentesco_acu='';
}

$conante="SELECT id_con_ante,personales_ante,familiares_ante FROM consulta_antecedentes WHERE id_con='$id_con'";
//echo $conante;
$conante=mysqli_query($conexion,$conante);
if(mysqli_num_rows($conante)<>0){
    $rowante=mysqli_fetch_row($conante);
    $id_con_ante=$rowante[0];
    $personales_ante=$rowante[1];
    $familiares_ante=$rowante[2];
}
else{
    $id_con_ante=0;
    $personales_ante='';
    $familiares_ante='';
}

$consv="SELECT id_sv,tensionart_sv,frecresp_sv,freccard_sv,temperat_sv,perimetrocef_sv,peso_sv,talla_sv,indicemc_sv,indicecc_sv,observacion_sv FROM consulta_signos_vitales WHERE id_con='$id_con'";
//echo $consv;
$consv=mysqli_query($conexion,$consv);
if(mysqli_num_rows($consv)<>0){
    $rowsv=mysqli_fetch_row($consv);
    $id_sv=$rowsv[0];
    $tensionart_sv=$rowsv[1];
    $frecresp_sv=$rowsv[2];
    $freccard_sv=$rowsv[3];
    $temperat_sv=$rowsv[4];
    $perimetrocef_sv=$rowsv[5];
    $peso_sv=$rowsv[6];
    $talla_sv=$rowsv[7];
    $indicemc_sv=$rowsv[8];
    $indicecc_sv=$rowsv[9];
    $observacion_sv=$rowsv[10];
}
else{
    $id_sv=0;
    $tensionart_sv="";
    $frecresp_sv="";
    $freccard_sv="";
    $temperat_sv="";
    $perimetrocef_sv="";
    $peso_sv="";
    $talla_sv="";
    $indicemc_sv="";
    $indicecc_sv="";
    $observacion_sv="";
}

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
    <link rel="stylesheet" href="print.css" media="print">
    <?php 
        require_once "scripts.php";
    ?>
</head>

<body>
    <?php
    //require("encabezado.php");
    //require("menu.php");
    ?>
    <div class="container-fluid">
        <?php
            require("encabezado_prn.php");
        ?>
        
        <div class="card text-center">
            <div class="card-header">
                <h7><b>HISTORIA CLINICA</b></h7>
                <!--<div class="p-3 mb-2 bg-secondary text-white"><b>HISTORIA CLINICA</b></div>-->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">Fecha de la consulta:  <?php echo $fecha_aten;?></div>
                <div class="col-sm-6" align="right">Consulta Número:  <?php echo $_POST['id_aten'];?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Tipo de Identificacion:  <?php echo $tipoiden;?></div>
                <div class="col-sm-4">Número:  <?php echo $numeroiden_dp;?></div>
                <div class="col-sm-4">Nombre:  <?php echo $nombre_dp;?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Dirección:  <?php echo $direccion_dp;?></div>
                <div class="col-sm-4">Teléfono:  <?php echo $telefono_dp;?></div>
                <div class="col-sm-4">Edad:  <?php echo $edad_dp;?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Género:  <?php echo $sexo_dp;?></div>
                <div class="col-sm-4">Estado Civil:  <?php echo $estado_civil;?></div>
                <div class="col-sm-4">EPS:  <?php echo $nombre_eps;?></div>
            </div>
            <div class="row">
                <div class="col-sm-12">Ocupación:  <?php echo $descripcion_ciou;?></div>                        
            </div>
        </div>

        <?php
        if($id_con_acu<>0){
            ?>
                <div class="card text-center">
                    <div class="card-header">
                        <h7><b>INFORMACION DEL ACUDIENTE</b></h7>                                
                    </div>
                </div>
                <div class="card-body">                            
                    <div class="row">
                        <div class="col-sm-4">Tipo de Identificacion:  <?php echo $tipoiden_acu;?></div>
                        <div class="col-sm-4">Número:  <?php echo $numeroiden_acu;?></div>
                        <div class="col-sm-4">Nombre:  <?php echo $nombre_acu;?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Dirección:  <?php echo $direccion_acu;?></div>
                        <div class="col-sm-4">Teléfono:  <?php echo $telefono_acu;?></div>
                        <div class="col-sm-4">Parentesco:  <?php echo $parentesco_acu;?></div>
                    </div>
                </div>
            <?php
        }
        ?>

        <div class="card text-center">
            <div class="card-header">
                <h7><b>ANAMNESIS</b></h7>
                <!--<div class="p-3 mb-2 bg-secondary text-white"><b>HISTORIA CLINICA</b></div>-->
            </div>
        </div>
        <div class="card-body">
            <?php
                ?>
                <div class="row">
                    <div class="col-sm-12">Víctima de violencia sexual (S/n): <?php echo $violencia_sexual_con;?></div>
                </div>
                <?php
                if($motivo_con<>""){
                    ?>
                    <div class="row">
                        <div class="col-sm-12">Motivo de Consulta: <?php echo $motivo_con;?></div>                  
                    </div>
                    <?php
                }
                if($enfermedad_con<>""){
                    ?>
                    <div class="row">
                        <div class="col-sm-12">Enfermedad Actual: <?php echo $enfermedad_con;?></div>                  
                    </div>
                    <?php
                }
                if($revisionsist_con<>""){
                    ?>
                    <div class="row">
                        <div class="col-sm-12">Revisión por Sistemas: <?php echo $revisionsist_con;?></div>           
                    </div>
                    <?php
                }
                if($subjetivo_con<>""){
                    ?>
                    <div class="row">
                        <div class="col-sm-12">Subjetivo: <?php echo $subjetivo_con;?></div>           
                    </div>
                    <?php
                }
                if($objetivo_con<>""){
                    ?>
                    <div class="row">
                        <div class="col-sm-12">Objetivo: <?php echo $objetivo_con;?></div>           
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php
            if($id_con_ante<>0){
                ?>
                <div class="card text-center">
                    <div class="card-header">
                        <h7><b>ANTECEDENTES</b></h7>
                        <!--<div class="p-3 mb-2 bg-secondary text-white"><b>HISTORIA CLINICA</b></div>-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">Personales: <?php echo $personales_ante;?></div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12">Familiares: <?php echo $familiares_ante;?></div>                        
                    </div>
                </div>
                <?php
            }
        ?>

        <?php
            if($id_sv<>0){
                ?>
                <div class="card text-center">
                    <div class="card-header">
                        <h7><b>SIGNOS VITALES</b></h7>
                        <!--<div class="p-3 mb-2 bg-secondary text-white"><b>HISTORIA CLINICA</b></div>-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">Tensión Arterial: <?php echo $tensionart_sv;?></div>
                        <div class="col-sm-3">Frecuencia Respiratoria: <?php echo $frecresp_sv;?></div>
                        <div class="col-sm-3">Frecuencia Cardiaca: <?php echo $freccard_sv;?></div>
                        <div class="col-sm-3">Temperatura: <?php echo $temperat_sv;?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Perimietro Cefálico: <?php echo $perimetrocef_sv;?></div>
                        <div class="col-sm-3">Peso: <?php echo $peso_sv;?></div>
                        <div class="col-sm-3">Talla: <?php echo $talla_sv;?></div>
                        <div class="col-sm-3">Indice de Masa Corporal: <?php echo $indicemc_sv;?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Indice Cintura Cadera: <?php echo $indicecc_sv;?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">Observación: <?php echo $observacion_sv;?></div>
                    </div>
                </div>
                <?php
            }

            $conef="SELECT descripcion_exaf,valor_exaf,hallazgo_exaf FROM consulta_examen_fisico WHERE id_con='$id_con'";
            //echo $conef;
            $conef=mysqli_query($conexion,$conef);
            if(mysqli_num_rows($conef)<>0){
                 ?>
                <div class="card text-center">
                    <div class="card-header">
                        <h7><b>EXAMEN FISICO</b></h7>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2"><b>DESCRIPCION</b></div>
                        <div class="col-sm-2"><b>ESTADO</b></div>
                        <div class="col-sm-8"><b>HALLAZGO</b></div>
                    </div>
                <?php
                while($rowef=mysqli_fetch_row($conef)){
                    ?>
                    <div class="row">
                        <div class="col-sm-2"><?php echo $rowef[0];?></div>
                        <div class="col-sm-2"><?php echo $rowef[1];?></div>
                        <div class="col-sm-8"><?php echo $rowef[2];?></div>
                    </div>
                    <?php
                }
                ?>
                </div>
                <?php
                /*$id_sv=$rowsv[0];
                $tensionart_sv=$rowsv[1];
                $frecresp_sv=$rowsv[2];
                $freccard_sv=$rowsv[3];
                $temperat_sv=$rowsv[4];
                $perimetrocef_sv=$rowsv[5];
                $peso_sv=$rowsv[6];
                $talla_sv=$rowsv[7];
                $indicemc_sv=$rowsv[8];
                $indicecc_sv=$rowsv[9];
                $observacion_sv=$rowsv[10];*/
            }

        ?>

        <div class="card text-center">
            <div class="card-header">
                <h7><b>IMPRESION DIAGNOSTICA</b></h7>
                <!--<div class="p-3 mb-2 bg-secondary text-white"><b>HISTORIA CLINICA</b></div>-->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">Diagnóstico Principal: <?php echo $dxprinc;?></div>
                <div class="col-sm-4">Tipo de Diagnóstico Principal: <?php echo $tipodx;?></div>
            </div>
            <div class="row">
                <div class="col-sm-12">Diagnóstico Relacionado 1: <?php echo $dxrel1;?></div>                
            </div>
            <div class="row">
                <div class="col-sm-12">Diagnóstico Relacionado 2: <?php echo $dxrel2;?></div>                
            </div>
            <div class="row">
                <div class="col-sm-12">Diagnóstico Relacionado 3: <?php echo $dxrel3;?></div>                
            </div>
             <div class="row">
                <div class="col-sm-12">Analisis: <?php echo $analisis_con;?></div>                        
            </div>
             <div class="row">
                <div class="col-sm-12">Plan de Manejo: <?php echo $plan_con;?></div>                        
            </div>
            <div class="row">
                <div class="col-sm-12">Observación: <?php echo $observacion_con;?></div>
            </div>
        </div>

        <div class="card border-light" style="width: 15rem;">
            <?php
                $firma='imagenes/firmas/'.$identif_prof.'.jpg';        
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