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
                        <h4>Generando Vistas</h4>
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
                            $sql="CREATE OR REPLACE VIEW vw_detalle_grupo AS  
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det, grupos.id_grupo,grupos.descripcion_grupo
                            FROM detalle_grupo
                            INNER JOIN grupos ON grupos.id_grupo=detalle_grupo.id_grupo";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_detalle_grupo NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;


                            $sql="CREATE OR REPLACE VIEW vw_conceptos AS
                            SELECT detalle_grupo.codi_det,detalle_grupo.id_grupo,detalle_grupo.descripcion_det,detalle_grupo.valor_det,grupos.descripcion_grupo
                            FROM detalle_grupo
                            INNER JOIN grupos ON grupos.id_grupo=detalle_grupo.id_grupo";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_conceptos NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;                        

                            $sql="CREATE OR REPLACE VIEW vw_tipo_ident AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=1";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tipo_ident NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_sexo AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=2";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_sexo NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_tpusuario AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=3";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tpusuario NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_etnia AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=4";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_etnia NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_niveducat AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=5";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_niveducat NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_estadocivil AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=6";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_estadocivil NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_estadocita AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=7";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_estadocita NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_tpafiliado AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=8";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tpafiliado NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_tpvinculacion AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=3";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tpafiliado NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_grupopobla AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=9";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_grupopobla NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_zona AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=10";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_zona NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;                    

                            $sql="CREATE OR REPLACE VIEW vw_finalidad_con AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=11";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_finalidad_con NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_causa_exte AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=12";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_causa_exte NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_tpdiagnostico AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=13";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tpdiagnostico NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_via AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=14";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_via NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_tipoorden AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=15";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tipoorden NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_ambito AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=16";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_ambito NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_finalidad_proc AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=17";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_finalidad_proc NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_forma_qx AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=18";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_forma_qx NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_condicion_victima AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=19";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_condicion_victima NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_naturaleza_evento AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=20";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_naturaleza_evento NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_estado_aseguramiento AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=21";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_estado_aseguramiento NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_tipo_vehiculo AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=22";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tipo_vehiculo NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_tipo_referencia AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=23";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_tipo_referencia NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_forma_pago AS
                            SELECT detalle_grupo.codi_det, detalle_grupo.descripcion_det, detalle_grupo.valor_det FROM detalle_grupo WHERE detalle_grupo.id_grupo=24";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_forma_pago NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_municipio AS
                            SELECT municipio.codigo_mun, municipio.nombre_mun, departameto.nombre_dep FROM municipio INNER JOIN departameto ON departameto.codigo_dep=municipio.codigo_dep";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_municipio NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_usuario AS
                            SELECT persona.id_persona,vw_tipo_ident.valor_det,persona.numero_iden_per,concat(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre ,persona.direccion_per,persona.telefono_per,persona.email_per,usuario.login_usu,usuario.password_usu,usuario.profesion_usu,usuario.registro_usu,usuario.cargo_usu,usuario.agendar_usu,usuario.estado_usu,usuario.tomasignos_usu,usuario.examenfis_usu 
                            FROM persona 
                            INNER JOIN usuario ON usuario.id_persona=persona.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_usuario NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_paciente AS
                            SELECT persona.id_persona, CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per,' ' ,detalle_grupo.valor_det,' ', persona.numero_iden_per) AS nombre 
                            FROM persona 
                            INNER JOIN detalle_grupo ON detalle_grupo.codi_det=persona.tipo_iden_per
                            INNER JOIN paciente ON paciente.id_persona=persona.id_persona";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_paciente NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_agenda_medico AS
                            SELECT agenda_cita.id_agc,agenda_cita.estado_agc,agenda_cita.observacion_agc,agenda_horario.fecha_agh,agenda_horario.id_persona AS id_profesional,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,profesional.sape_per) AS nombre_profesional,
                            persona.id_persona,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,persona.sape_per) AS nombre
                            FROM agenda_cita
                            INNER JOIN agenda_horario ON agenda_horario.id_agh=agenda_cita.id_agh
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN persona AS profesional ON profesional.id_persona=agenda_horario.id_persona";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_agenda_medico NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_cups_profesional AS
                            SELECT idcups_prof,cups_profesional.id_persona,cups_profesional.id_cups,estado_cprof,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre, cups.codigo_cups,cups.descripcion_cups,cups_profesional.clase_cprof,cups.estado_cups 
                            FROM cups_profesional 
                            INNER JOIN persona ON persona.id_persona=cups_profesional.id_persona 
                            INNER JOIN cups ON cups.id_cups=cups_profesional.id_cups";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_cups_profesional NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_cie AS
                            SELECT id_cie,CONCAT(codigo_cie,' ',descripcion_cie) AS descripcion FROM cie WHERE estado_cie='A'";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_cie NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_persona_paciente AS
                            SELECT persona.id_persona,persona.tipo_iden_per,vw_tipo_ident.valor_det AS tipo_ident,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_per, persona.fnac_per, persona.sexo_per,vw_sexo.valor_det AS sexo, persona.direccion_per,persona.telefono_per,persona.email_per,
                            paciente.codigo_mun,paciente.zona,
                            paciente.tipo_usuario,paciente.etnia,paciente.nivel_educ,paciente.id_ciuo,ciuo.codigo_ciuo,ciuo.descripcion_ciu,paciente.estado_civ
                            FROM persona
                            INNER JOIN paciente ON paciente.id_persona=persona.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN vw_sexo ON vw_sexo.codi_det=persona.sexo_per
                            INNER JOIN ciuo ON ciuo.id_ciuo=paciente.id_ciuo";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_persona_paciente NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_formula_detalle AS
                           SELECT consulta_formula.id_aten,consulta_formula_detalle.id_form_det, consulta_formula_detalle.id_form, consulta_formula_detalle.id_medicamento, medicamento.nombre_mto, consulta_formula_detalle.dosis_det, consulta_formula_detalle.frecuencia_det, consulta_formula_detalle.via_det, vw_via.descripcion_det AS via_admin, consulta_formula_detalle.tiempo_trat_det, consulta_formula_detalle.cantidad_det, consulta_formula_detalle.observacion_det FROM consulta_formula_detalle INNER JOIN consulta_formula ON consulta_formula.id_form=consulta_formula_detalle.id_form INNER JOIN medicamento ON medicamento.id_medicamento=consulta_formula_detalle.id_medicamento INNER JOIN vw_via ON vw_via.codi_det=consulta_formula_detalle.via_det";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_formula_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            //Esta vista esta vinculada con la tabla consulta_dpersonales, que está quedando con datos erroneos y mientras se soluciona se hace la consulta con las tablas persona y paciente
                            /*$sql="CREATE OR REPLACE VIEW vw_consulta AS
                            SELECT atencion.id_aten,atencion.id_agc,atencion.fecha_aten,
                            atencion.id_profesional, CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_prof,
                            atencion.estado_aten,
                            consulta.id_con,consulta.control_con,consulta.motivo_con,consulta.enfermedad_con,consulta.revisionsist_con,consulta.subjetivo_con,consulta.objetivo_con,consulta.id_cups,
                            cups.codigo_cups,cups.descripcion_cups,
                            consulta.finalidad_con,vw_finalidad_con.descripcion_det AS finalidad,vw_finalidad_con.valor_det AS finalidad_cod,
                            consulta.causaext_con,vw_causa_exte.descripcion_det AS causaexte,vw_causa_exte.valor_det AS causaext_cod,
                            consulta.analisis_con,consulta.dxprinc_con,consulta.plan_con,
                            cie.codigo_cie AS dxprinc_cod,cie.descripcion_cie AS dxprinc,
                            consulta.dxrela1_con,
                            consulta.dxrela2_con,
                            consulta.dxrela3_con,
                            consulta.tipodx_con,
                            vw_tpdiagnostico.descripcion_det AS tipodx,vw_tpdiagnostico.valor_det AS tipodx_cod,
                            consulta.observacion_con,
                            vw_tipo_ident.descripcion_det AS tipoiden,vw_tipo_ident.valor_det AS tipoiden_cod,
                            consulta_dpersonales.numeroiden_dp,consulta_dpersonales.nombre_dp,consulta_dpersonales.fechanac_dp,TRUNCATE((DATEDIFF(atencion.fecha_aten,consulta_dpersonales.fechanac_dp)/365.25),0) AS edad,vw_sexo.descripcion_det AS sexo,consulta_dpersonales.direccion_dp,consulta_dpersonales.telefono_dp,ciuo.descripcion_ciu,vw_estadocivil.descripcion_det AS estado_civil,vw_tpusuario.descripcion_det AS tipo_usuario,vw_tpafiliado.descripcion_det AS tipo_afiliado, agenda_cita.id_eps,eps.nombre_eps
                            FROM atencion
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional
                            INNER JOIN consulta ON consulta.id_aten=atencion.id_aten
                            INNER JOIN cups ON cups.id_cups=consulta.id_cups
                            INNER JOIN vw_finalidad_con ON vw_finalidad_con.codi_det=consulta.finalidad_con
                            INNER JOIN vw_causa_exte ON vw_causa_exte.codi_det=consulta.causaext_con
                            INNER JOIN cie ON cie.id_cie=consulta.dxprinc_con
                            INNER JOIN vw_tpdiagnostico ON vw_tpdiagnostico.codi_det=consulta.tipodx_con
                            INNER JOIN consulta_dpersonales ON consulta_dpersonales.id_aten=atencion.id_aten
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=consulta_dpersonales.tipoiden_dp
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN vw_sexo ON vw_sexo.codi_det=consulta_dpersonales.genero_dp
                            INNER JOIN ciuo ON ciuo.id_ciuo=consulta_dpersonales.ocupacion_dp
                            INNER JOIN vw_estadocivil ON vw_estadocivil.codi_det=consulta_dpersonales.estadociv_dp
                            INNER JOIN vw_tpafiliado ON vw_tpafiliado.codi_det=consulta_dpersonales.tipoafil_dp
                            INNER JOIN vw_tpusuario ON vw_tpusuario.codi_det=consulta_dpersonales.tipovin_dp";*/

                            $sql="CREATE OR REPLACE VIEW vw_consulta AS
                            SELECT atencion.id_aten,atencion.id_agc,atencion.fecha_aten,
                            atencion.id_profesional, CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_prof,
                            atencion.estado_aten,
                            consulta.id_con,consulta.control_con,consulta.motivo_con,consulta.enfermedad_con,consulta.revisionsist_con,consulta.subjetivo_con,consulta.objetivo_con,consulta.id_cups,
                            cups.codigo_cups,cups.descripcion_cups,
                            consulta.finalidad_con,vw_finalidad_con.descripcion_det AS finalidad,vw_finalidad_con.valor_det AS finalidad_cod,
                            consulta.causaext_con,vw_causa_exte.descripcion_det AS causaexte,vw_causa_exte.valor_det AS causaext_cod,
                            consulta.analisis_con,consulta.dxprinc_con,consulta.plan_con,
                            cie.codigo_cie AS dxprinc_cod,cie.descripcion_cie AS dxprinc,
                            consulta.dxrela1_con,
                            consulta.dxrela2_con,
                            consulta.dxrela3_con,
                            consulta.tipodx_con,
                            consulta.violencia_sexual_con,
                            vw_tpdiagnostico.descripcion_det AS tipodx,vw_tpdiagnostico.valor_det AS tipodx_cod,
                            consulta.observacion_con,
                            vw_tipo_ident.descripcion_det AS tipoiden,vw_tipo_ident.valor_det AS tipoiden_cod,
                            persona.numero_iden_per AS numeroiden_dp,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_dp,persona.fnac_per AS fechanac_dp,TRUNCATE((DATEDIFF(atencion.fecha_aten,persona.fnac_per)/365.25),0) AS edad, vw_sexo.descripcion_det AS sexo,persona.direccion_per AS direccion_dp,persona.telefono_per AS telefono_dp,ciuo.descripcion_ciu,vw_estadocivil.descripcion_det AS estado_civil,vw_tpusuario.descripcion_det AS tipo_usuario,'' AS tipo_afiliado, agenda_cita.id_eps,eps.nombre_eps
                            FROM atencion
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional
                            INNER JOIN consulta ON consulta.id_aten=atencion.id_aten
                            INNER JOIN cups ON cups.id_cups=consulta.id_cups
                            INNER JOIN vw_finalidad_con ON vw_finalidad_con.codi_det=consulta.finalidad_con
                            INNER JOIN vw_causa_exte ON vw_causa_exte.codi_det=consulta.causaext_con
                            INNER JOIN cie ON cie.id_cie=consulta.dxprinc_con
                            INNER JOIN vw_tpdiagnostico ON vw_tpdiagnostico.codi_det=consulta.tipodx_con
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN vw_sexo ON vw_sexo.codi_det=persona.sexo_per
                            LEFT JOIN paciente ON paciente.id_persona=persona.id_persona
                            LEFT JOIN ciuo ON ciuo.id_ciuo=paciente.id_ciuo
                            LEFT JOIN vw_estadocivil ON vw_estadocivil.codi_det=paciente.estado_civ
                            LEFT JOIN vw_tpusuario ON vw_tpusuario.codi_det=paciente.tipo_usuario";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_consulta NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_atencion AS
                            SELECT atencion.id_aten,atencion.id_agc,fecha_aten,
                            agenda_cita.id_persona,persona.tipo_iden_per,vw_tipo_ident.valor_det AS tipoident,persona.sexo_per,persona.fnac_per,TRUNCATE((DATEDIFF(atencion.fecha_aten,persona.fnac_per)/365.25),0) AS edad,persona.direccion_per,persona.telefono_per,
                            persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,
                            atencion.id_profesional,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_profesional,estado_aten,agenda_cita.id_eps,
                            eps.nombre_eps
                            FROM atencion
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_atencion NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            

                            $sql="CREATE OR REPLACE VIEW vw_atencion_fac AS
                            SELECT atencion.id_aten,atencion.fecha_aten,atencion.estado_aten,
                            persona.id_persona,vw_tipo_ident.valor_det AS tipoidenper,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,
                            agenda_cita.id_eps,eps.nombre_eps,
                            'C' AS tipoaten,
                            consulta.id_con,cups.codigo_cups,cups.descripcion_cups,
                            atencion.id_profesional,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,profesional.sape_per) AS nombre_profesional,consulta.facturado_con AS facturado
                            FROM atencion
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN consulta ON consulta.id_aten=atencion.id_aten
                            INNER JOIN cups ON cups.id_cups=consulta.id_cups
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional
                            UNION
                            SELECT atencion.id_aten,atencion.fecha_aten,atencion.estado_aten,
                            persona.id_persona,vw_tipo_ident.valor_det AS tipoidenper,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,
                            agenda_cita.id_eps,eps.nombre_eps,
                            'P' AS tipoaten,
                            procedimiento.id_procedimiento,cups.codigo_cups,cups.descripcion_cups,
                            atencion.id_profesional,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,profesional.sape_per) AS nombre_profesional,procedimiento.facturado_proc AS facturado
                            FROM atencion
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN procedimiento ON procedimiento.id_aten=atencion.id_aten
                            INNER JOIN cups ON cups.id_cups=procedimiento.id_cups
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_atencion_fac NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_antecedentes AS
                            SELECT consulta_antecedentes.id_con_ante,consulta_antecedentes.id_con,consulta_antecedentes.personales_ante,consulta_antecedentes.familiares_ante,atencion.fecha_aten,persona.id_persona,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_prof
                            FROM consulta_antecedentes
                            INNER JOIN consulta ON consulta.id_con=consulta_antecedentes.id_con
                            INNER JOIN atencion ON atencion.id_aten=consulta.id_aten
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_antecedentes NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_consulta_efisico AS
                            SELECT consulta_examen_fisico.id_exaf,consulta_examen_fisico.descripcion_exaf,consulta_examen_fisico.valor_exaf,consulta_examen_fisico.hallazgo_exaf,consulta.id_con,atencion.fecha_aten,agenda_cita.id_persona,vw_tipo_ident.valor_det AS tipoident,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.Snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,CONCAT(profesional.pnom_per,' ',profesional.Snom_per,' ',profesional.pape_per,profesional.sape_per) AS nombre_prof
                            FROM consulta_examen_fisico
                            INNER JOIN consulta ON consulta.id_con=consulta_examen_fisico.id_con
                            INNER JOIN atencion ON atencion.id_aten=consulta.id_aten
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_consulta_efisico NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;                    
                            
                            $sql="CREATE OR REPLACE VIEW vw_formula_encabezado AS
                            SELECT consulta_formula.id_form,consulta_formula.id_aten,
                            vw_tipo_ident.descripcion_det AS tipo_iden,persona.numero_iden_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,TRUNCATE(DATEDIFF(atencion.fecha_aten,persona.fnac_per)/365.25,0) AS edad,vw_sexo.descripcion_det AS sexo,persona.direccion_per,persona.telefono_per,eps.nombre_eps,
                            atencion.fecha_aten,atencion.id_profesional,profesional.numero_iden_per AS identificacion_profe, CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_profe,consulta_dpersonales.tipovin_dp,vw_tpvinculacion.descripcion_det AS tipo_vinculacion,consulta_dpersonales.tipoafil_dp, vw_tpafiliado.descripcion_det AS tipo_afiliado 
                            FROM consulta_formula
                            INNER JOIN atencion ON atencion.id_aten=consulta_formula.id_aten
                            INNER JOIN consulta_dpersonales on consulta_dpersonales.id_aten=atencion.id_aten
                            INNER JOIN vw_tpafiliado ON vw_tpafiliado.codi_det=consulta_dpersonales.tipoafil_dp
                            INNER JOIN vw_tpvinculacion ON vw_tpvinculacion.codi_det=consulta_dpersonales.tipovin_dp
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional                            
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN vw_sexo ON vw_sexo.codi_det=persona.sexo_per";

                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_formula_encabezado NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_consulta_orden AS
                            SELECT consulta_orden.id_ord,consulta_orden.id_aten,consulta_orden.tipo_ord,
                            vw_tipoorden.descripcion_det AS tipoorden,
                            atencion.fecha_aten,atencion.id_profesional,
                            persona.tipo_iden_per,vw_tipo_ident.descripcion_det AS tipoident,persona.numero_iden_per,
                            CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre,
                            TRUNCATE((DATEDIFF(atencion.fecha_aten,persona.fnac_per))/365.25,0) AS edad,persona.direccion_per,persona.telefono_per,
                            eps.nombre_eps
                            FROM consulta_orden
                            INNER JOIN vw_tipoorden ON vw_tipoorden.codi_det=consulta_orden.tipo_ord
                            INNER JOIN atencion ON atencion.id_aten=consulta_orden.id_aten
                            INNER JOIN agenda_cita on agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_consulta_orden NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_orden_detalle AS
                            SELECT consulta_orden_detalle.id_ord_det,consulta_orden_detalle.id_ord,consulta_orden_detalle.id_cups,consulta_orden_detalle.observacion_det,
                            cups.codigo_cups,cups.descripcion_cups
                            FROM consulta_orden_detalle
                            INNER JOIN cups ON cups.id_cups=consulta_orden_detalle.id_cups";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_orden_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_nousuario AS
                            SELECT persona.id_persona,CONCAT(persona.numero_iden_per,' ',persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre FROM persona LEFT JOIN usuario ON usuario.id_persona=persona.id_persona WHERE ISNULL(usuario.id_persona)";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_nousuario NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_cups AS
                            SELECT cups.id_cups,CONCAT(cups.codigo_cups,' ',cups.descripcion_cups) AS descripcion_cups,cups.estado_cups FROM cups";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_cups NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_horarios AS
                            SELECT agenda_horario.id_agh,agenda_horario.id_persona,agenda_horario.fecha_agh,agenda_horario.estado_agh,agenda_horario.operador_agh,agenda_horario.fechagen_agh,
                            CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_prof, usuario.profesion_usu,
                            CONCAT(operador.pnom_per,' ',operador.snom_per,' ',operador.pape_per,' ',operador.sape_per) AS nombre_operador
                            FROM agenda_horario
                            INNER JOIN persona AS profesional ON profesional.id_persona=agenda_horario.id_persona
                            INNER JOIN usuario ON usuario.id_persona=profesional.id_persona
                            INNER JOIN persona AS operador ON operador.id_persona=agenda_horario.operador_agh";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_horarios NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_citas AS
                            SELECT agenda_cita.id_agc, agenda_cita.id_agh,
                            agenda_horario.fecha_agh,profesional.id_persona AS id_profesional,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_profesional,
                            agenda_cita.id_persona, persona.numero_iden_per, CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_persona,persona.direccion_per,persona.telefono_per,
                            agenda_cita.id_eps,eps.nombre_eps,
                            agenda_cita.estado_agc,agenda_cita.observacion_agc,agenda_cita.operador_agc,CONCAT(operador.pnom_per,' ',operador.snom_per,' ',operador.pape_per,' ',operador.sape_per) AS nombre_operador,
                            agenda_cita.fechasol_agc
                            FROM
                            agenda_cita
                            INNER JOIN agenda_horario ON agenda_horario.id_agh=agenda_cita.id_agh
                            INNER JOIN persona AS profesional ON profesional.id_persona=agenda_horario.id_persona
                            INNER JOIN persona ON persona.id_persona=agenda_cita.id_persona
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN persona AS operador ON operador.id_persona=agenda_cita.operador_agc";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_citas NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_examenfisico_medico AS
                            SELECT examenfisico_medico.id_exmed,examenfisico_medico.id_mef,examenfisico_medico.id_persona,det_examenfisico.descripcion_def
                            FROM examenfisico_medico
                            INNER JOIN det_examenfisico ON det_examenfisico.id_mef=examenfisico_medico.id_mef";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_examenfisico_medico NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_convenio AS
                            SELECT convenio_encabezado.id_convenio, convenio_encabezado.numero_conv, convenio_encabezado.id_eps,
                            eps.nombre_eps,
                            convenio_encabezado.fecha_conv, convenio_encabezado.observacion_conv, convenio_encabezado.estado_conv, CONCAT( convenio_encabezado.numero_conv,' ',eps.nombre_eps) AS convenio_eps
                            FROM convenio_encabezado
                            INNER JOIN eps ON eps.id_eps=convenio_encabezado.id_eps";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_convenio NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_convenio_detalle AS
                            SELECT convenio_detalle.id_cdet, convenio_detalle.id_convenio, convenio_detalle.descripcion_cdet, convenio_detalle.tipo_cdet, convenio_detalle.codigo_cdet, convenio_detalle.valor_cdet, convenio_detalle.estado_cdet,
                            convenio_encabezado.numero_conv, convenio_encabezado.estado_conv,
                            catalogo.id_medicamento,catalogo.codigoatc_mto,catalogo.nombre_mto,catalogo.tipo_mto,
                            eps.nombre_eps
                            FROM convenio_detalle
                            INNER JOIN convenio_encabezado ON convenio_encabezado.id_convenio=convenio_detalle.id_convenio
                            INNER JOIN medicamento AS catalogo ON catalogo.id_medicamento=convenio_detalle.id_servicio
                            INNER JOIN eps ON eps.id_eps=convenio_encabezado.id_eps";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_convenio_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_factura AS
                            SELECT factura_encabezado.id_factura,factura_encabezado.prefijo_fac,factura_encabezado.numero_fac,factura_encabezado.id_persona,
                            vw_tipo_ident.valor_det AS tipoiden_per,
                            persona.numero_iden_per, CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_pac,persona.direccion_per, persona.telefono_per,
                            factura_encabezado.id_convenio,convenio_encabezado.numero_conv,eps.id_eps,eps.nombre_eps,
                            factura_encabezado.fecha_fac,factura_encabezado.fechaini_fac,factura_encabezado.fechafin_fac,factura_encabezado.fechacierre_fac,factura_encabezado.operador_fac,
                            operador.numero_iden_per AS identif_operador, CONCAT(operador.pnom_per,' ',operador.snom_per,' ',operador.pape_per,' ',operador.sape_per) AS nombre_operador,
                            factura_encabezado.id_ccobro,factura_encabezado.valortot_fac,factura_encabezado.copago_fac,factura_encabezado.descuento_fac,factura_encabezado.valorneto_fac,factura_encabezado.esta_fac,factura_encabezado.formapago_fac,vw_forma_pago.descripcion_det AS nombre_formapago
                            FROM factura_encabezado
                            INNER JOIN persona ON persona.id_persona=factura_encabezado.id_persona
                            INNER JOIN convenio_encabezado ON convenio_encabezado.id_convenio=factura_encabezado.id_convenio
                            INNER JOIN eps ON eps.id_eps=convenio_encabezado.id_eps
                            INNER JOIN persona AS operador ON operador.id_persona=factura_encabezado.operador_fac
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            LEFT JOIN vw_forma_pago ON vw_forma_pago.codi_det= factura_encabezado.formapago_fac";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_factura NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_factura_detalle AS
                            SELECT factura_detalle.id_detfac, factura_detalle.id_factura,factura_detalle.tipo_detfac, factura_encabezado.numero_fac, SUBSTR(factura_encabezado.fecha_fac,1,10) AS fecha_fac, factura_encabezado.id_ccobro, factura_detalle.id_con, factura_detalle.id_cdet,
                            convenio_detalle.descripcion_cdet, convenio_detalle.tipo_cdet, convenio_detalle.codigo_cdet,
                            factura_detalle.cantidad_detfac,factura_detalle.valor_unit_detfac, (factura_detalle.cantidad_detfac*factura_detalle.valor_unit_detfac) AS valor_total 
                            FROM factura_detalle 
                            INNER JOIN factura_encabezado ON factura_encabezado.id_factura=factura_detalle.id_factura
                            INNER JOIN convenio_detalle ON convenio_detalle.id_cdet=factura_detalle.id_cdet";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_factura_detalle NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_factura_lista AS
                            SELECT id_factura,CONCAT(numero_fac,' ',nombre_eps,' ',nombre_pac) AS descripcion FROM vw_factura WHERE esta_fac='C'";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_factura_lista NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_usuarios_factura_rips AS
                            SELECT factura_encabezado.id_factura,factura_encabezado.id_ccobro,factura_encabezado.esta_fac,factura_encabezado.id_persona,vw_tipo_ident.valor_det AS tipoiden, persona.numero_iden_per,persona.pape_per,persona.sape_per,persona.pnom_per,persona.snom_per,TRUNCATE(DATEDIFF(factura_encabezado.fecha_fac,persona.fnac_per)/365.25,0) AS edad, vw_sexo.valor_det AS sexo, paciente.codigo_mun,paciente.zona, vw_tpusuario.valor_det AS tipousuario
                            FROM factura_encabezado
                            INNER JOIN persona ON persona.id_persona=factura_encabezado.id_persona
                            INNER JOIN paciente ON paciente.id_persona=persona.id_persona
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN vw_sexo ON vw_sexo.codi_det=persona.sexo_per
                            INNER JOIN vw_tpusuario ON vw_tpusuario.codi_det=paciente.tipo_usuario";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_usuarios_factura_rips NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            
                            $sql="CREATE OR REPLACE VIEW vw_cuentacobro AS
                            SELECT factura_cuentacobro.id_ccobro, factura_cuentacobro.numero_ccob, factura_cuentacobro.fecha_ccob,factura_cuentacobro.fechaini_ccob, factura_cuentacobro.fechafin_ccob, factura_cuentacobro.id_eps, eps.nombre_eps, eps.nit_eps, eps.codigo_eps, factura_cuentacobro.concepto_ccob, factura_cuentacobro.estado_ccob 
                            FROM factura_cuentacobro
                            INNER JOIN eps ON eps.id_eps=factura_cuentacobro.id_eps";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_cuentacobro NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_ripsac AS
                            SELECT rips_ac.id_ripsac, rips_ac.id_ccobro, rips_ac.id_detfac,factura_encabezado.id_factura, factura_encabezado.numero_fac, rips_ac.fechacon_rac, rips_ac.numeroauto_rac, rips_ac.codigocon_rac, rips_ac.finalidad_rac, rips_ac.causaexte_rac, rips_ac.dxprincipal_rac, rips_ac.dxrel1_rac, rips_ac.dxrel2_rac, rips_ac.dxrel3_rac, rips_ac.tipodxprin_rac, rips_ac.valorcon_rac, rips_ac.valorcmode_rac, vw_usuarios_factura_rips.tipoiden,vw_usuarios_factura_rips.numero_iden_per,factura_encabezado.esta_fac
                            FROM rips_ac 
                            INNER JOIN factura_detalle ON factura_detalle.id_detfac=rips_ac.id_detfac
                            INNER JOIN factura_encabezado ON factura_encabezado.id_factura=factura_detalle.id_factura
                            INNER JOIN vw_usuarios_factura_rips ON vw_usuarios_factura_rips.id_factura=factura_encabezado.id_factura";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_ripsac NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_ripsap AS
                            SELECT rips_ap.id_ripsap,rips_ap.id_ccobro,rips_ap.id_detfac,factura_encabezado.id_factura,factura_encabezado.numero_fac,rips_ap.fechaproc_rap,rips_ap.numeroauto_rap,rips_ap.codigoproc_rap,rips_ap.ambito_rap,rips_ap.finalidad_rap,rips_ap.personal_rap,rips_ap.dxprincipal_rap,rips_ap.dxrelac_rap,rips_ap.complica_rap,rips_ap.formareali_rap,rips_ap.valor_rap,vw_usuarios_factura_rips.tipoiden,vw_usuarios_factura_rips.numero_iden_per,factura_encabezado.esta_fac
                            FROM rips_ap
                            INNER JOIN factura_detalle ON factura_detalle.id_detfac=rips_ap.id_detfac
                            INNER JOIN factura_encabezado ON factura_encabezado.id_factura=factura_detalle.id_factura
                            INNER JOIN vw_usuarios_factura_rips ON vw_usuarios_factura_rips.id_factura=factura_encabezado.id_factura";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_ripsap NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_procedimiento AS
                            SELECT atencion.id_aten,atencion.fecha_aten,atencion.estado_aten, vw_persona_paciente.id_persona,vw_persona_paciente.tipo_ident,vw_persona_paciente.numero_iden_per,vw_persona_paciente.nombre_per,vw_persona_paciente.fnac_per,TRUNCATE((DATEDIFF(atencion.fecha_aten,vw_persona_paciente.fnac_per)/365.25),0) AS edad,vw_persona_paciente.sexo,vw_persona_paciente.direccion_per,vw_persona_paciente.telefono_per,agenda_cita.id_eps,eps.nombre_eps ,procedimiento.id_procedimiento, procedimiento.id_cups, cups.codigo_cups,cups.descripcion_cups, procedimiento.ambito_proc,vw_ambito.descripcion_det AS ambito_descrip,vw_ambito.valor_det AS ambito_cod, procedimiento.finalidad_proc, vw_finalidad_proc.descripcion_det AS finalidad_descrip,vw_finalidad_proc.valor_det AS finalidad_cod,procedimiento.dxprinc_proc,ciedxpr.descripcion_cie AS descrip_dxpr,ciedxpr.codigo_cie AS dxprinc_cod,procedimiento.dxrelac_proc,ciedxrel.descripcion_cie AS descrip_dxrel,ciedxrel.codigo_cie AS dxrelac_cod, procedimiento.complic_proc,complica.descripcion_cie AS descrip_compli,complica.codigo_cie AS complica_cod, procedimiento.forma_proc,procedimiento.observacion_proc,atencion.id_profesional,profesional.numero_iden_per AS identif_prof,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.pape_per) AS nombre_profe
                            FROM atencion 
                            INNER JOIN agenda_cita ON agenda_cita.id_agc=atencion.id_agc
                            INNER JOIN vw_persona_paciente ON vw_persona_paciente.id_persona=agenda_cita.id_persona
                            INNER JOIN eps ON eps.id_eps=agenda_cita.id_eps
                            INNER JOIN procedimiento ON procedimiento.id_aten=atencion.id_aten
                            INNER JOIN cups ON cups.id_cups=procedimiento.id_cups 
                            INNER JOIN vw_ambito ON vw_ambito.codi_det=procedimiento.ambito_proc 
                            INNER JOIN vw_finalidad_proc ON vw_finalidad_proc.codi_det=procedimiento.finalidad_proc 
                            INNER JOIN persona AS profesional ON profesional.id_persona=atencion.id_profesional
                            LEFT JOIN cie AS ciedxpr ON ciedxpr.id_cie=procedimiento.dxprinc_proc
                            LEFT JOIN cie AS ciedxrel ON ciedxrel.id_cie=procedimiento.dxrelac_proc
                            LEFT JOIN cie AS complica ON complica.id_cie=procedimiento.complic_proc";
                            //echo $sql;                        

                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_procedimiento NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_medicamento AS
                            SELECT medicamento.id_medicamento,medicamento.codigoatc_mto,medicamento.nombre_mto,CONCAT(medicamento.codigoatc_mto,' ',medicamento.nombre_mto) AS descripcion,medicamento.estado_mto,medicamento.tipo_mto,
                            (SELECT CASE medicamento.tipo_mto
                            WHEN 'M' THEN 'Medicamento'
                            WHEN 'D' THEN 'Dispositivo'
                            ELSE 'Paquete'
                            END) AS tipo_mto_desc
                            FROM medicamento";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_medicamento NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;


                            $sql="CREATE OR REPLACE VIEW vw_medicamento_paquete AS
                            SELECT medicamento_paquete.id_medpq,medicamento_paquete.id_medicamento_pq,medicamento_paquete.id_medicamento,medicamento_paquete.cantidad_medpq,medicamento_paquete.estado_medpq,
                            medicamento.codigoatc_mto,medicamento.nombre_mto,medicamento.tipo_mto
                            FROM medicamento_paquete
                            INNER JOIN medicamento ON medicamento.id_medicamento=medicamento_paquete.id_medicamento";
                            //echo $sql;
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_medicamento_paquete NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_menu AS
                            SELECT menu_usuario.id_musu,menu_usuario.id_persona,menu_usuario.id_menu,
                            CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_per,
                            menu.orden_menu,menu.opcion_menu,menu.nivel_menu,menu.dependencia_menu,menu.tienesub_menu,menu.url_menu
                            FROM menu_usuario
                            INNER JOIN persona ON persona.id_persona=menu_usuario.id_persona
                            INNER JOIN menu ON menu.id_menu=menu_usuario.id_menu";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_menu NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_glosaconcepto AS
                            SELECT concepto_glosa.id_conglo,concepto_glosa.codigo_conglo,concepto_glosa.descripcion_conglo,concepto_glosa.estado_conglo,glosa_codigo.id_glosacod,glosa_codigo.descripcion_cod
                            FROM concepto_glosa
                            INNER JOIN glosa_codigo ON glosa_codigo.id_glosacod=concepto_glosa.id_glosacod";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_glosaconcepto NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_glosa_persona AS
                            SELECT concepto_persona.id_conper,concepto_persona.id_persona,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_per,concepto_persona.id_conglo,concepto_glosa.codigo_conglo,concepto_glosa.descripcion_conglo FROM concepto_persona INNER JOIN persona ON persona.id_persona=concepto_persona.id_persona INNER JOIN concepto_glosa ON concepto_glosa.id_conglo=concepto_persona.id_conglo";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_glosa_persona NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_glosa AS
                            SELECT glosa.id_glosa,glosa.fecharecep_glo,glosa.id_eps,eps.nombre_eps,glosa.id_factura,factura_encabezado.numero_fac,factura_encabezado.fechacierre_fac,factura_encabezado.valorneto_fac,glosa.valor_glo,glosa.motivo_glo,glosa.fechaentrega_glo,glosa.responsable_resp_glo,glosa.respuesta_glo,CONCAT(usuario_resp.pnom_per,' ',usuario_resp.snom_per,' ',usuario_resp.pape_per,' ',usuario_resp.sape_per) As nombre_responsable, glosa.fecha_envio_glo,glosa.valor_fav_glo,glosa.valor_fav_eps,glosa.guia_glo,glosa.estado_glo,glosa.fechareg_glo,glosa.operador_glo, CONCAT(operador.pnom_per,' ',operador.snom_per,' ',operador.pape_per,' ',operador.sape_per) AS nombre_operador
                                FROM glosa
                                INNER JOIN eps ON eps.id_eps=glosa.id_eps
                                INNER JOIN factura_encabezado ON factura_encabezado.id_factura=glosa.id_factura
                                LEFT JOIN persona AS usuario_resp ON usuario_resp.id_persona=glosa.responsable_resp_glo
                                INNER JOIN persona AS operador ON operador.id_persona=glosa.operador_glo";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_glosa NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_glosa_respuesta AS
                            SELECT glosa_respuesta.id_resp,glosa_respuesta.id_glosa,glosa_respuesta.id_detfac,vw_factura_detalle.descripcion_cdet,glosa_respuesta.id_persona,glosa_respuesta.fechacont_resp,glosa_respuesta.valoracepta_resp,glosa_respuesta.observacion_resp,glosa_respuesta.fechareg_resp,CONCAT(responsable.pnom_per,' ',responsable.snom_per,' ',responsable.pape_per,' ',responsable.sape_per) AS nombre_responsable,concepto_glosa.codigo_conglo,concepto_glosa.descripcion_conglo,glosa_respuesta.estado_resp
                            FROM glosa_respuesta
                            INNER JOIN persona AS responsable ON responsable.id_persona=glosa_respuesta.id_persona
                            INNER JOIN concepto_glosa ON concepto_glosa.id_conglo=glosa_respuesta.id_conglo
                            LEFT JOIN vw_factura_detalle ON vw_factura_detalle.id_detfac=glosa_respuesta.id_detfac";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_glosa_respuesta NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_glosa_conciliacion AS
                            SELECT glosa_conciliacion.id_conciliacion,glosa_conciliacion.id_eps,eps.nombre_eps,glosa_conciliacion.id_factura,factura_encabezado.numero_fac,factura_encabezado.valorneto_fac,glosa_conciliacion.fecha_conciliacion,glosa_conciliacion.fecha_firma_concil,glosa_conciliacion.valor_conciliar,glosa_conciliacion.valor_entidad,glosa_conciliacion.valor_eps,glosa_conciliacion.valor_ratificado,glosa_conciliacion.saldo_concil,glosa_conciliacion.observacion_concil,glosa_conciliacion.estado_concil,glosa_conciliacion.operador_concil,CONCAT(operador.pnom_per,' ',operador.Snom_per,' ',operador.pape_per,' ',operador.sape_per) AS nombre_operador
                            FROM glosa_conciliacion
                            INNER JOIN eps ON eps.id_eps=glosa_conciliacion.id_eps
                            INNER JOIN factura_encabezado ON factura_encabezado.id_factura=glosa_conciliacion.id_factura
                            INNER JOIN persona AS operador ON operador.id_persona=glosa_conciliacion.operador_concil";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_glosa_conciliacion NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_glosa_abono AS
                            SELECT glosa_abono.id_abono,glosa_abono.id_eps,eps.nombre_eps,glosa_abono.id_factura,factura_encabezado.numero_fac,factura_encabezado.valorneto_fac,glosa_abono.fecha_abono,glosa_abono.documento_abono,glosa_abono.valor_abono,glosa_abono.dias_mora_abono,glosa_abono.observacion_abono,glosa_abono.operador_abono,CONCAT(operador.pnom_per,' ',operador.snom_per,' ',operador.pape_per,' ',operador.sape_per) AS nombre_operador,glosa_abono.estado_abono
                            FROM glosa_abono
                            INNER JOIN eps ON eps.id_eps=glosa_abono.id_eps
                            INNER JOIN factura_encabezado ON factura_encabezado.id_factura=glosa_abono.id_factura
                            INNER JOIN persona AS operador ON operador.id_persona=glosa_abono.operador_abono";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_glosa_abono NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;                        

                            $sql="CREATE OR REPLACE VIEW vw_furips_nopersona AS
                            SELECT furips_persona.id_persona,CONCAT(furips_persona.numero_ident,' ',furips_persona.pnom_per,' ',furips_persona.snom_per,' ',furips_persona.pape_per,' ',furips_persona.sape_per) AS nombre FROM furips_persona";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_furips_nopersona NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_furips_persona AS
                            SELECT furips_persona.id_persona,furips_persona.tipo_ident,vw_tipo_ident.valor_det AS tipo_ident_per,furips_persona.numero_ident,furips_persona.pape_per,furips_persona.sape_per,furips_persona.pnom_per,furips_persona.snom_per,CONCAT(furips_persona.pnom_per,' ',furips_persona.snom_per,' ',furips_persona.pape_per,' ',furips_persona.sape_per) AS nombre_per,furips_persona.direccion_per,furips_persona.telefono_per,furips_persona.municipio_per,municipio.nombre_mun
                            FROM furips_persona 
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=furips_persona.tipo_ident
                            INNER JOIN municipio ON municipio.codigo_mun=furips_persona.municipio_per";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_furips_persona NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_furips_reclamacion AS
                            SELECT furips_reclamacion.id_reclamacion,furips_reclamacion.numero_recant,furips_reclamacion.respglo_recla,furips_reclamacion.id_factura,furips_reclamacion.condi_victima,vw_condicion_victima.valor_det AS cod_condi_victima,furips_reclamacion.naturaleza_even,vw_naturaleza_evento.valor_det AS cod_naturaleza_even,furips_reclamacion.descripcion_even,furips_reclamacion.direccion_even,furips_reclamacion.fecha_even,furips_reclamacion.municipio_even,municipio_even.nombre_mun AS nombre_mun_even,municipio_even.codigo_dep AS cod_depart_even,departameto_even.nombre_dep AS nombre_dep_even,furips_reclamacion.zona_even,furips_reclamacion.estado_recla,furips_reclamacion.fecha_reg,furips_reclamacion.id_operador,factura_encabezado.numero_fac,persona.id_persona,vw_tipo_ident.valor_det AS tipo_iden,persona.numero_iden_per,persona.pnom_per,persona.snom_per,persona.pape_per,persona.sape_per,CONCAT(persona.pnom_per,' ',persona.snom_per,' ',persona.pape_per,' ',persona.sape_per) AS nombre_pac,persona.fnac_per,vw_sexo.valor_det AS sexo,persona.direccion_per,persona.telefono_per,paciente.codigo_mun,municipio.nombre_mun,municipio.codigo_dep,departameto.nombre_dep
                            FROM furips_reclamacion
                            INNER JOIN factura_encabezado ON factura_encabezado.id_factura=furips_reclamacion.id_factura
                            INNER JOIN persona ON persona.id_persona=factura_encabezado.id_persona
                            INNER JOIN paciente ON paciente.id_persona=persona.id_persona
                            INNER JOIN municipio ON municipio.codigo_mun=paciente.codigo_mun
                            INNER JOIN departameto ON departameto.codigo_dep=municipio.codigo_dep
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=persona.tipo_iden_per
                            INNER JOIN vw_sexo ON vw_sexo.codi_det=persona.sexo_per
                            INNER JOIN vw_condicion_victima ON vw_condicion_victima.codi_det=furips_reclamacion.condi_victima
                            INNER JOIN vw_naturaleza_evento ON vw_naturaleza_evento.codi_det=furips_reclamacion.naturaleza_even
                            INNER JOIN municipio AS municipio_even ON municipio_even.codigo_mun=furips_reclamacion.municipio_even
                            INNER JOIN departameto AS departameto_even ON departameto_even.codigo_dep=municipio_even.codigo_dep";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_furips_reclamacion NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_furips_vehiculo AS
                            SELECT furips_vehiculo.id_vehiculo,furips_vehiculo.id_reclamacion,furips_vehiculo.id_propietario,vw_tipo_ident_prop.valor_det AS tipo_ident_prop,propietario.numero_ident AS numero_ident_prop,propietario.pape_per AS pape_prop,propietario.sape_per AS sape_prop,propietario.pnom_per AS pnom_prop,propietario.snom_per AS snom_prop,propietario.direccion_per AS direccion_prop,propietario.telefono_per AS telefono_prop,propietario.municipio_per AS municipio_prop,municipio_prop.nombre_mun AS nombre_mun_prop,municipio_prop.codigo_dep AS codigo_dep_prop,departameto_prop.nombre_dep AS nombre_dep_prop,furips_vehiculo.id_conductor,vw_tipo_ident_cond.valor_det AS tipo_ident_cond,conductor.numero_ident AS numero_ident_cond,conductor.pape_per AS pape_cond,conductor.sape_per AS sape_cond,conductor.pnom_per AS pnom_cond,conductor.snom_per AS snom_cond,conductor.direccion_per AS direccion_cond,conductor.telefono_per AS telefono_cond,conductor.municipio_per AS municipio_cond,municipio_cond.nombre_mun AS nombre_mun_cond,municipio_cond.codigo_dep AS codigo_dep_cond,departameto_cond.nombre_dep AS nombre_dep_cond,furips_vehiculo.estado_aseg,vw_estado_aseguramiento.descripcion_det AS desc_estado_aseg,vw_estado_aseguramiento.valor_det AS cod_estado_aseg,furips_vehiculo.marca_vehiculo,furips_vehiculo.placa_vehiculo,furips_vehiculo.tipo_vehiculo,vw_tipo_vehiculo.descripcion_det AS desc_tipo_vehiculo,vw_tipo_vehiculo.valor_det AS cod_tipo_vehiculo,furips_vehiculo.codigo_aseg,furips_vehiculo.nombre_aseg,furips_vehiculo.numero_poliza,furips_vehiculo.fecha_inicio,furips_vehiculo.fecha_final,furips_vehiculo.intervencion_aut,furips_vehiculo.cobro_excedente,furips_vehiculo.placa_vehiculo2,furips_vehiculo.tipoiden_propvehi2,furips_vehiculo.identprop_vehi2,furips_vehiculo.placa_vehiculo3,furips_vehiculo.tipoiden_propvehi3,furips_vehiculo.identprop_vehi3
                            FROM furips_vehiculo
                            INNER JOIN vw_estado_aseguramiento ON vw_estado_aseguramiento.codi_det=furips_vehiculo.estado_aseg
                            INNER JOIN vw_tipo_vehiculo ON vw_tipo_vehiculo.codi_det=furips_vehiculo.tipo_vehiculo
                            INNER JOIN furips_persona AS propietario ON propietario.id_persona=furips_vehiculo.id_propietario
                            INNER JOIN furips_persona AS conductor ON conductor.id_persona=furips_vehiculo.id_conductor
                            INNER JOIN vw_tipo_ident AS vw_tipo_ident_prop ON vw_tipo_ident_prop.codi_det=propietario.tipo_ident
                            INNER JOIN municipio AS municipio_prop ON municipio_prop.codigo_mun=propietario.municipio_per
                            INNER JOIN departameto AS departameto_prop ON departameto_prop.codigo_dep=municipio_prop.codigo_dep
                            INNER JOIN vw_tipo_ident AS vw_tipo_ident_cond ON vw_tipo_ident_cond.codi_det=conductor.tipo_ident
                            INNER JOIN municipio AS municipio_cond ON municipio_cond.codigo_mun=conductor.municipio_per
                            INNER JOIN departameto AS departameto_cond ON departameto_cond.codigo_dep=municipio_cond.codigo_dep";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_furips_vehiculo NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_furips_atencion AS
                            SELECT furips_atencion.id_atencion,furips_atencion.id_reclamacion,furips_atencion.fecha_ingreso,furips_atencion.fecha_egreso,
                                furips_atencion.dx_principal_ingre,cie_princ_ingre.codigo_cie AS codigo_cie_princ_ingr,cie_princ_ingre.descripcion_cie AS desc_cie_princ_ingr,
                                furips_atencion.dx_relac1_ingre,cie_rel1_ingre.codigo_cie AS codigo_cie_rel1_ingr,cie_rel1_ingre.descripcion_cie AS desc_cie_rel1_ingr,
                                furips_atencion.dx_relac2_ingre,cie_rel2_ingre.codigo_cie AS codigo_cie_rel2_ingr,cie_rel2_ingre.descripcion_cie AS desc_cie_rel2_ingr,
                                furips_atencion.dx_principal_egre,cie_princ_egre.codigo_cie AS codigo_cie_princ_egre,cie_princ_egre.descripcion_cie AS desc_cie_princ_egre,
                                furips_atencion.dx_relac1_egre,cie_rel1_egre.codigo_cie AS codigo_cie_rel1_egre,cie_rel1_egre.descripcion_cie AS desc_cie_rel1_egre,
                                furips_atencion.dx_relac2_egre,cie_rel2_egre.codigo_cie AS codigo_cie_rel2_egre,cie_rel1_egre.descripcion_cie AS desc_cie_rel2_egre,
                                furips_atencion.id_profesional,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_prof,profesional.pnom_per AS pnom_prof,profesional.snom_per AS snom_prof,profesional.pape_per AS pape_prof,profesional.sape_per AS sape_prof,profesional.numero_iden_per AS numero_iden_prof,vw_tipo_ident.valor_det  AS tipo_iden_prof,usuario.registro_usu
                            FROM furips_atencion
                            INNER JOIN cie AS cie_princ_ingre ON cie_princ_ingre.id_cie=furips_atencion.dx_principal_ingre
                            INNER JOIN cie AS cie_princ_egre ON cie_princ_egre.id_cie=furips_atencion.dx_principal_egre
                            INNER JOIN persona AS profesional ON profesional.id_persona=furips_atencion.id_profesional
                            LEFT JOIN cie AS cie_rel1_ingre ON cie_rel1_ingre.id_cie=furips_atencion.dx_relac1_ingre
                            LEFT JOIN cie AS cie_rel2_ingre ON cie_rel2_ingre.id_cie=furips_atencion.dx_relac2_ingre
                            LEFT JOIN cie AS cie_rel1_egre ON cie_rel1_egre.id_cie=furips_atencion.dx_relac1_egre
                            LEFT JOIN cie AS cie_rel2_egre ON cie_rel2_egre.id_cie=furips_atencion.dx_relac2_egre
                            INNER JOIN vw_tipo_ident ON vw_tipo_ident.codi_det=profesional.tipo_iden_per
                            INNER JOIN usuario ON usuario.id_persona=profesional.id_persona";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_furips_atencion NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;

                            $sql="CREATE OR REPLACE VIEW vw_furips_remision AS
                            SELECT furips_remision.id_remision,furips_remision.id_reclamacion,
                                furips_remision.tipo_refer,vw_tipo_referencia.descripcion_det AS dec_tipo_referencia,vw_tipo_referencia.valor_det AS cod_tipo_referemcia,
                                furips_remision.fecha_remi,furips_remision.hora_salida,furips_remision.cod_habilitacion_remi,furips_remision.nombre_ent_remite,furips_remision.profesional_remite,furips_remision.cargo_remite,furips_remision.fecha_ingre_remi,
                                furips_remision.id_profesional_recibe,CONCAT(profesional.pnom_per,' ',profesional.snom_per,' ',profesional.pape_per,' ',profesional.sape_per) AS nombre_prof,usuario.cargo_usu
                            FROM furips_remision 
                            INNER JOIN vw_tipo_referencia ON vw_tipo_referencia.codi_det=furips_remision.tipo_refer
                            INNER JOIN persona AS profesional ON profesional.id_persona=furips_remision.id_profesional_recibe
                            INNER JOIN usuario ON usuario.id_persona=profesional.id_persona";
                            $res=mysqli_query($conexion,$sql);
                            if($res<>1){
                                echo "<div class='col-sm-12'>vw_furips_remision NO CREADA</div>";
                                $error++;
                            }
                            incrementar($cont);
                            $cont++;
                            //echo $cont;                          

                            if($error<>0){
                                ?>
                                <b>Atención:</b>
                                <br>Comunique los anteriores errores al personal de soporte técnico de MEDINET
                                <?php
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

<?php
function incrementar($c_){
    $totvistas=71;
    $por_vistas=($c_*100)/$totvistas;
    if($por_vistas>98){
        $por_vistas=100;
    }    
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            incrementabarra(<?php echo $por_vistas;?>);
        });
    </script>
    <?php
}

?>
<script type="text/javascript">
    function incrementabarra(valor){
        valor=valor+"%";        
        $(".progress-bar").animate({
        width: valor
        },1);        
    }

</script>