<?php
require("valida_sesion.php");
require_once "clases/conexion.php";
//require_once "mn_funciones.php";
$obj=new conectar();
$conexion=$obj->conexion();
$hoy=date("Y-m-d");
$hoy=$hoy." 00:00";
$_SESSION['gcondicionA']="fecha_agh>='$hoy'";
$_SESSION['gcondicionB']="fecha_agh>='$hoy'";
$hoy2=date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Medinet V3</title>
	<?php 
		require_once "scripts.php";
	?>
	<!--<link rel="stylesheet" type="text/css" href="../librerias/css/jquery.autocomplete.css">
	<script type="text/javascript" src="../librerias/js/jquery.js"></script>
	<script type='text/javascript' src='../librerias/js/jquery.autocomplete.js'></script>-->
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
					<a class="nav-link" href="mn_cancelacitas1.php">Cancelar Cita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Trasladar Agenda</a>
				</li>				
			</ul>

		</div>       
		
		<div class="container-fluid">
			<br>            
			<div class="card text-left">
				<div class="card-header">
					<h4>Trasladar Agenda</h4>
					<h6>Traslada la agenda de un profesional a otro</h6>
				</div>

				<div class="card-body">
					<form id="frm_citas" name="frm_citas" method="POST">

						<div class="row">
								<div class="col-sm-6">
									<div class="card text-left">
										<div class="card-header">
											<h6 class="card-title">Horario del Profesional Agendado</h6>
										</div>
									
										<div class="card-body">

				                            <div class="form-group row">
				                                <label for="id_profesionalA" class="col-sm-2 col-form-label">Profesional</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="id_profesionalA" name="id_profesionalA" onchange="actualizar()">
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
				                                    <input type="date" class="form-control" id="fecha" name="fecha"  onchange="actualizar()" value='<?php echo $hoy2;?>'> 
				                                </div>
				                            </div>

				                            <div id="tablaDatacitaA"></div>

										</div>
										
									</div>

								</div>

								<div class="col-sm-6">
									<div class="card text-left">
										<div class="card-header">
											<h6>Agenda del Profesional que Atenderá</h6>
										</div>
									
										<div class="card-body">
											<div class="form-group row">
				                                <label for="id_profesionalB" class="col-sm-2 col-form-label">Profesional</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="id_profesionalB" name="id_profesionalB" onchange="actualizar()">
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

											<div id="tablaDatacitaB"></div>
										</div>
									</div>
								</div>
						</div>
						
						<input type="hidden" id="id_agh" name="id_agh">
						<input type="hidden" id="condicionA" name="condicionA">
						<input type="hidden" id="condicionB" name="condicionB">
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
	actualizar();
    $(document).ready(function(){
        $("#tablaDatacitaA").load("tablahorario_trasA.php");
        $("#tablaDatacitaB").load("tablahorario_trasB.php");
        
    });
    function actualizar(){    	
    	condicionA=""
    	condicionB=""
    	if(document.frm_citas.id_profesionalA.value!=""){
    		condicionA=condicionA+" AND id_persona='"+document.frm_citas.id_profesionalA.value+"'";
    	}    	    	
    	if(document.frm_citas.fecha.value!=""){
    		condicionA=condicionA+" AND fecha_agh>='"+document.frm_citas.fecha.value+" 00:00'";
    		condicionA=condicionA+" AND fecha_agh<='"+document.frm_citas.fecha.value+" 23:59'";
    	}

    	if(document.frm_citas.id_profesionalB.value!=""){
    		condicionB=condicionB+" AND id_persona='"+document.frm_citas.id_profesionalB.value+"'";
    	}    	    	
    	if(document.frm_citas.fecha.value!=""){
    		condicionB=condicionB+" AND fecha_agh>='"+document.frm_citas.fecha.value+" 00:00'";
    		condicionB=condicionB+" AND fecha_agh<='"+document.frm_citas.fecha.value+" 23:59'";
    	}
    	$('#condicionA').val(condicionA);
    	$('#condicionB').val(condicionB);
    	if($('#condicionA').val()==""){    		
    		$('#condicionA').val(" AND fecha_agh>='<?php echo $hoy;?>'");
    	}
    	if($('#condicionB').val()==""){    		
    		$('#condicionB').val(" AND fecha_agh>='<?php echo $hoy;?>'");
    	}
    	$(document).ready(function(){
    		datos=$('#frm_citas').serialize();
	    	$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizartraslado.php",
				//success:function(r){
					
				//}
			});
			$("#tablaDatacitaA").load("tablahorario_trasA.php");
			$("#tablaDatacitaB").load("tablahorario_trasB.php");
			$('#id_agh').val("");
    	});
    }

</script>

<script type="text/javascript">
	function validar(idagh){
		$("#id_agh").val(idagh);
        err="";        
        if(document.frm_citas.id_profesionalB.value==''){err+="Debe seleccionar el profesional a quien se va a asignar agenda,\n";}
        if(document.frm_citas.id_profesionalA.value==document.frm_citas.id_profesionalB.value){err+="No puede trasladar agenda al mismo profesional"} 
        if(err!=''){
            alertify.error(err);
        }
        else{
        	alertify.confirm("Trasladar Agenda","Desea Trasladar el Horario",
  				function(){
    				trasladar();
    			},
    			function(){

  			});            
        }
    }
    
    function trasladar(){
        $(document).ready(function(){
	        datos=$('#frm_citas').serialize();
	        $.ajax({
	            type:"POST",
	            data:datos,
	            url:"procesos/trasladaragenda.php",
	            success:function(r){
	                if(r==1){
	                    alertify.success("Horario Trasladado");
	                    $("#tablaDatacitaA").load("tablahorario_trasA.php");
						$("#tablaDatacitaB").load("tablahorario_trasB.php");
						$('#id_agh').val("");
	                }
	                else{
	                    alertify.error("Error: Cita no cancelada");
	                }
	            }
	        });
        });
    }
</script>

