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
    <?php 
        require_once "scripts.php";        
    ?>
    
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php")
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>CIUO Clacificación Internacional Uniforme de Ocupaciones</h4>                        
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevociuo" title="Agrega Nuevo CUPS a un Profesional">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataciuo"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Modal Nuevo -->
    <div class="modal fade" id="modalnuevociuo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar una Ocupación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Código</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="codigo_ciuo" name="codigo_ciuo">                        
                        <label>Descripción</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="descripcion_ciu" name="descripcion_ciu">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnNuevo" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modaleditarciuo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Ocupación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Código</label>
                        <input type="hidden" id="id_ciuo" name="id_ciuo">
                        <input type="text" maxlength="4" class="form-control input-sm" id="codigo_ciuoU" name="codigo_ciuoU">                        
                        <label>Descripción</label>
                        <input type="text" maxlength="150" class="form-control input-sm" id="descripcion_ciuU" name="descripcion_ciuU"> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" id="btnActualizar" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataciuo").load("tablaciuo.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarciuo.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataciuo").load("tablaciuo.php");                        
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
                url:"procesos/actualizarciuo.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataciuo").load("tablaciuo.php");
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
    function FrmActualizar(idciuo){        
        $.ajax({
            type:"POST",
            data:"idciuo="+idciuo,
            url:"procesos/obtenDatosciuo.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_ciuo').val(datos['id_ciuo']);
                $('#codigo_ciuoU').val(datos['codigo_ciuo']);
                $('#descripcion_ciuU').val(datos['descripcion_ciu']);
            }
        })
    }

    function cambiarestado(idciuo){
        $.ajax({
            type:"POST",
            data:"idciuo="+idciuo,
            url:"procesos/cambiarestadociuo.php",
            success:function(r){
                if(r==1){
                    $("#tablaDataciuo").load("tablaciuo.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })
    }

</script>
