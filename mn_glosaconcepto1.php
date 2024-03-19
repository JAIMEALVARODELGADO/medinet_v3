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
                        <h4>Conceptos de Glosas</h4>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevoconcep" title="Agrega Nuevo Concepto de Glosa">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataconcep"></div>
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
    <div class="modal fade" id="modalnuevoconcep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un Concepto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Concepto General</label>
                        <select class="form-control" id="id_glosacod" name="id_glosacod">
                        </select>
                        <label>Código</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="codigo_conglo" name="codigo_conglo">
                        <label>Concepto Específico</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="descripcion_conglo" name="descripcion_conglo">
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
    <div class="modal fade" id="modaleditarconcep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Concepto Específico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Concepto General</label>
                        <input type="hidden" id="id_conglo" name="id_conglo">
                        <select class="form-control" id="id_glosacodU" name="id_glosacodU">
                        </select>
                        <label>Código</label>
                        <input type="text" maxlength="3" class="form-control input-sm" id="codigo_congloU" name="codigo_congloU">
                        <label>Concepto Específico</label>
                        <input type="text" maxlength="120" class="form-control input-sm" id="descripcion_congloU" name="descripcion_congloU">                        
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
        $("#tablaDataconcep").load("tabla_glosaconcepto.php");
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarconcepto_glosa.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataconcep").load("tabla_glosaconcepto.php");                        
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
                url:"procesos/actualizarconcepto_glosa.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataconcep").load("tabla_glosaconcepto.php");
                        alertify.success("Registro guardado");
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        $.ajax({
            type:"POST",
            url:'procesos/lista_glosacod.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#id_glosacod').html(listas_rep)
        })
        .done(function(listas_rep){
            $('#id_glosacodU').html(listas_rep)
        })

    });
</script>


<script type="text/javascript">
    function FrmActualizar(idconcep){        
        $.ajax({
            type:"POST",
            data:"id_conglo="+idconcep,
            url:"procesos/obtenDatosconcepto_glosa.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_conglo').val(datos['id_conglo']);
                $('#id_glosacodU').val(datos['id_glosacod']);
                $('#codigo_congloU').val(datos['codigo_conglo']);
                $('#descripcion_congloU').val(datos['descripcion_conglo']);
            }
        })
    }

</script>
