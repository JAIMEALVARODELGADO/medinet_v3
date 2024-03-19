<?php
require("valida_sesion.php");
if(isset($_POST['id_conveniopasar'])){
    $_SESSION['gid_convenio']=$_POST['id_conveniopasar'];
}
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$consultaconv="SELECT numero_conv, nombre_eps, fecha_conv FROM vw_convenio WHERE id_convenio='$_SESSION[gid_convenio]'";
$consultaconv=mysqli_query($conexion,$consultaconv);
$row=mysqli_fetch_row($consultaconv);
$numero_conv=$row[0];
$nombre_eps=$row[1];
$fecha_conv=$row[2];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>

    <link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>

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
                        <h4>Portafolio del Convenio</h4>
                    </div>

                    <div class="row">
                        <label class="col-sm-6 col-form-label"><b>EPS:</b> <?php echo $nombre_eps;?></label>
                    </div>
                    <div class="row">
                        <label class="col-sm-6 col-form-label"><b>Número:</b> <?php echo $numero_conv;?></label>
                    </div>
                    <div class="row">
                        <label class="col-sm-6 col-form-label"><b>Fecha:</b> <?php echo $fecha_conv;?></label>
                    </div>

                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoitem" title="Agrega Nuevo Item al Convenio">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataportafolio"></div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <a href="mn_convenio1.php" type="button" class="btn btn-secondary">Regresar <i class="fas fa-angle-double-left"></i></a>
                    </div>

                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevoitem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Servicio</label>
                        <input type="text" maxlength="100" class="form-control input-sm" id="servicio" name="servicio">
                        <input type="hidden" id="id_servicio" name="id_servicio">
                        <label>Descripción</label>
                        <input type="text" maxlength="100" class="form-control input-sm" id="descripcion_cdet" name="descripcion_cdet">
                        <label>Reportar en (Para RIPS)</label>
                        <select class="form-control" id="tipo_cdet" name="tipo_cdet">
                            <option value=""></option>
                            <option value="AC">Archivo de Consulta</option>
                            <option value="AP">Archivo de Procedimientos</option>
                            <option value="AM">Archivo de Medicamentos</option>
                            <option value="AT">Archivo de Otros Servicios</option>
                        </select>
                        <label>Código con el cual se reporta</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="codigo_cdet" name="codigo_cdet">
                        <label>Valor</label>
                        <input type="text" class="form-control input-sm" id="valor_cdet" name="valor_cdet">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_cdet" name="id_cdet">

                        <label>Descripción</label>
                        <input type="text" maxlength="100" class="form-control input-sm" id="descripcion_cdetU" name="descripcion_cdetU">
                        <label>Reportar en (Para RIPS)</label>
                        <select class="form-control" id="tipo_cdetU" name="tipo_cdetU">
                            <option value=""></option>
                            <option value="AC">Archivo de Consulta</option>
                            <option value="AP">Archivo de Procedimientos</option>
                            <option value="AM">Archivo de Medicamentos</option>
                            <option value="AT">Archivo de Otros Servicios</option>
                        </select>
                        <label>Código con el cual se reporta</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="codigo_cdetU" name="codigo_cdetU">
                        <label>Valor</label>
                        <input type="text" class="form-control input-sm" id="valor_cdetU" name="valor_cdetU">

                    </form>

                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataportafolio").load("tablaact_convenio.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregaract_convenio.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataportafolio").load("tablaact_convenio.php");
                        
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizaract_convenio.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataportafolio").load("tablaact_convenio.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });
    });
</script>

<script type="text/javascript">
    function Actualizar(idcdet){
        $.ajax({
            type:"POST",
            data:"idcdet="+idcdet,
            url:"procesos/obtenDatosact_convenio.php",
            success:function(r){                
                var datos = JSON.parse(r);
                $('#id_cdet').val(datos['id_cdet']);
                $('#descripcion_cdetU').val(datos['descripcion_cdet']);
                $('#tipo_cdetU').val(datos['tipo_cdet']);
                $('#codigo_cdetU').val(datos['codigo_cdet']);
                $('#valor_cdetU').val(datos['valor_cdet']);
            }
        })
    }

    function cambiarestado(idcdet){
        $.ajax({
            type:"POST",
            data:"idcdet="+idcdet,
            url:"procesos/cambiarestadoact_convenio.php",
            success:function(r){
                if(r==1){
                    $("#tablaDataportafolio").load("tablaact_convenio.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }
</script>

<script type="text/javascript">
    $().ready(function() {
        $("#servicio").autocomplete("procesos/autocomp_servicio.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#servicio").result(function(event, data, formatted) {
            $("#id_servicio").val(data[1]);
            $("#descripcion_cdet").val(data[0]);
        });        
    }); 
</script>