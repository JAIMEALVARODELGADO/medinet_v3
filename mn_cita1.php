<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$_SESSION['gcondicion']="estado_agh='PE'";
$_SESSION['gid_persona']="";
//echo $_SESSION['gcondicion'];

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


	<div class="card text">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link active" href="#">Asignar Cita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_cancelacitas1.php">Cancelar Cita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_trasladaragenda1.php">Trasladar Agenda</a>
				</li>				
			</ul>

		</div>       
		
		<div class="container-fluid">
			<br>            
			<div class="card text-left">
				<div class="card-header">
					<h4>Asignar Cita</h4>
				</div>

				<div class="card-body">
					<form id="frm_horario" name="frm_horario" method="POST">

						<div class="row">
								<div class="col-sm-6">
									<div class="card text-left">
										<div class="card-header">
											<h6 class="card-title">Informacion de la Cita</h6>
										</div>
									
										<div class="card-body">

											<div class="form-group row">
												<label for="id_persona" class="col-sm-2 col-form-label">Paciente</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="nombre_pac" name="nombre_pac" size='80' placeholder="digite la identificación o el nombre" required>
													<input type='hidden' id='id_persona' name='id_persona'>
												</div>
											</div>
											<div class="form-group row">
				                                <label for="id_eps" class="col-sm-2 col-form-label">EPS</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="id_eps" name="id_eps">
				                                        <option value=""></option>
				                                        <?php
				                                        $sql="SELECT id_eps,nombre_eps FROM eps ORDER BY nombre_eps";
				                                        $result=mysqli_query($conexion,$sql);
				                                        while($row=mysqli_fetch_row($result)){
				                                            echo "<option value='$row[0]'>$row[1]</option>";
				                                        }
				                                        ?>
				                                    </select>                            
				                                </div>
				                            </div>

				                            <div class="form-group row">
				                                <label for="id_profesional" class="col-sm-2 col-form-label">Profesional</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="id_profesional" name="id_profesional" onchange="actualizar()">
				                                        <option value=""></option>
				                                        <?php
				                                        $sql="SELECT id_persona,nombre FROM vw_usuario WHERE agendar_usu='S' AND estado_usu='A' ORDER BY nombre";
				                                        $result=mysqli_query($conexion,$sql);
				                                        while($row=mysqli_fetch_row($result)){
				                                            echo "<option value='$row[0]'>$row[1]</option>";
				                                        }
				                                        ?>
				                                    </select>   
				                                </div>
				                            </div>

				                            <div class="form-group row">
				                                <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
				                                <div class="col-sm-4">
				                                    <input type="date" class="form-control" id="fecha" name="fecha"  onchange="actualizar()"> 
				                                </div>
				                            </div>

				                            <div class="form-group row">
				                                <label for="observacion_agc" class="col-sm-2 col-form-label">Observacion</label>
				                                <div class="col-sm-10">
				                                    <input type="text" maxlength="80" class="form-control" id="observacion_agc" name="observacion_agc"  required>
				                                </div>
				                            </div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-sm-6">
											<span class="btn btn-primary" title="Guardar" onclick="validar()" id="btn_nuevo">Guardar <span class="fas fa-save"></span></span>
                            				</span>
										</div>
										<div class="col-sm-6">
											<span class="btn btn-secondary btn.sm" data-toggle="modal" data-target="#modalMostrar" title="Mostrar Citas del Paciente" onclick="muestracitas()">Mostrar Citas del Paciente <span class="far fa-calendar-alt"></span>
											</span>
										</div>
									</div>

								</div>

								<div class="col-sm-6">
									<div class="card text-left">
										<div class="card-header">
											<h6>Horarios Disponibles</h6>
										</div>
									
										<div class="card-body">
											<div id="tablaDatahorario"></div>
										</div>
									</div>
								</div>
						</div>

						<input type="hidden" id="id_agh" name="id_agh"> 
						<input type="hidden" id="condicion" name="condicion"> 
					</form>
				</div>
				<div class="card-footer text-muted">
					By Soluciones Thin & Thin
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Editar-->
    <div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Citas del Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm_mostrar">                    	

                    	<div id="tablaCitas"></div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar <span class="fas fa-angle-double-left"></span></button>                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatahorario").load("tablahorario2.php");

        $("#nombre_pac").autocomplete("procesos/autocomp_pac.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#nombre_pac").result(function(event, data, formatted) {
            $("#id_persona").val(data[1]);
        });


    });
    function actualizar(){
    	//alert(document.frm_horario.id_profesional.value);
    	condicion="estado_agh='PE'"
    	if(document.frm_horario.id_profesional.value!=""){
    		condicion=condicion+" AND id_persona='"+document.frm_horario.id_profesional.value+"'";
    	}
    	if(document.frm_horario.fecha.value!=""){
    		condicion=condicion+" AND fecha_agh>='"+document.frm_horario.fecha.value+" 00:00'";
    		condicion=condicion+" AND fecha_agh<='"+document.frm_horario.fecha.value+" 23:59'";
    	}    	
    	$('#condicion').val(condicion);
    	$(document).ready(function(){
    		datos=$('#frm_horario').serialize();
	    	$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizarhorario2.php",
				//success:function(r){
					
				//}
			});
			$("#tablaDatahorario").load("tablahorario2.php");
			$('#id_agh').val("");
    	});
    }

    function seleccionar(idagh){
    	$('#id_agh').val(idagh);
    }


</script>

<script type="text/javascript">
	function validar(){
        err="";
        if(document.frm_horario.id_persona.value==''){err="Paciente\n";}
        if(document.frm_horario.id_eps.value==''){err+="EPS\n";}
        if(document.frm_horario.id_profesional.value==''){err+="Profesional\n";}
        if(document.frm_horario.id_agh.value==''){err+="Debe seleccionar la fecha y hora de la cita\n";}   
        if(err!=''){
            alertify.error('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{            
            guardar()
        }
    }
    
    function guardar(){
        $(document).ready(function(){
	        datos=$('#frm_horario').serialize();
	        $.ajax({
	            type:"POST",
	            data:datos,
	            url:"procesos/agregarcita.php",
	            success:function(r){
	                if(r==1){
	                    alertify.success("Registro guardado");
	                    $('#frm_horario')[0].reset();
	                }
	                else{
	                    alertify.error("Error: Registro no guardado");
	                }
	            }
	        });
        });
    }

    function muestracitas(){
    	if(document.frm_horario.id_persona.value!=""){
    		//$('#id_persona').val(id_persona);
    		$(document).ready(function(){
	    		datos=$('#frm_horario').serialize();
		    	$.ajax({
					type:"POST",
					data:datos,
					url:"procesos/actualizarcitaspac.php",					
					//success:function(r){
						
					//}
				});			
				$("#tablaCitas").load("tablacitaspac.php");			
	    	});    		
	    }
	}
</script>

