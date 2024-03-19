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
                        <h4>CIE Código Internacional de Enfermedades</h4>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevocie" title="Agrega Nueva Enfermedad">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatacie"></div>
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
    <div class="modal fade" id="modalnuevocie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un CIE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Código</label>
                        <input type="text" maxlength="4" class="form-control input-sm" id="codigo_cie" name="codigo_cie">
                        <label>Descripción</label>
                        <input type="text" maxlength="200" class="form-control input-sm" id="descripcion_cie" name="descripcion_cie">
                        
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
    <div class="modal fade" id="modaleditarcie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar CIE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Código</label>
                        <input type="hidden" id="id_cie" name="id_cie">               
                        <input type="text" maxlength="4" class="form-control input-sm" id="codigo_cieU" name="codigo_cieU">
                        <label>Descripción</label>
                        <input type="text" maxlength="200" class="form-control input-sm" id="descripcion_cieU" name="descripcion_cieU">
                        
                        
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
        $("#tablaDatacie").load("tablacie.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarcie.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatacie").load("tablacie.php");                        
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
                url:"procesos/actualizarcie.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatacie").load("tablacie.php");
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
    function FrmActualizar(idcie){        
        $.ajax({
            type:"POST",
            data:"idcie="+idcie,
            url:"procesos/obtenDatoscie.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_cie').val(datos['id_cie']);
                $('#codigo_cieU').val(datos['codigo_cie']);
                $('#descripcion_cieU').val(datos['descripcion_cie']);
            }
        })
    }

    function cambiarestado(idcie){
        $.ajax({
            type:"POST",
            data:"idcie="+idcie,
            url:"procesos/cambiarestadocie.php",
            success:function(r){
                if(r==1){
                    $("#tablaDatacie").load("tablacie.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

</script>
