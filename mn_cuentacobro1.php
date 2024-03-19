<?php
require("valida_sesion.php");
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
                        <h4>Cuenta de Cobro</h4>
                    </div>
                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevo" title="Crear Nueva Cuenta de Cobro">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDataccobro"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nuevo -->
    <div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Cuenta de Cobro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Número</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="numero_ccob" name="numero_ccob" placeholder="Número de la cuenta de cobro">
                        <label>EPS</label>
                        <select class="form-control" id="id_eps" name="id_eps">
                            
                        </select>
                        <label>Fecha de la Cuenta</label>
                        <input type="date" class="form-control input-sm" id="fecha_ccob" name="fecha_ccob">
                        </select>
                        <label>Fecha inicial del periodo</label>
                        <input type="date" class="form-control input-sm" id="fechaini_ccob" name="fechaini_ccob">
                        </select>
                        <label>Fecha final del periodo</label>
                        <input type="date" class="form-control input-sm" id="fechafin_ccob" name="fechafin_ccob">
                        <label>Concepto</label>
                        <textarea class="form-control" name="concepto_ccob" id="concepto_ccob" rows="6" maxlength="500"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cuenta de Cobro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <input type="hidden" id="id_ccobro" name="id_ccobro">
                        <label>Número</label>
                        <input type="text" maxlength="8" class="form-control input-sm" id="numero_ccobU" name="numero_ccobU">
                        <label>EPS</label>
                        <select class="form-control" id="id_epsU" name="id_epsU" disabled="true">
                            
                        </select>
                        <label>Fecha de la Cuenta</label>
                        <input type="date" class="form-control input-sm" id="fecha_ccobU" name="fecha_ccobU">
                        </select>
                        <label>Fecha inicial del periodo</label>
                        <input type="date" class="form-control input-sm" id="fechaini_ccobU" name="fechaini_ccobU">
                        </select>
                        <label>Fecha final del periodo</label>
                        <input type="date" class="form-control input-sm" id="fechafin_ccobU" name="fechafin_ccobU">
                        <label>Concepto</label>
                        <textarea class="form-control" name="concepto_ccobU" id="concepto_ccobU" rows="6" maxlength="500"></textarea>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
                    <button type="button" class="btn btn-primary" id="btnActualizar">Guardar <span class="fas fa-save"></span></button>
                </div>
            </div>
        </div>
    </div>
    <form id="frm_ccobro" name="frm_ccobro" action="mn_cuentacobro11.php" method="POST">
        <input type="hidden" id="id_ccobroD" name="id_ccobroD">
    </form>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataccobro").load("tablaccobro.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarcuentacobro.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataccobro").load("tablaccobro.php");
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
                url:"procesos/actualizarccobro.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataccobro").load("tablaccobro.php");
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
            url:'procesos/lista_eps.php',
            data:{'peticion':'cargar_listas'}
        })
        .done(function(listas_rep){
            $('#id_eps').html(listas_rep)
        })
        .done(function(listas_rep){
            $('#id_epsU').html(listas_rep)
        })

    });
</script>

<script type="text/javascript">
    function agregaFrmActualizar(idccob){
        $.ajax({
            type:"POST",
            data:"idccob="+idccob,
            url:"procesos/obtenDatosccob.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#id_ccobro').val(datos['id_ccobro']);
                $('#numero_ccobU').val(datos['numero_ccob']);
                $('#id_epsU').val(datos['id_eps']);
                $('#fecha_ccobU').val(datos['fecha_ccob']);
                $('#fechaini_ccobU').val(datos['fechaini_ccob']);
                $('#fechafin_ccobU').val(datos['fechafin_ccob']);                
                $('#concepto_ccobU').text(datos['concepto_ccob']);
            }
        })
    }

    function relacionar(idccob){        
        $('#id_ccobroD').val(idccob);
        document.frm_ccobro.action="mn_cuentacobro11.php";
        document.frm_ccobro.target="";
        document.frm_ccobro.submit();
    }

    function cerrar(idccob,numero){
        alertify.confirm('Cerrar Ceunta de Cobro', 'Desea cerrar la cuenta de cobro '+numero+' ?', 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idccob="+idccob,
                    url:"procesos/cerrarcuenta.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataccobro").load("tablaccobro.php");
                            alertify.success("Cuenta Cerrada!");
                        }else{
                            alertify.error("Cuenta NO Cerrada!");
                        }
                    }
                })

            }
            ,function(){

            });
    }

    function imprimir(id_ccob){
        $('#id_ccobroD').val(id_ccob);
        document.frm_ccobro.action="mn_impr_ccobro.php";
        document.frm_ccobro.target="new";
        document.frm_ccobro.submit();
    }

    function rips(idccob){        
        $('#id_ccobroD').val(idccob);
        document.frm_ccobro.action="mn_rips2.php";
        document.frm_ccobro.target="";
        document.frm_ccobro.submit();
    }
    
</script>