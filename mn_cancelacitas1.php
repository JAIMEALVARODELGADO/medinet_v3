<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();

$_SESSION['gcondicion']="estado_agc='Solicitada'";

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
					<a class="nav-link" href="mn_cita1.php">Asignar Cita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Cancelar Cita</a>
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
					<h4>Consulta y Cancelacion de Citas</h4>
				</div>

				<div class="card-body">
					<form id="frm_citas" name="frm_citas" method="POST">

						<div class="row">
								<div class="col-sm-5">
									<div class="card text-left">
										<div class="card-header">
											<h6 class="card-title">Informacion de la Cita</h6>
										</div>
									
										<div class="card-body">

											<div class="form-group row">
												<label for="id_persona" class="col-sm-2 col-form-label">Paciente</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="nombre_pac" name="nombre_pac" size='80' placeholder="digite la identificación o el nombre" onblur="actualizar()">
													<input type='hidden' id='id_persona' name='id_persona'>
												</div>
											</div>
											<div class="form-group row">
				                                <label for="id_eps" class="col-sm-2 col-form-label">EPS</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="id_eps" name="id_eps" onchange="actualizar()">
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
											<span class="btn btn-danger" title="Cancelar Cita" onclick="validar()" id="btn_cancelar">Cancelar Cita <span class="fas fa-save"></span></span>
                            				</span>
										</div>
										
									</div>

								</div>

								<div class="col-sm-7">
									<div class="card text-left">
										<div class="card-header">
											<h6>Citas Asignadas</h6>
										</div>
									
										<div class="card-body">
											<div id="tablaDatacita"></div>
										</div>
									</div>
								</div>
						</div>

						<input type="hidden" id="id_agc" name="id_agc">
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
</body>

</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tablaDatacita").load("tablacita.php");

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
    	//alert(document.frm_citas.id_persona.value);
    	condicion="estado_agc='Solicitada'"
    	if(document.frm_citas.id_persona.value!=""){
    		condicion=condicion+" AND id_persona='"+document.frm_citas.id_persona.value+"'";
    	}
    	if(document.frm_citas.id_eps.value!=""){
    		condicion=condicion+" AND id_eps='"+document.frm_citas.id_eps.value+"'";
    	}
    	if(document.frm_citas.id_profesional.value!=""){
    		condicion=condicion+" AND id_persona='"+document.frm_citas.id_profesional.value+"'";
    	}
    	if(document.frm_citas.fecha.value!=""){
    		condicion=condicion+" AND fecha_agh>='"+document.frm_citas.fecha.value+" 00:00'";
    		condicion=condicion+" AND fecha_agh<='"+document.frm_citas.fecha.value+" 23:59'";
    	}    	
    	$('#condicion').val(condicion);
    	$(document).ready(function(){
    		datos=$('#frm_citas').serialize();
	    	$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizarhorario2.php",
				//success:function(r){
					
				//}
			});
			$("#tablaDatacita").load("tablacita.php");
			$('#id_agc').val("");
    	});
    }

    function seleccionar(idagc,idagh){
    	$('#id_agc').val(idagc);
    	$('#id_agh').val(idagh);
    }


</script>

<script type="text/javascript">
	function validar(){
        err="";        
        if(document.frm_citas.id_agc.value==''){err+="Debe seleccionar la fecha y hora de la cita\n";}   
        if(err!=''){
            alertify.error(err);
        }
        else{
        	alertify.confirm("Cancelacion de Cita","Desea Cancelar la Cita",
  				function(){
    				cancelar();
    			},
    			function(){

  			});           
            
        }
    }
    
    function cancelar(){
        $(document).ready(function(){
	        datos=$('#frm_citas').serialize();
	        $.ajax({
	            type:"POST",
	            data:datos,
	            url:"procesos/cancelarcita.php",
	            success:function(r){
	                if(r==1){
	                    alertify.success("Cita Cancelada");
	                    $('#frm_citas')[0].reset();
	                    $("#tablaDatacita").load("tablacita.php");
	                }
	                else{
	                    alertify.error("Error: Cita no cancelada");
	                }
	            }
	        });
        });
    }

    
</script>

