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
					<a class="nav-link active" href="#">Procedimientos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_consu12.php">Formula</a>
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
		<nav class="navbar navbar-expand-sm bg-light">			
			<ul class="navbar-nav">
				<span class="btn btn-secondary" data-toggle="modal" data-target="#modal_historial" title="Histórico de Procedimientos">Procedimientos
					<i class="fas fa-procedures"></i>
				</span>
				<!--<span class="btn btn-secondary" data-toggle="modal" data-target="#modal_antecedentes" title="Histórico de Antecedentes">Antecedentes
					<i class="fas fa-weight"></i>			
				</span>
				<span class="btn btn-secondary" data-toggle="modal" data-target="#modal_dx" title="Histórico de Diagnósticos">Diagnósticos
					<i class="fas fa-user-md"></i>
				</span>
				<span class="btn btn-secondary" data-toggle="modal" data-target="#modal_plan" title="Histórico de Plan de Manejo y Observaciones">Plan
					<i class="fas fa-syringe"></i>
				</span>-->
			</ul> 
		</nav>

		<br><h5>Procedimientos</h5> 
		<div class="container-fluid">       
			<div class="card-body">
				<span class="btn btn-secondary" data-toggle="modal" data-target="#modalnuevoprocedimiento" title="Agrega Procedimientos">
					Nuevo <span class="fas fa-plus-circle"></span>
				</span>
                <hr>
                <div id="tablaDataprocedimiento"></div>				
			</div>
		</div>
		<!-- Modal Nuevo -->
		<div class="modal fade" id="modalnuevoprocedimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Agregar un Procedimiento</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			            <form id="frm_nuevo">
			                <label>Procedimiento</label>
			                <select class="form-control" id="id_cups" name="id_cups">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT id_cups,descripcion_cups FROM vw_cups_profesional WHERE estado_cprof='A' AND clase_cprof='P' AND id_persona='$_SESSION[gusuario_log]' ORDER BY descripcion_cups";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>

                        	<label>Ambito</label>
			                <select class="form-control" id="ambito_proc" name="ambito_proc">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_ambito ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>

                        	<label>Finalidad</label>
			                <select class="form-control" id="finalidad_proc" name="finalidad_proc">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_finalidad_proc ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>

							<label>Dx Principal</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="dxprinc" name="dxprinc">
			                <input type="hidden" id="dxprinc_proc" name="dxprinc_proc">

			                <label>Dx Relacionado</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="dxrelac" name="dxrelac">
			                <input type="hidden" id="dxrelac_proc" name="dxrelac_proc">

			                <label>Complicación</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="complic" name="complic">
			                <input type="hidden" id="complic_proc" name="complic_proc">

			                <label>Forma de Realización</label>
			                <select class="form-control" id="forma_proc" name="forma_proc">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_forma_qx ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>			                
			                
			                <label>Observación</label>
			                <textarea rows="6" cols="80" class="form-control" id="observacion_proc" name="observacion_proc" placeholder="Observacion"></textarea>
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
		<div class="modal fade" id="modaleditarprocedimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Editar Procedimiento</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			            <form id="frm_editar">
			            	<label>Procedimiento</label>
			            	<input type="hidden" id="id_procedimiento" name="id_procedimiento">
			                <select class="form-control" id="id_cupsU" name="id_cupsU">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT id_cups,descripcion_cups FROM vw_cups_profesional WHERE estado_cprof='A' AND clase_cprof='P' AND id_persona='$_SESSION[gusuario_log]' ORDER BY descripcion_cups";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>

                        	<label>Ambito</label>
			                <select class="form-control" id="ambito_procU" name="ambito_procU">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_ambito ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>

                        	<label>Finalidad</label>
			                <select class="form-control" id="finalidad_procU" name="finalidad_procU">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_finalidad_proc ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>

							<label>Dx Principal</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="dxprincU" name="dxprincU">
			                <input type="hidden" id="dxprinc_procU" name="dxprinc_procU">

			                <label>Dx Relacionado</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="dxrelacU" name="dxrelacU">
			                <input type="hidden" id="dxrelac_procU" name="dxrelac_procU">

			                <label>Complicación</label>
			                <input type="text" maxlength="80" class="form-control input-sm" id="complicU" name="complicU">
			                <input type="hidden" id="complic_procU" name="complic_procU">

			                <label>Forma de Realización</label>
			                <select class="form-control" id="forma_procU" name="forma_procU">
                            	<option value=''></option>                            	
                            	<?php                            		
									$sql="SELECT codi_det, descripcion_det FROM vw_forma_qx ORDER BY descripcion_det";
									$result=mysqli_query($conexion,$sql);
									while($row=mysqli_fetch_row($result)){
										echo "<option value='$row[0]'>$row[1]</option>";
									}
                            	?>
                        	</select>			                
			                
			                <label>Observación</label>
			                <textarea rows="6" class="form-control" id="observacion_procU" name="observacion_procU" placeholder="Observacion"></textarea>
			            </form>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>
			            <button type="button" id="btnActualizar" class="btn btn-primary">Guardar <span class="fas fa-save"></span></button>
			        </div>
			    </div>
			</div>
		</div>

		<!-- Modal Historial de procedimientos -->
		<div class="modal fade" id="modal_historial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Histórico de Procedimientos</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <div class="modal-body">
			        	<div id="tablaDatahispro"></div>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>			            
			        </div>
			    </div>
			</div>
		</div>

	</div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDataprocedimiento").load("tablaprocedimiento.php");
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#btnNuevo").click(function(){
            datos=$('#frm_nuevo').serialize();

            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/agregarprocedimiento.php",
                success:function(r){
                    if(r==1){
                        alertify.success("Registro guardado");
                        $('#frm_nuevo')[0].reset();
                        $("#tablaDataprocedimiento").load("tablaprocedimiento.php");
                        
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
                url:"procesos/actualizarprocedimiento.php",
                success:function(r){
                    if(r==1){
                        $("#tablaDataprocedimiento").load("tablaprocedimiento.php");
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
	

	function FrmActualizar(idproc){
        $.ajax({
            type:"POST",
            data:"idproc="+idproc,
            url:"procesos/obtenDatosprocedimiento.php",
            success:function(r){
	 			var datos = JSON.parse(r);
	            $('#id_procedimiento').val(datos['id_procedimiento']);
	            $('#id_cupsU').val(datos['id_cups']);
	            $('#ambito_procU').val(datos['ambito_proc']);
	            $('#finalidad_procU').val(datos['finalidad_proc']);
	            $('#dxprincU').val(datos['dxprinc']);
	            $('#dxprinc_procU').val(datos['dxprinc_proc']);
	            $('#dxrelacU').val(datos['dxrelac']);
	            $('#dxrelac_procU').val(datos['dxrelac_proc']);
				$('#complicU').val(datos['complic']);
				$('#complic_procU').val(datos['complic_proc']);
				$('#forma_procU').val(datos['forma_proc']);
				$('#observacion_procU').val(datos['observacion_proc']);
            }
        })
    }

    function eliminarDatos(idproc,nombremed){
        alertify.confirm('Eliminar Procedimiento', 'Desea eliminar el procedimiento: '+nombremed,
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"idproc="+idproc,
                    url:"procesos/eliminarprocedimiento.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDataprocedimiento").load("tablaprocedimiento.php");
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
		$("#dxprinc").autocomplete("procesos/autocomp_cie.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#dxprinc").result(function(event, data, formatted) {
			$("#dxprinc_proc").val(data[1]);
		});

		$("#dxrelac").autocomplete("procesos/autocomp_cie.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#dxrelac").result(function(event, data, formatted) {
			$("#dxrelac_proc").val(data[1]);
		});

		$("#complic").autocomplete("procesos/autocomp_cie.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#complic").result(function(event, data, formatted) {
			$("#complic_proc").val(data[1]);
		});

		$("#dxprincU").autocomplete("procesos/autocomp_cie.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#dxprincU").result(function(event, data, formatted) {
			$("#dxprinc_procU").val(data[1]);
		});

		$("#dxrelacU").autocomplete("procesos/autocomp_cie.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#dxrelacU").result(function(event, data, formatted) {
			$("#dxrelac_procU").val(data[1]);
		});

		$("#complicU").autocomplete("procesos/autocomp_cie.php", {
			width: 460,
			matchContains: false,
			mustMatch: false,
			selectFirst: false
		});
		$("#complicU").result(function(event, data, formatted) {
			$("#complic_procU").val(data[1]);
		});

	});

	 $(document).ready(function(){
        $("#tablaDatahispro").load("tablahistoprocedimientos.php");
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