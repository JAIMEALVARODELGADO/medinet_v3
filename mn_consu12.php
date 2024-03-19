<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$conhis="SELECT id_aten FROM atencion WHERE id_agc='$_SESSION[gid_agc]'";
//echo $conhis;
$conhis=mysqli_query($conexion,$conhis);
if(mysqli_num_rows($conhis)!=0){
	$rowhis=mysqli_fetch_row($conhis);
	$id_aten=$rowhis[0];
}
else{
	$id_aten=0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Medinet V3</title>
	<?php 
		require_once "scripts.php";
		echo "Si";
	?>
	<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
	<script type="text/javascript" src="../librerias/js/jquery.js"></script>
	<script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>
</head>

<body>
	<?php
	require("encabezado.php");
	//require("menu.php")
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
					<a class="nav-link active" href="#">Formula</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu13.php">Ordenes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu16.php">Adjuntos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu14.php">Finalizar Conulta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu1.php">Pacientes Agendados</a>
				</li>
			</ul>

		</div>       
		<br><h5>Formula</h5> 
		<div class="container-fluid">       
			<div class="card-body">
				<?php
					if($id_aten!=0){
						?>
						<span class="btn btn-secondary" data-toggle="modal" data-target="#modalnuevomedicamento" title="Agrega Medicamento a la Formula">
							Nuevo <span class="fas fa-plus-circle"></span>
						</span>
						<?php
					}
				?>
                
                <hr>
                <div id="tablaDataformula"></div>				
			</div>
		</div>
		<!-- Modal Nuevo -->
		<div class="modal fade" id="modalnuevomedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Agregar un Medicamento a la Formula</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			            <form id="frm_nuevo">
			                <label>Medicamento</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="medicamento" name="medicamento">
			                <input type="hidden" id="id_medicamento" name="id_medicamento">
			                <label>Dosis</label>
			                <input type="text" maxlength="10" class="form-control input-sm" id="dosis_det" name="dosis_det">
			                <label>Frecuencia</label>
			                <input type="text" maxlength="60" class="form-control input-sm" id="frecuencia_det" name="frecuencia_det">
			                <label>Vía de Administración</label>
			                <select class="form-control" id="via_det" name="via_det">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_via ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>			                
			                <label>Tiempo de Tratamiento</label>
			                <input type="text" maxlength="10" class="form-control input-sm" id="tiempo_trat_det" name="tiempo_trat_det">
			                <label>Cantidad</label>
			                <input type="text" maxlength="3" class="form-control input-sm" id="cantidad_det" name="cantidad_det">
			                <label>Observación</label>
			                <input type="text" maxlength="100" class="form-control input-sm" id="observacion_det" name="observacion_det">
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
		<div class="modal fade" id="modaleditarmedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Editar Medicamento de la Formula</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			            <form id="frm_editar">
			                <label>Medicamento</label>
			                <input type="hidden" id="id_det" name="id_det">
			                <input type="text" maxlength="80" class="form-control input-sm" id="medicamentoU" name="medicamentoU">
			                <input type="hidden" id="id_medicamentoU" name="id_medicamentoU">
			                <label>Dosis</label>
			                <input type="text" maxlength="10" class="form-control input-sm" id="dosis_detU" name="dosis_detU">
			                <label>Frecuencia</label>
			                <input type="text" maxlength="60" class="form-control input-sm" id="frecuencia_detU" name="frecuencia_detU">
			                <label>Vía de Administración</label>
			                <select class="form-control" id="via_detU" name="via_detU">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_via ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>			                
			                <label>Tiempo de Tratamiento</label>
			                <input type="text" maxlength="10" class="form-control input-sm" id="tiempo_trat_detU" name="tiempo_trat_detU">
			                <label>Cantidad</label>
			                <input type="text" maxlength="3" class="form-control input-sm" id="cantidad_detU" name="cantidad_detU">
			                <label>Observación</label>
			                <input type="text" maxlength="100" class="form-control input-sm" id="observacion_detU" name="observacion_detU">
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
        $("#tablaDataformula").load("tablaformula.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarmedicamformula.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataformula").load("tablaformula.php");
                        
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
                url:"procesos/actualizarmedicamformula.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataformula").load("tablaformula.php");
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
	

	function FrmActualizar(iddet){
        $.ajax({
            type:"POST",
            data:"iddet="+iddet,
            url:"procesos/obtenDatosdetalle.php",
            success:function(r){
	 			var datos = JSON.parse(r);
	            $('#id_det').val(datos['id_det']);
	            $('#id_medicamentoU').val(datos['id_medicamento']);
	            $('#medicamentoU').val(datos['nombre_mto']);
	            $('#dosis_detU').val(datos['dosis_det']);
	            $('#frecuencia_detU').val(datos['frecuencia_det']);
	            $('#via_detU').val(datos['via_det']);
	            $('#tiempo_trat_detU').val(datos['tiempo_trat_det']);
	            $('#cantidad_detU').val(datos['cantidad_det']);
	            $('#observacion_detU').val(datos['observacion_det']);
            }
        })
    }

    function eliminarDatos(iddet,nombremed){
        alertify.confirm('Eliminar Medicamento de la Formula', 'Desea eliminar de la formula, el medicamento: '+nombremed,
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"iddet="+iddet,
                    url:"procesos/eliminarmedicamformula.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataformula").load("tablaformula.php");
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

<script type="text/javascript">
	$().ready(function() {
		$("#medicamento").autocomplete("procesos/autocomp_medicame.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#medicamento").result(function(event, data, formatted) {
			$("#id_medicamento").val(data[1]);
		});

		$("#medicamentoU").autocomplete("procesos/autocomp_medicame.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#medicamentoU").result(function(event, data, formatted) {
			$("#id_medicamentoU").val(data[1]);
		});
	});	
</script>

<!---Aqui desactivo la combinacion Ctrl-Click -->
<script type="text/javascript">
    $('a').click(function (e){  
    if (e.ctrlKey) {
        return false;
    }
    });
</script>