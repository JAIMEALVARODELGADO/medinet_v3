<?php
require("valida_sesion.php");
if(isset($_POST['id_medicamentopasar'])){
    $_SESSION['gid_medicamento_pq']=$_POST['id_medicamentopasar'];
}
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$consultamto="SELECT medicamento.id_medicamento,medicamento.nombre_mto
FROM medicamento WHERE medicamento.id_medicamento='$_SESSION[gid_medicamento_pq]'";
//echo $consultamto;
$consultamto=mysqli_query($conexion,$consultamto);
$row=mysqli_fetch_row($consultamto);
$id_medicamento=$row[0];
$nombre_mto=$row[1];
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
    //require("menu.php");
    ?>
    <link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
    <script type="text/javascript" src="../librerias/js/jquery.js"></script>
    <script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Medicamentos/Dispositivos del Paquete </h4>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Nombre : <?php echo $nombre_mto;?></label>
                        
                    </div>                    

                    <div class="card-body">
                        <span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoitem" title="Agrega Nuevo Item al Paquete">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatapaquete"></div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <a href="mn_medicamento1.php" type="button" class="btn btn-secondary">Regresar <i class="fas fa-angle-double-left"></i></a>
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
                        <label>Nombre</label>
                        <input type="text" maxlength="100" class="form-control input-sm" id="detalle" name="detalle">
                        <input type="hidden" id="id_medicamento" name="id_medicamento">
                        <label>Cantidad</label>
                        <input type="text" class="form-control input-sm" id="cantidad_medpq" name="cantidad_medpq">
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
                        <input type="hidden" id="id_medpq" name="id_medpq">
                        <label>Nombre</label>
                        <input type="text" maxlength="100" class="form-control input-sm" id="detalleU" name="detalleU">
                        <input type="hidden" id="id_medicamentoU" name="id_medicamentoU">
                        <label>Cantidad</label>
                        <input type="text" class="form-control input-sm" id="cantidad_medpqU" name="cantidad_medpqU">
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
        $("#tablaDatapaquete").load("tablapaquete.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregardetallepq.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatapaquete").load("tablapaquete.php");
                        
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
                url:"procesos/actualizardetallepq.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatapaquete").load("tablapaquete.php");
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
    function Actualizar(idmed){
        $.ajax({
            type:"POST",
            data:"idmedpq="+idmed,
            url:"procesos/obtenDatos_paquete.php",            
            success:function(r){
                //datos=jQuery.parseJSON(r);
                var datos = JSON.parse(r);                
                $('#id_medpq').val(datos['id_medpq']);
                $('#id_medicamentoU').val(datos['id_medicamento']);
                $('#detalleU').val(datos['nombre_mto']);
                $('#cantidad_medpqU').val(datos['cantidad_medpq']);                
            }
        })
    }

    function cambiarestado(idmed){
        $.ajax({
            type:"POST",
            data:"idmedpq="+idmed,
            url:"procesos/cambiarestado_detallepq.php",
            success:function(r){
                if(r==1){
                    $("#tablaDatapaquete").load("tablapaquete.php");
                    alertify.success("Estado Actualizado!");
                }else{
                    alertify.error("Estado Sin Actualizar!");
                }
            }
        })

    }

    $().ready(function() {
        $("#detalle").autocomplete("procesos/autocomp_medicame.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#detalle").result(function(event, data, formatted) {
            $("#id_medicamento").val(data[1]);
        });

        $("#detalleU").autocomplete("procesos/autocomp_medicame.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#detalleU").result(function(event, data, formatted) {
            $("#id_medicamentoU").val(data[1]);
        });
    }); 

</script>
