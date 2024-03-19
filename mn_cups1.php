<?php
require("valida_sesion.php");
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
                        <h4>CUPS Clasificación Unica de Procedimientos en Salud</h4>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevocups" title="Agrega Nuevo CUPS">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatacups"></div>
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
    <div class="modal fade" id="modalnuevocups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un CUPS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Código</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="codigo_cups" name="codigo_cups">
                        <label>Descripción</label>
                        <input type="text" maxlength="250" class="form-control input-sm" id="descripcion_cups" name="descripcion_cups">
                        <label>Norma que lo crea</label>
                        <input type="text" maxlength="15" class="form-control input-sm" id="norma_cups" name="norma_cups">
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
    <div class="modal fade" id="modaleditarcups" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Código</label>
                        <input type="hidden" id="id_cups" name="id_cups">               
                        <input type="text" maxlength="8" class="form-control input-sm" id="codigo_cupsU" name="codigo_cupsU">
                        <label>Descripción</label>
                        <input type="text" maxlength="250" class="form-control input-sm" id="descripcion_cupsU" name="descripcion_cupsU">
                        <label>Norma que lo crea</label>
                        <input type="text" maxlength="15" class="form-control input-sm" id="norma_cupsU" name="norma_cupsU">
                        
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
        $("#tablaDatacups").load("tablacups.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarcups.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatacups").load("tablacups.php");                        
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
                url:"procesos/actualizarcups.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatacups").load("tablacups.php");
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
    function FrmActualizar(idcups){        
        $.ajax({
            type:"POST",
            data:"idcups="+idcups,
            url:"procesos/obtenDatoscups.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_cups').val(datos['id_cups']);
                $('#codigo_cupsU').val(datos['codigo_cups']);
                $('#descripcion_cupsU').val(datos['descripcion_cups']);
                $('#norma_cupsU').val(datos['norma_cups']);
            }
        })
    }

    function cambiarestado(idcups){
        $.ajax({
            type:"POST",
            data:"idcups="+idcups,
            url:"procesos/cambiarestadocups.php",
            success:function(r){
                if(r==1){
                    $("#tablaDatacups").load("tablacups.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

</script>
