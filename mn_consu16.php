<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
$conhis=mysqli_query($conexion,$conhis);
$id_aten=0;
if(mysqli_num_rows($conhis)!=0){
	$rowhis=mysqli_fetch_row($conhis);
	$id_aten=$rowhis[0];
}
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
	<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
	<?php
	require("encabezado.php");
	?>
	<div class="card text">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link" href="mn_consu11.php">Historia de Consulta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu15.php">Procedimientos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu12.php">Formula</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu13.php">Ordenes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Adjuntos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu14.php">Finalizar Conulta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu1.php">Pacientes Agendados</a>
				</li>
			</ul>
		</div>       
		<br><h5>Adjuntar Archivos PDF</h5> 
		<div class="container-fluid">       
			<div class="card-body">
				<?php
				if($id_aten!=0){
					?>
					<span class="btn btn-secondary" data-toggle="modal" data-target="#modalnuevoadjunto" title="Adjuntar Archivo PDF">
						Nuevo <span class="fas fa-plus-circle"></span>
					</span>
					<?php
				}
				?>
                <hr>
                <div id="tablaDataadjunto"></div>				
			</div>
		</div>

		<!-- Modal Nuevo -->
		<div class="modal fade" id="modalnuevoadjunto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Adjuntar un Nuevo Archivo PDF</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			            <form id="frm_nuevo">
			                <label>Seleccionar Archivo PDF</label>
			                <input type="file" id="archivo" class="form-control" accept=".pdf">
			                <br>
			                <label>Descripción del Archivo</label>
			                <input type="text" id="descripcion_adj" name="descripcion_adj" class="form-control" maxlength="80">
			                <input type="hidden" id="id_aten" name="id_aten" value="<?php echo $id_aten;?>">
			                <input type="hidden" id="archivo_base64" name="archivo_base64">
			                <input type="hidden" id="nombre_archivo" name="nombre_archivo">
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
		<div class="modal fade" id="modaleditardescripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Editar la Descripción del Archivo</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			            <form id="frm_editar">
			                <label>Descripción</label>
			                <input type="hidden" id="id_adjunto" name="id_adjunto">
			                <input type="text" maxlength="80" class="form-control input-sm" id="descripcion_adjU" name="descripcion_adjU">
			            </form>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
			            <button type="button" id="btnActualizar" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataadjunto").load("tablaadjunto.php");
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // Actualizar descripción
        $('#btnActualizar').click(function(){
            datos=$('#frm_editar').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizardescripcion.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataadjunto").load("tablaadjunto.php");
                        alertify.success("Registro guardado");
                        $('#modaleditardescripcion').modal('hide');
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });

        // Guardar nuevo archivo PDF en base64
        $('#btnNuevo').on('click', function(e){
            e.preventDefault();
            
            var archivo = $('#archivo')[0].files[0];
            var descripcion = $('#descripcion_adj').val();
            
            if(!archivo){
                alertify.error("Por favor seleccione un archivo PDF");
                return;
            }
            
            if(archivo.type !== 'application/pdf'){
                alertify.error("Solo se permiten archivos PDF");
                return;
            }
            
            if(!descripcion){
                alertify.error("Por favor ingrese una descripción");
                return;
            }
            
            // Leer el archivo y convertirlo a base64
            var reader = new FileReader();
            reader.onload = function(e){
                var base64 = e.target.result.split(',')[1]; // Obtener solo la parte base64
                
                // Enviar los datos al servidor
                $.ajax({
                    url: "procesos/agregaradjunto.php",
                    type: 'POST',
                    data: {
                        id_aten: $('#id_aten').val(),
                        descripcion_adj: descripcion,
                        archivo_base64: base64,
                        nombre_archivo: archivo.name
                    },
                    success: function(resultado){
                        alertify.success(resultado);
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataadjunto").load("tablaadjunto.php");
                        $('#modalnuevoadjunto').modal('hide');
                    },
                    error: function(){
                        alertify.error("Error al subir el archivo");
                    }
                });
            };
            
            reader.onerror = function(){
                alertify.error("Error al leer el archivo");
            };
            
            reader.readAsDataURL(archivo);
        });
    });
</script>

<script type="text/javascript">
    function FrmActualizar(idadj){
        $.ajax({
            type:"POST",
            data:"idadj="+idadj,
            url:"procesos/obtenDatosadjunto.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_adjunto').val(datos['id_adjunto']);
                $('#descripcion_adjU').val(datos['descripcion_adj']);
            }
        })
    }

    function eliminarDatos(idadj,descrip){
        alertify.confirm('Eliminar Archivo Adjunto', 'Desea eliminar el archivo con la descripción: '+descrip,
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idadj="+idadj,
                    url:"procesos/eliminaradjunto.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataadjunto").load("tablaadjunto.php");
                            alertify.success("Registro Eliminado!");
                        }else{
                            alertify.error("Registro NO Eliminado!");
                        }
                    }
                })
            },
            function(){
            }
        );
    }
</script>

<script type="text/javascript">
    $('a').click(function (e){  
        if (e.ctrlKey) {
            return false;
        }
    });
</script>