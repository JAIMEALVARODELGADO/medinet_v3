<?php
//require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
    <?php
    //require("encabezado.php");
    //require("menu.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Subir Archivo de Facturas</h4>
                    </div>
                    <div class="card-body">
                        <!--<span class="btn btn-secondary" data-toggle="modal" data-target="#nuevoeps" title="Agrega Nueva Eps">
                            Nuevo <span class="fas fa-plus-circle"></span>
                        </span>
                        <hr>
                        <div id="tablaDatatable"></div>-->
                        <form id="frm_leearchivo" method="POST" action="" enctype="multipart/form-data">
                            <label for="archivo">Seleccione el Archivo</label>
                            <div class="input-group">
                                <input type="file" id="archivo" name="archivo" class="btn btn-secondary">
                                <button type="submit" class="btn btn-success" aria-label="Left Align" name="boton" id="boton">Subir Archivo
                                <i class="fas fa-file-upload"></i>
                                </button>
                                <!--<input type="submit" name="boton" id="boton" value="Subir Archivo">-->
                            </div>
                            <?php
                                if(isset($_POST['boton'])){
                                    subir_archivo();
                                }
                            ?>
                            <input type="text" id="nombre_archivo" name="nombre_archivo">
                            <!--<label>Seleccione el Archivo:</label>
                            <input type="file" id="archivo" name="archivo">
                            <input type="submit" name="boton" id="boton" value="Subir Archivo">-->
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>


<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatatable").load("tablaeps.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregareps.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDatatable").load("tablaeps.php");
                        
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
                url:"procesos/actualizareps.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDatatable").load("tablaeps.php");
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
    function agregaFrmActualizar(ideps){
        $.ajax({
            type:"POST",
            data:"ideps="+ideps,
            url:"procesos/obtenDatoseps.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#ideps').val(datos['id_eps']);
                $('#codigo_epsU').val(datos['codigo_eps']);
                $('#nit_epsU').val(datos['nit_eps']);
                $('#nombre_epsU').val(datos['nombre_eps']);
                $('#direccion_epsU').val(datos['direccion_eps']);
                $('#telefono_epsU').val(datos['telefono_eps']);
                $('#contacto_epsU').val(datos['contacto_eps']);
            }
        })
    }

    function eliminarDatos(ideps,nombeps){
        alertify.confirm('Eliminar EPS', 'Desea Eliminar esta EPS? '+nombeps, 
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"ideps="+ideps,
                    url:"procesos/eliminareps.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatatable").load("tablaeps.php");
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

<?php
    function subir_archivo(){
        $formatos=array('.csv','.txt');    
        if(isset($_POST['boton'])){
            $mensaje="";
            $nombrearchivo=$_FILES['archivo']['name'];
            $nombretmparchivo=$_FILES['archivo']['tmp_name'];
            $ext=substr($nombrearchivo,strrpos($nombrearchivo,'.'));
            if(in_array($ext,$formatos)){
                if(move_uploaded_file($nombretmparchivo, 'archivos_tmp/'.$nombrearchivo)){
                    $mensaje="Archivo subido con EXITO!";                    
                    ?>
                        <script type="text/javascript">
                            archivo_='<?php echo $nombrearchivo;?>';
                            alert(archivo_);
                            $('#nombre_archivo').val('archivo_');
                            /*$.ajax({
                                type:"POST",
                                data:"ideps="+ideps,
                                url:"procesos/obtenDatoseps.php",
                                success:function(r){
                                    datos=jQuery.parseJSON(r);
                                    $('#ideps').val(datos['id_eps']);
                                    $('#codigo_epsU').val(datos['codigo_eps']);
                                    $('#nit_epsU').val(datos['nit_eps']);
                                    $('#nombre_epsU').val(datos['nombre_eps']);
                                    $('#direccion_epsU').val(datos['direccion_eps']);
                                    $('#telefono_epsU').val(datos['telefono_eps']);
                                    $('#contacto_epsU').val(datos['contacto_eps']);
                                }*/
                        </script>
                    <?php
                    //cargarinformacion();                    
                }
                else{
                    $mensaje="El archivo no fué subido";
                }
            }
            else{
                $mensaje="Archivo NO válido";
            }            
        }
        ?>
        <br>
        <div class="alert alert-warning" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <i class="fas fa-exclamation-triangle"></i>            
            <?php echo $mensaje;?>
        </div>
        <?php
    }

    function cargarinformacion(){

    }
?>

<script type="text/javascript">
    function procesar(){
        alert();
        /*$.ajax({
            type:"POST",
            data:"ideps="+ideps,
            url:"procesos/obtenDatoseps.php",
            success:function(r){
                datos=jQuery.parseJSON(r);
                $('#ideps').val(datos['id_eps']);
                $('#codigo_epsU').val(datos['codigo_eps']);
                $('#nit_epsU').val(datos['nit_eps']);
                $('#nombre_epsU').val(datos['nombre_eps']);
                $('#direccion_epsU').val(datos['direccion_eps']);
                $('#telefono_epsU').val(datos['telefono_eps']);
                $('#contacto_epsU').val(datos['contacto_eps']);
            }
        })*/
    }
</script>