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
                        <h4>Informe de Conciliaciones</h4>
                    </div>
                    <div class="card-body">
                        <h5>Parámetros para el Informe</h5>
                        <div class="form-group row">
                            <label for="titulo" class="col-sm-2 col-form-label">Título para el informe</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="titulo" name="titulo" size='200' value="INFORME DE CONCILIACIONES">                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero_fac" class="col-sm-2 col-form-label">Factura</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="numero_fac" name="numero_fac" size='20' placeholder="digite el número de factura">                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_eps" class="col-sm-2 col-form-label">EPS</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="id_eps" name="id_eps">
                                    <option value="">Todas</option>
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
                            <label for="fecha" class="col-sm-2 col-form-label">Rango de Fechas de la Conciliación</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechaini" name="fechaini" value="<?php echo $hoy;?>"> 
                            </div>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="fechafin" name="fechafin" value="<?php echo $hoy;?>"> 
                            </div>
                            <span class="btn btn-primary" title="Buscar" onclick="actcampos()" id="btn_buscar">Buscar <i class="fas fa-search"></i></span>
                            </span>
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
        $("#tablaDatainforme").load("tablainf_glosa.php");
    });
</script>


<script type="text/javascript">
    function actualizar(){
        condicion="estado_concil='C'";
        if($('#numero_fac').val()!=""){
            condicion+=" AND numero_fac='"+$('#numero_fac').val()+"'";
        }
        if($('#id_eps').val()!=""){
            condicion+=" AND id_eps='"+$('#id_eps').val()+"'";
        }
        if($('#fechaini').val()!=""){
            condicion+=" AND fecha_conciliacion between '"+$('#fechaini').val()+"' AND '"+$('#fechafin').val()+"'";
        }
        //condicion=condicion.substring(5,200);
        $('#condicion').val(condicion);
        $('#sql').val("SELECT "+$('#campos').val()+" FROM vw_glosa_conciliacion WHERE "+$('#condicion').val());
            //)";
        $(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarinforme1.php",                
            });
            $("#tablaDatainforme").load("tablainf_conciliacion.php");            
        });
    }

    function actcampos(){        
        var campos="numero_fac AS FACTURA,fecha_conciliacion AS FECHA_CONCILIACION,fecha_firma_concil AS FECHA_FIRMA,nombre_eps AS EPS,valorneto_fac AS VALOR_FACTURA,valor_conciliar AS VALOR_A_CONCILIAR,valor_entidad AS VALOR_A_FAVOR,valor_eps AS VALOR_EPS,valor_ratificado AS VALOR_RATIFICADO,saldo_concil AS SALDO,observacion_concil AS OBSERVACION,nombre_operador AS RESPONSABLE";
        campos=campos.slice(0,-1);        
        $('#campos').val(campos);
        actualizar();
    }

    function imprimir(){
        document.form1.action="mn_impr_informeconcil.php";
        document.form1.target="new";
        document.form1.submit();
    }
</script>


