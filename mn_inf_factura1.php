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
                                <input type="text" class="form-control" id="titulo" name="titulo" size='200' value="INFORME DE FACTURAS">                                 
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
                            <label for="fechacie_ini" class="col-sm-2 col-form-label">Rango de Fechas de Cierre</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechacie_ini" name="fechacie_ini" value="<?php echo $hoy;?>"> 
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechacie_fin" name="fechacie_fin" value="<?php echo $hoy;?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaini" class="col-sm-2 col-form-label">Rango de Fechas</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechaini" name="fechaini"> 
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechafin" name="fechafin"> 
                            </div>
                        </div>

                        <hr>
                        <h5>Campos para el informe</h5>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_numero_fac" id="chk_numero_fac" checked="true">Número de Factura
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
                                        <input class="form-check-input" type="checkbox" name="chk_valortot_fac" id="chk_valortot_fac">Valor Total
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
                                        <input class="form-check-input" type="checkbox" name="chk_numero_conv" id="chk_numero_conv">Número de Convenio
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_copago_fac" id="chk_copago_fac">Valor Copago
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_nombre_pac" id="chk_nombre_pac" checked="true">Nombre
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_fecha_fac" id="chk_fecha_fac">Fecha de la factura
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_descuento_fac" id="chk_descuento_fac">Descuento
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
                                        <input class="form-check-input" type="checkbox" name="chk_fechacierre_fac" id="chk_fechacierre_fac" checked="true">Fecha de cierre
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="chk_valorneto_fac" id="chk_valorneto_fac" checked="true">Valor Neto
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
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
                                        <input class="form-check-input" type="checkbox" name="chk_esta_fac" id="chk_esta_fac" checked="true">Estado de la factura
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
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="orden">
                                Ordenado por: 
                                <select class="form-control form-control-sm" name="orden" id="orden">
                                    <option value="numero_fac">NUMERO</option>
                                    <option value="fecha_fac">FECHA FACTURA</option>
                                    <option value="numero_iden_per">IDENTIFICACION</option>
                                    <option value="nombre_eps">EPS</option>                                    
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
        $("#tablaDatainforme").load("tablainf_consulta.php");
    });
</script>


<script type="text/javascript">
    function actualizar(){
        condicion="esta_fac<>'A'";
        if($('#numero_iden_per').val()!=""){
            condicion+=" AND numero_iden_per='"+$('#numero_iden_per').val()+"'";
        }
        if($('#id_eps').val()!=""){
            condicion+=" AND id_eps='"+$('#id_eps').val()+"'";
        }
        
        if($('#fechaini').val()!=""){
            condicion+=" AND fecha_fac between '"+$('#fechaini').val()+"' AND '"+$('#fechafin').val()+"'";
        }
        if($('#fechacie_ini').val()!=""){
            condicion+=" AND fechacierre_fac between '"+$('#fechacie_ini').val()+"' AND '"+$('#fechacie_fin').val()+"'";
        }
        //condicion=condicion.substring(5,200);
        $('#condicion').val(condicion);
        $('#sql').val("SELECT "+$('#campos').val()+" FROM vw_factura WHERE "+$('#condicion').val()+" ORDER BY "+$('#orden').val());
        $(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarinforme1.php",                
            });
            $("#tablaDatainforme").load("tablainf_consulta.php");            
        });
    }

    function actcampos(){        
        var campos="";
        if($('#chk_numero_fac').prop('checked')==true){
            campos+="numero_fac AS NUMERO_FAC,";        
        }        
        if($('#chk_numero_iden_per').prop('checked')==true){            
            campos+="numero_iden_per AS IDENTIFICACION,";        
        }        
        if($('#chk_nombre_pac').prop('checked')==true){
            campos+="nombre_pac AS NOMBRE,";
        }        
        if($('#chk_direccion_per').prop('checked')==true){
            campos+="direccion_per AS DIRECCION,";
        }
        if($('#chk_telefono_per').prop('checked')==true){
            campos+="telefono_per AS TELEFONO,";
        }
        if($('#chk_nombre_eps').prop('checked')==true){
            campos+="nombre_eps AS EPS,";
        }
        if($('#chk_numero_conv').prop('checked')==true){            
            campos+="numero_conv AS CONVENIO,";        
        }
        if($('#chk_fecha_fac').prop('checked')==true){            
            campos+="fecha_fac AS FECHA_FACTURA,";        
        }
        if($('#chk_fechacierre_fac').prop('checked')==true){            
            campos+="fechacierre_fac AS FECHA_CIERRE,";        
        }
        if($('#chk_esta_fac').prop('checked')==true){            
            campos+="esta_fac AS ESTADO,";        
        }
        if($('#chk_valortot_fac').prop('checked')==true){            
            campos+="valortot_fac AS VALOR_TOT,";        
        }
        if($('#chk_copago_fac').prop('checked')==true){            
            campos+="copago_fac AS COPAGO,";        
        }
        if($('#chk_descuento_fac').prop('checked')==true){            
            campos+="descuento_fac AS DESCUENTO,";        
        }
        if($('#chk_valorneto_fac').prop('checked')==true){            
            campos+="valorneto_fac AS VALOR_NETO,";        
        }
        if($('#chk_nombre_operador').prop('checked')==true){            
            campos+="nombre_operador AS OPERADOR,";        
        }        
        campos=campos.slice(0,-1);        
        $('#campos').val(campos);
        actualizar();
    }

    function imprimir(){
        document.form1.action="mn_impr_informe_fac.php";
        document.form1.target="new";
        document.form1.submit();
    }
</script>


