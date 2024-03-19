<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
//echo $conhis;
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
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> <!-- Integramos jQuery-->
</head>

<body>
	<?php
	require("encabezado.php");1	//require("menu.php")
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
		<br><h5>Adjuntar Archivos</h5> 
		<div class="container-fluid">       
			<div class="card-body">
				<?php
				
					if($id_aten!=0){
						?>
						<span class="btn btn-secondary" data-toggle="modal" data-target="#modalnuevoadjunto" title="Adjuntar Archivo">
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
			            <h5 class="modal-title" id="exampleModalLabel">Adjuntar un Nuevo Archivo</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>

			        

			        <div class="modal-body">
			            <form id="frm_nuevo" enctype="multipart/form-data">
			                <label></label>
			                <input type="file" id="archivo">
			                
			                <label>Descripción del Archivo</label>
			                <br><input type="text" id='descripcion_adj' name='descripcion_adj' maxlength="80" size="50">
			                <br><input type="hidden" id='id_aten' name='id_aten' value='<?php echo $id_aten;?>'>
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
			        <div class="mensage"></div>
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
                    }
                    else{
                        alertify.error("Error: El registro no guardado");
                    }
                }
            });
        });
    });


    $(function(){
		$('#btnNuevo').on('click', function (e){
			e.preventDefault(); // Evitamos que salte el enlace.
			/* Creamos un nuevo objeto FormData. Este sustituye al 
			atributo enctype = "multipart/form-data" que, tradicionalmente, se 
			incluía en los formularios (y que aún se incluye, cuando son enviados 
			desde HTML. */
			var paqueteDeDatos = new FormData();
			/* Todos los campos deben ser añadidos al objeto FormData. Para ello 
			usamos el método append. Los argumentos son el nombre con el que se mandará el 
			dato al script que lo reciba, y el valor del dato.
			Presta especial atención a la forma en que agregamos el contenido 
			del campo de fichero, con el nombre 'archivo'. */
			paqueteDeDatos.append('archivo', $('#archivo')[0].files[0]);
			paqueteDeDatos.append('id_aten', $('#id_aten').prop('value'));
			paqueteDeDatos.append('descripcion_adj', $('#descripcion_adj').prop('value'));
			//var destino = "recibir.php"; // El script que va a recibir los campos de formulario.
			//var destino = "recibir.php"; // El script que va a recibir los campos de formulario.
			var destino = "procesos/agregaradjunto.php"; // El script que va a recibir los campos de formulario.
			/* Se envia el paquete de datos por ajax. */
			$.ajax({
				url: destino,
				type: 'POST', // Siempre que se envíen ficheros, por POST, no por GET.
				contentType: false,
				data: paqueteDeDatos, // Al atributo data se le asigna el objeto FormData.
				processData: false,
				cache: false, 
				success: function(resultado){ // En caso de que todo salga bien.
					//console.log(resultado);
					alertify.success(resultado);
					$('#frm_nuevo')[0].reset();
					$("#tablaDataadjunto").load("tablaadjunto.php");
				},
				error: function (){ // Si hay algún error.
					alert("Algo ha fallado.");
				}
			});
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

            }
            ,function(){

            });
    }
</script>

<!---Aqui desactivo la combinacion Ctrl-Click -->
<script type="text/javascript">
    $('a').click(function (e){  
    if (e.ctrlKey) {
        return false;
    }
    });
</script>
