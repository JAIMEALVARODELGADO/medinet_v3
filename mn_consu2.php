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
    <?php
    require("encabezado.php");
    require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Historias</h4>
                    </div>
                    <div class="card-body">                        
                            <div class="form-group row">
                                <label for="id_persona" class="col-sm-2 col-form-label">Identificación del Paciente</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id_persona" name="id_persona" size='20' placeholder="digite la identificación del paciente">                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_persona" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre" name="nombre" size='40' placeholder="digite el nombre del paciente o parte del mismo">                                 
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
                                <div class="col-sm-3">
                                    <span class="btn btn-primary" title="Buscar" onclick="actualizar()" id="btn_buscar">Buscar <span class="fas fa-search"></span></span>
                                    </span>
                                </div>                                
                            </div>
                        </div>
                        
                        <div id="tablaDatahistoria"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form1" name='form1' method="POST">
        <input type="hidden" id="id_aten" name="id_aten">
        <input type="hidden" id="condicion" name="condicion">
    </form>
</body>

</html>

<script type="text/javascript">
    acturalizar();
    $(document).ready(function(){
        $("#tablaDatahistoria").load("tablaconsultahistorica.php");
    });
</script>


<script type="text/javascript">
    function imprimir(id_){        
        $('#id_aten').val(id_);
        document.form1.action="mn_impr_historia.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function imprimirformula(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_formula.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function imprimirorden(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_orden.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function imprimirproced(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_proced.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function actualizar(){
        condicion="";
        if($('#id_persona').val()!=""){
            condicion+=" AND numero_iden_per='"+$('#id_persona').val()+"'";
        }
        if($('#nombre').val()!=""){
            condicion+=" AND nombre LIKE '%"+$('#nombre').val()+"%'";
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
        condicion=condicion.substring(5,200);
        $('#condicion').val(condicion);
        $(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarhorario2.php",                
            });
            $("#tablaDatahistoria").load("tablaconsultahistorica.php");
            //$('#id_agh').val("");
        });
    }
</script>
