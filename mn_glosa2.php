<?php
require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
    <!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>-->
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php");
    $hoy=date('Y-m-d');
    //echo $hoy;
    ?>
    <div class="card text">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="mn_glosa1.php">Glosas Abiertas</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link active" href="#">Glosas Cerradas</a>
                </li>               
            </ul>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card text-left">
                        <div class="card-header">
                            <h4>Glosas Cerradas</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="fecha_ini" class="col-sm-2 col-form-label">Fecha Desde:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="<?php echo $hoy;?>" onblur="actualizar()">
                                </div>
                                <label for="fechacie_ini" class="col-sm-2 col-form-label">Factura:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="factura" name="factura" onblur="actualizar()">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fecha_fin" class="col-sm-2 col-form-label">Hasta:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo $hoy;?>" onblur="actualizar()">
                                </div>
                                <label for="eps" class="col-sm-2 col-form-label">EPS:</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="eps" name="eps" onchange="actualizar()">
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

                            <div id="tablaData"></div>
                        </div>
                        <div class="card-footer text-muted">
                            By Soluciones Thin & Thin
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<form name="frm_glosa" id="frm_glosa" action="mn_glosa21.php" method="POST">    
    <input type="hidden" id="condicion" name="condicion">
    <input type="hidden" id="id_glosa" name="id_glosa">
</form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        actualizar();
    });
</script>

<script type="text/javascript">
    function actualizar(){
        condicion="estado_glo<>'A'";
        if($('#fecha_ini').val()!=""){
           condicion+=" AND fecharecep_glo between '"+$('#fecha_ini').val()+"'";
        }
        if($('#fecha_fin').val()!=""){
           condicion+=" AND '"+$('#fecha_fin').val()+"'";
        }
        if($('#factura').val()!=""){
           condicion+=" AND numero_fac='"+$('#factura').val()+"'";
        }
        if($('#eps').val()!=""){
           condicion+=" AND id_eps='"+$('#eps').val()+"'";
        }
        $('#condicion').val(condicion);
        $(document).ready(function(){
            datos=$('#frm_glosa').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarcons.php",
                
            });
            $("#tablaData").load("tablaglosacerrada.php");
        });
    }

    function imprimir(idglosa){
        $('#id_glosa').val(idglosa);
        document.frm_glosa.action="mn_impr_glosa.php";
        document.frm_glosa.target="new";
        document.frm_glosa.submit();
    }
</script>

