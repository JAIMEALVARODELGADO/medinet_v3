<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
require_once "procesos/mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$hoy=date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
<form id="form1" name='form1' method="POST">
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Informe de Consultas</h4>
                    </div>
                    <div class="card-body">
                        <h5>Parámetros para el Informe</h5>
                        <div class="form-group row">
                            <label for="titulo" class="col-sm-2 col-form-label">Título para el informe</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="titulo" name="titulo" size='200' value="INFORME DE CONSULTAS">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_persona" class="col-sm-2 col-form-label">Paciente</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_persona" name="id_persona" size='20' placeholder="digite la identificación del paciente">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_eps" class="col-sm-2 col-form-label">EPS</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="id_eps" name="id_eps">
                                    <option value=""></option>
                                    <?php
                                    $sql="SELECT id_eps,nombre_eps FROM eps ORDER BY nombre_eps";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                    ?>
                                </select>                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_profesional" class="col-sm-2 col-form-label">Profesional</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="id_profesional" name="id_profesional">
                                    <option value=""></option>
                                    <?php
                                    $sql="SELECT id_persona,nombre FROM vw_usuario WHERE agendar_usu='S' ORDER BY nombre";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                    ?>
                                </select>   
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-sm-2 col-form-label">Rango de Fechas</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechaini" name="fechaini" value="<?php echo $hoy;?>"> 
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechafin" name="fechafin" value="<?php echo $hoy;?>"> 
                            </div>
                        </div>
                        <hr>
                        <h5>Campos para el informe</h5>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_tipoiden_cod" id="chk_tipoiden_cod">Tipo de Identificación
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_descripcion_ciu" id="chk_descripcion_ciu">Ocupación
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_codigo_cups" id="chk_codigo_cups">Código CUPS
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_numeroiden_dp" id="chk_numeroiden_dp" checked="true">Número de Identificación
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_tipo_usuario" id="chk_tipo_usuario">Tipo de Usuario
                                    </label>
                                </div>
                            </div>                            
                            
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_descripcion_cups" id="chk_descripcion_cups">Descripción CUPS
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_dp" id="chk_nombre_dp" checked="true">Nombre
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_tipo_afiliado" id="chk_tipo_afiliado">Tipo de Afiliado
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_finalidad" id="chk_finalidad">Finalidad
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_fechanac_dp" id="chk_fechanac_dp">Fecha de Nacimiento
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_eps" id="chk_nombre_eps" checked="true">EPS
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_causaexte" id="chk_causaexte">Causa Externa
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_edad" id="chk_edad">Edad
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_fecha_aten" id="chk_fecha_aten" checked="true">Fecha de la consulta
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_analisis_con" id="chk_analisis_con">Análisis
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_sexo" id="chk_sexo">Sexo
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_prof" id="chk_nombre_prof" checked="true">Profesional
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_dxprinc_cod" id="chk_dxprinc_cod" checked="true">Código Dx Principal
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_direccion_dp" id="chk_direccion_dp">Dirección
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_motivo_con" id="chk_motivo_con">Motivo de la consulta
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_dxprinc" id="chk_dxprinc">Descripción Dx Principal
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_telefono_dp" id="chk_telefono_dp">Teléfono
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_enfermedad_con" id="chk_enfermedad_con">Enfermedad
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_tipodx" id="chk_tipodx">Tipo de Dx
                                    </label>
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_estado_civil" id="chk_estado_civil">Estado Civil
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_revisionsist_con" id="chk_revisionsist_con">Revisión por Sistemas
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_observacion_con" id="chk_observacion_con">Observación
                                    </label>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">                            
                            <label for="orden">
                                Ordenado por: 
                                <select class="form-control form-control-sm" name="orden" id="orden">
                                    <option value="fecha_aten">FECHA CONSULTA</option>
                                    <option value="numeroiden_dp">IDENTIFICACION</option>
                                    <option value="nombre_eps">EPS</option>
                                    <option value="nombre_prof">PROFESIONAL</option>
                                    <option value="codigo_cups">CUPS</option>
                                    <option value="dxprinc_cod">CODIGO DX</option>
                                </select>
                            </label>
                            <span class="btn btn-primary" title="Buscar" onclick="actcampos()" id="btn_buscar">Buscar <i class="fas fa-search"></i></span>
                            </span>                           
                        </div>
                    </div>

                    <div id="tablaDatainforme"></div>
                    <!--<div class="col-sm-6">
                        <span class="btn btn-success" title="Imprimir" onclick="imprimir()" id="btn_buscar">Imprimir <i class="fas fa-print"></i></span>
                        </span>
                    </div>-->
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="condicion" name="condicion">
    <input type="hidden" id="campos" name="campos">
    <input type="hidden" id="sql" name="sql">
</form>
</body>

</html>

<script type="text/javascript">
    acturalizar();
    $(document).ready(function(){
        $("#tablaDatainforme").load("tablainf_consulta.php");
    });
</script>


<script type="text/javascript">
    function actualizar(){
        condicion="estado_aten='C'";
        if($('#id_persona').val()!=""){
            condicion+=" AND numeroiden_dp='"+$('#id_persona').val()+"'";
        }
        if($('#id_eps').val()!=""){
            condicion+=" AND id_eps='"+$('#id_eps').val()+"'";
        }
        if($('#id_profesional').val()!=""){
            condicion+=" AND id_profesional='"+$('#id_profesional').val()+"'";
        }
        if($('#fechaini').val()!=""){
            condicion+=" AND fecha_aten between '"+$('#fechaini').val()+" 00:00' AND '"+$('#fechafin').val()+" 23:59'";
        }        
        //condicion=condicion.substring(5,200);
        $('#condicion').val(condicion);
        $('#sql').val("SELECT "+$('#campos').val()+" FROM vw_consulta WHERE "+$('#condicion').val()+" ORDER BY "+$('#orden').val());
        /*$(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarinforme1.php",                
            });
            $("#tablaDatainforme").load("tablainf_consulta.php");            
        });*/
        document.form1.action="mn_inf_consulta11.php";
        //document.form1.target="new";
        document.form1.submit();
    }

    function actcampos(){        
        var campos="";
        if($('#chk_tipoiden_cod').prop('checked')==true){            
            campos+="tipoiden_cod AS TP_IDENT,";        
        }
        if($('#chk_numeroiden_dp').prop('checked')==true){            
            campos+="numeroiden_dp AS IDENTIFICACION,";        
        }        
        if($('#chk_nombre_dp').prop('checked')==true){
            campos+="nombre_dp AS NOMBRE,";
        }
        if($('#chk_fechanac_dp').prop('checked')==true){
            campos+="fechanac_dp AS FECHA_NACIM,";
        }
        if($('#chk_edad').prop('checked')==true){
            campos+="edad AS EDAD,";
        }
        if($('#chk_sexo').prop('checked')==true){
            campos+="sexo AS SEXO,";
        }
        if($('#chk_direccion_dp').prop('checked')==true){
            campos+="direccion_dp AS DIRECCION,";
        }
        if($('#chk_telefono_dp').prop('checked')==true){
            campos+="telefono_dp AS TELEFONO,";
        }
        if($('#chk_estado_civil').prop('checked')==true){
            campos+="estado_civil AS ESTADO_CIVIL,";
        }
        if($('#chk_descripcion_ciu').prop('checked')==true){
            campos+="descripcion_ciu AS OCUPACION,";
        }        
        if($('#chk_tipo_usuario').prop('checked')==true){
            campos+="tipo_usuario AS TP_USUARIO,";
        }
        if($('#chk_tipo_afiliado').prop('checked')==true){
            campos+="tipo_afiliado AS TP_AFILIADO,";
        }
        if($('#chk_nombre_eps').prop('checked')==true){
            campos+="nombre_eps AS EPS,";
        }
        if($('#chk_fecha_aten').prop('checked')==true){
            campos+="fecha_aten AS FECHA_CONSULTA,";
        }
        if($('#chk_nombre_prof').prop('checked')==true){            
            campos+="nombre_prof AS PROFESIONAL,";        
        }
        if($('#chk_motivo_con').prop('checked')==true){
            campos+="motivo_con AS MOTIVO_CONSULTA,";
        }
        if($('#chk_enfermedad_con').prop('checked')==true){            
            campos+="enfermedad_con AS ENFERMEDAD,";        
        }
        if($('#chk_revisionsist_con').prop('checked')==true){            
            campos+="revisionsist_con AS REVISION_SISTEMAS,";        
        }
        if($('#chk_codigo_cups').prop('checked')==true){            
            campos+="codigo_cups AS CUPS,";        
        }
        if($('#chk_descripcion_cups').prop('checked')==true){            
            campos+="descripcion_cups AS DESCRIPCION_CUPS,";        
        }
        if($('#chk_finalidad').prop('checked')==true){            
            campos+="finalidad AS FINALIDAD,";        
        }
        if($('#chk_causaexte').prop('checked')==true){            
            campos+="causaexte AS CAUSA_EXTERNA,";        
        }
        if($('#chk_analisis_con').prop('checked')==true){            
            campos+="analisis_con AS ANALISIS,";        
        }
        if($('#chk_dxprinc_cod').prop('checked')==true){            
            campos+="dxprinc_cod AS CODIGO_DX,";        
        }
        if($('#chk_dxprinc').prop('checked')==true){            
            campos+="dxprinc AS DESCRIPCION_DX,";        
        }
        if($('#chk_tipodx').prop('checked')==true){            
            campos+="tipodx AS TIPO_DX,";        
        }
        if($('#chk_observacion_con').prop('checked')==true){            
            campos+="observacion_con AS OBSERVACION,";        
        }
        campos=campos.slice(0,-1);        
        $('#campos').val(campos);
        actualizar();
    }

    function imprimir(){
        document.form1.action="mn_impr_informe1.php";
        document.form1.target="new";
        document.form1.submit();
    }
</script>


