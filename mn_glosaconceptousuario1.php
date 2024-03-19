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
    require("encabezado.php");
    require("menu.php")
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Conceptos de Glosas pos Usuario</h4>
                        <h6>Asignación de conceptos de glosas que realiza cada usuario</h6>
                    </div>
                    
                    <div class="card-body">
                        <span class="btn btn-secondary openBtn" data-toggle="modal" data-target="#modalnuevo" title="Agrega Nuevo Concepto de Glosa a un Usuario">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
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
    <!-- Modal Nuevo -->
    <div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar un Concepto de Glosa a un Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_nuevo">
                        <label>Usuario</label>
                            <select class="form-control" id="id_persona" name="id_persona">
                                <option value=''></option>
                                <?php                                   
                                    $sql="SELECT id_persona, nombre FROM vw_usuario WHERE estado_usu='A' ORDER BY nombre";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                ?>
                            </select>                                                
                        <label>Concepto de Glosa</label>                        
                            <select class="form-control" id="id_conglo" name="id_conglo">
                                <option value=''></option>
                                <?php                                   
                                    $sql="SELECT id_conglo, CONCAT(codigo_conglo,' ',descripcion_conglo) AS descripcion FROM concepto_glosa WHERE estado_conglo='A' ORDER BY descripcion";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                ?>                               
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
    <div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Concepto de Glosa del Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_editar">
                        <label>Usuario</label>
                            <input type="hidden" id="id_conper" name="id_conper">
                            <select class="form-control" id="id_personaU" name="id_personaU" disabled="true">
                                <option value=''></option>
                                <?php                                   
                                    $sql="SELECT id_persona, nombre FROM vw_usuario WHERE estado_usu='A' ORDER BY nombre";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                ?>
                            </select>
                        <label>Concepto de Glosa</label>                        
                            <select class="form-control" id="id_congloU" name="id_congloU">
                                <?php                                   
                                    $sql="SELECT id_conglo, CONCAT(codigo_conglo,' ',descripcion_conglo) AS descripcion FROM concepto_glosa WHERE estado_conglo='A' ORDER BY descripcion";
                                    $result=mysqli_query($conexion,$sql);
                                    while($row=mysqli_fetch_row($result)){
                                        echo "<option value='$row[0]'>$row[1]</option>";
                                    }
                                ?>                                
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
        $("#tablaData").load("tablaglosausuario.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarglosausuario.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaData").load("tablaglosausuario.php");                        
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
                url:"procesos/actualizarglosausu.php",
                success:function(r){
                    if(r==1){
                        $("#tablaData").load("tablaglosausuario.php");
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
    function FrmActualizar(idconper){
        $.ajax({
            type:"POST",
            data:"idconper="+idconper,
            url:"procesos/obtenDatosglosausu.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_conper').val(datos['id_conper']);
                $('#id_personaU').val(datos['id_persona']);
                $('#id_congloU').val(datos['id_conglo']);                
            }
        })
    }

    function eliminarDatos(idconper,descripcion){
        alertify.confirm('Eliminar Concepto de Glosa', 'Desea Eliminar esta Concepto? '+descripcion, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idconper="+idconper,
                    url:"procesos/eliminarglosausu.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaData").load("tablaglosausuario.php");
                            alertify.success("Registro Eliminado!");
                        }else{
                            alertify.error("Registro NO Eliminado!");
                        }
                    }
                })

            }
            ,function(){

            });
    }

</script>

