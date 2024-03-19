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
                        <h4>Informe de Citas</h4>
                    </div>
                    <div class="card-body">
                        <h5>Parámetros para el Informe</h5>
                        <div class="form-group row">
                            <label for="titulo" class="col-sm-2 col-form-label">Título para el informe</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="titulo" name="titulo" size='200' value="INFORME DE CITAS">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero_iden_per" class="col-sm-2 col-form-label">Paciente</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="numero_iden_per" name="numero_iden_per" size='20' placeholder="digite la identificación del paciente">                                 
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
                                        <input class="form-check-input" type="checkbox" name="chk_fecha_agh" id="chk_fecha_agh" checked="true">Fecha de la cita
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_telefono_per" id="chk_telefono_per">Teléfono
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_fechasol_agc" id="chk_fechasol_agc">Fecha de solicitud
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_numero_iden_per" id="chk_numero_iden_per" checked="true">Número de Identificación
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_profesional" id="chk_nombre_profesional" checked="true">Profesional
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_operador" id="chk_nombre_operador">Operador
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_persona" id="chk_nombre_persona" checked="true">Nombre
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
                                        <input class="form-check-input" type="checkbox" name="chk_observacion_agc" id="chk_observacion_agc">Observación
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_direccion_per" id="chk_direccion_per">Dirección
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_estado_agc" id="chk_estado_agc" checked="true">Estado de la cita
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_firma_agc" id="chk_firma_agc">Adicionar Espacio para Firma
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
                                    <option value="fecha_agh">FECHA CITA</option>
                                    <option value="numero_iden_per">IDENTIFICACION</option>
                                    <option value="nombre_eps">EPS</option>
                                    <option value="nombre_profesional">PROFESIONAL</option>
                                </select>
                            </label> 
                            <span class="btn btn-primary" title="Buscar" onclick="actcampos()" id="btn_buscar">Buscar <i class="fas fa-search"></i></span>
                            </span>                          
                        </div>
                        
                    </div>

                    <div id="tablaDatainforme"></div>
                    <div class="col-sm-6">
                        <span class="btn btn-success" title="Imprimir" onclick="imprimir()" id="btn_buscar">Imprimir <i class="fas fa-print"></i></span>
                        </span>
                    </div>
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
        $("#tablaDatainforme").load("tablainf_general.php");
    });
</script>


<script type="text/javascript">
    function actualizar(){
        condicion="";
        if($('#numero_iden_per').val()!=""){
            condicion+=" AND numero_iden_per='"+$('#numero_iden_per').val()+"'";
        }
        if($('#id_eps').val()!=""){
            condicion+=" AND id_eps='"+$('#id_eps').val()+"'";
        }
        if($('#id_profesional').val()!=""){
            condicion+=" AND id_profesional='"+$('#id_profesional').val()+"'";
        }
        if($('#fechaini').val()!=""){
            condicion+=" AND fecha_agh between '"+$('#fechaini').val()+" 00:00' AND '"+$('#fechafin').val()+" 23:59'";
        }        
        condicion=condicion.substring(5,200);
        $('#condicion').val(condicion);
        $('#sql').val("SELECT "+$('#campos').val()+" FROM vw_citas WHERE "+$('#condicion').val()+" ORDER BY "+$('#orden').val());
        $(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarinforme1.php",                
            });
            $("#tablaDatainforme").load("tablainf_general.php");            
        });
    }

    function actcampos(){        
        var campos="";
        if($('#chk_fecha_agh').prop('checked')==true){            
            campos+="fecha_agh AS FECHA_CITA,";        
        }
        if($('#chk_numero_iden_per').prop('checked')==true){            
            campos+="numero_iden_per AS IDENTIFICACION,";        
        }        
        if($('#chk_nombre_persona').prop('checked')==true){
            campos+="nombre_persona AS NOMBRE,";
        }        
        if($('#chk_direccion_per').prop('checked')==true){
            campos+="direccion_per AS DIRECCION,";
        }
        if($('#chk_telefono_per').prop('checked')==true){
            campos+="telefono_per AS TELEFONO,";
        }        
        if($('#chk_nombre_profesional').prop('checked')==true){            
            campos+="nombre_profesional AS PROFESIONAL,";        
        }
        if($('#chk_nombre_eps').prop('checked')==true){
            campos+="nombre_eps AS EPS,";
        }
        if($('#chk_estado_agc').prop('checked')==true){            
            campos+="estado_agc AS ESTADO,";        
        }
        if($('#chk_fechasol_agc').prop('checked')==true){            
            campos+="fechasol_agc AS FECHA_SOLICITUD,";        
        }
        if($('#chk_nombre_operador').prop('checked')==true){            
            campos+="nombre_operador AS OPERADOR,";        
        }
        if($('#chk_observacion_agc').prop('checked')==true){            
            campos+="observacion_agc AS OBSERVACION,";        
        }        
        if($('#chk_firma_agc').prop('checked')==true){            
            campos+="'' AS FIRMA,";        
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


