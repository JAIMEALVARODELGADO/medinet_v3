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
                        <h4>Conceptos Generales</h4>                        
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevoconcep" title="Agrega Nuevo Concepto">
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
                        <label>Concepto</label>
                        <select class="form-control" id="id_grupo" name="id_grupo">
                            
                        </select>
                        <label>Detalle</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="descripcion_det" name="descripcion_det">
                        <label>Valor</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="valor_det" name="valor_det">
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Concepto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Concepto</label>
                        <input type="hidden" id="codi_det" name="codi_det">
                        <select class="form-control" id="id_grupoU" name="id_grupoU">

                        </select>

                        <label>Detalle</label>                        
                        <input type="text" maxlength="60" class="form-control input-sm" id="descripcion_detU" name="descripcion_detU">
                        <label>Valor</label>
                        <input type="text" maxlength="60" class="form-control input-sm" id="valor_detU" name="valor_detU">
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
        $("#tablaDataconcep").load("tablaconcepto.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarconcepto.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataconcep").load("tablaconcepto.php");                        
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
                url:"procesos/actualizarconcepto.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataconcep").load("tablaconcepto.php");
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
            url:'procesos/lista_grupo.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#id_grupo').html(listas_rep)
        })
        .done(function(listas_rep){
            $('#id_grupoU').html(listas_rep)
        })

    });
</script>


<script type="text/javascript">
    function FrmActualizar(idconcep){        
        $.ajax({
            type:"POST",
            data:"idconcep="+idconcep,
            url:"procesos/obtenDatosconcepto.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#codi_det').val(datos['id_detalle']);
                $('#id_grupoU').val(datos['id_grupo']);
                $('#descripcion_detU').val(datos['descripcion_det']);
                $('#valor_detU').val(datos['valor_det']);
            }
        })
    }

</script>
