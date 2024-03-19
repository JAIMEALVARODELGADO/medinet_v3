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
    <link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
</head>

<body>
    <?php
    //require("encabezado.php");
    require("menu.php")
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>CUPS Por Profesional</h4>
                        <h6>Asignación de los CUPS de la consulta que realiza cada profesional (Para efectos de RIPS)</h6>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevocupsprof" title="Agrega Nuevo CUPS a un Profesional">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatacupsprof"></div>
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
    <div class="modal fade" id="modalnuevocupsprof" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un CUPS a un Profesional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Profesional</label>
                            <select class="form-control" id="id_persona" name="id_persona">
                                <option value=''></option>
                                <?php                                   
                                    $sql="SELECT id_persona, nombre FROM vw_usuario WHERE agendar_usu='S' AND estado_usu='A' ORDER BY nombre";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                ?>
                            </select>                                                
                        <label>CUPS</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="cups" name="cups">
                        <input type="hidden" id="id_cups" name="id_cups">
                        <label>Clase</label>
                            <select class="form-control" id="clase_cprof" name="clase_cprof">
                                <option value=''></option>
                                <option value='C'>Consulta</option>
                                <option value='P'>Procedimiento</option>                                
                            </select>
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
    <div class="modal fade" id="modaleditarcupsprof" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label>Profesional</label>
                            <input type="hidden" id="idcups_prof" name="idcups_prof">
                            <select class="form-control" id="id_personaU" name="id_personaU" disabled="true">
                                <option value=''></option>
                                <?php                                   
                                    $sql="SELECT id_persona, nombre FROM vw_usuario WHERE agendar_usu='S' AND estado_usu='A' ORDER BY nombre";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                ?>
                            </select>
                        <label>CUPS</label>
                        <input type="text" maxlength="80" class="form-control input-sm" id="cupsU" name="cupsU">
                        <input type="hidden" id="id_cupsU" name="id_cupsU">
                        <label>Clase</label>
                            <select class="form-control" id="clase_cprofU" name="clase_cprofU">
                                <option value=''></option>
                                <option value='C'>Consulta</option>
                                <option value='P'>Procedimiento</option>                                
                            </select>
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
        $("#tablaDatacupsprof").load("tablacupsprof.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarcupsprof.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatacupsprof").load("tablacupsprof.php");                        
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
                url:"procesos/actualizarcupsprof.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatacupsprof").load("tablacupsprof.php");
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
    function FrmActualizar(idcupsprof){        
        $.ajax({
            type:"POST",
            data:"idcupsprof="+idcupsprof,
            url:"procesos/obtenDatoscupsprof.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#idcups_prof').val(datos['idcups_prof']);
                $('#id_personaU').val(datos['id_persona']);
                $('#id_cupsU').val(datos['id_cups']);
                $('#cupsU').val(datos['descripcion_cups']);
                $('#clase_cprofU').val(datos['clase_cprof']);
            }
        })
    }

    function cambiarestado(idcupsprof){
        $.ajax({
            type:"POST",
            data:"idcupsprof="+idcupsprof,
            url:"procesos/cambiarestadocupsprof.php",
            success:function(r){
                if(r==1){
                    $("#tablaDatacupsprof").load("tablacupsprof.php");
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
        $("#cups").autocomplete("procesos/autocomp_cups.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#cups").result(function(event, data, formatted) {
            $("#id_cups").val(data[1]);
        });

        $("#cupsU").autocomplete("procesos/autocomp_cups.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#cupsU").result(function(event, data, formatted) {
            $("#id_cupsU").val(data[1]);
        });
    }); 
</script>