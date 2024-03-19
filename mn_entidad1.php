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
                        <h4>ENTIDAD</h4>
                        <h6>Información de la Entidad</h6>
                    </div>
                    
                    <div class="card-body">
                        <!--<span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevoentidad" title="Agrega Nueva Enfermedad">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>-->
                        <hr>
                        <div id="tablaDataentidad"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Editar -->
    <div class="modal fade" id="modaleditarentidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Entidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Nombre</label>
                        <input type="hidden" id="id_ent" name="id_ent">               
                        <input type="text" maxlength="80" class="form-control input-sm" id="nombre_entU" name="nombre_entU">
                        <label>Dirección</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="direccion_entU" name="direccion_entU">
                        <label>Teléfonos</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="telefono_entU" name="telefono_entU">
                        <label>Texto para Encabezado de Factura</label>
                        <input type="text" maxlength="250" class="form-control input-sm" id="textofactura_entU" name="textofactura_entU">
                        <label>Tipo de Identificación</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="tipoiden_entU" name="tipoiden_entU">
                        <label>Número de Identificación</label>
                        <input type="text" maxlength="12" class="form-control input-sm" id="numeroiden_entU" name="numeroiden_entU">
                        <label>Código de Hábilitación</label>
                        <input type="text" maxlength="12" class="form-control input-sm" id="codigopres_entU" name="codigopres_entU">
                        <label>Prefijo de la Factura</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="prefijofac_entU" name="prefijofac_entU">
                        <label>Título de Tratamiento de la Persona Encargada</label>
                        <input type="text" maxlength="20" class="form-control input-sm" id="tituloenc_entU" name="tituloenc_entU">
                        <label>Nombre de la Persona Encargada</label>
                        <input type="text" maxlength="45" class="form-control input-sm" id="nombreenc_entU" name="nombreenc_entU">
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
        $("#tablaDataentidad").load("tablaentidad.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarentidad.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataentidad").load("tablaentidad.php");
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
    function FrmActualizar(ident){
        $.ajax({
            type:"POST",
            data:"ident="+ident,
            url:"procesos/obtenDatosentidad.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_ent').val(datos['id_ent']);
                $('#nombre_entU').val(datos['nombre_ent']);
                $('#direccion_entU').val(datos['direccion_ent']);
                $('#telefono_entU').val(datos['telefono_ent']);
                $('#textofactura_entU').val(datos['textofactura_ent']);
                $('#tipoiden_entU').val(datos['tipoiden_ent']);
                $('#numeroiden_entU').val(datos['numeroiden_ent']);
                $('#codigopres_entU').val(datos['codigopres_ent']);
                $('#prefijofac_entU').val(datos['prefijofac_ent']);
                $('#tituloenc_entU').val(datos['tituloenc_ent']);
                $('#nombreenc_entU').val(datos['nombreenc_ent']);                
            }
        })
    }
</script>
