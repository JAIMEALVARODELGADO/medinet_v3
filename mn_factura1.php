<?php
require("valida_sesion.php");
require_once "clases/conexion.php";

$obj=new conectar();
$conexion=$obj->conexion();

$mes=date("m");
switch ($mes) {
	case '01':
		$diafin='31';
		break;
	case '02':
		$diafin='28';
		break;
	case '03':
		$diafin='31';
		break;
	case '04':
		$diafin='30';
		break;
	case '05':
		$diafin='31';
		break;
	case '06':
		$diafin='30';
		break;
	case '07':
		$diafin='31';
		break;
	case '08':
		$diafin='31';
		break;
	case '09':
		$diafin='30';
		break;
	case '10':
		$diafin='31';
		break;
	case '11':
		$diafin='30';
		break;
	case '12':
		$diafin='31';
		break;		
}

$hoy=date("Y-m-d");
$ini=date("Y-m-01");
$fin=date("Y-m-$diafin");
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
					<a class="nav-link active" href="#">Crear Nueva Factura</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_factura11.php">Facturas Abiertas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_factura12.php">Facturas Cerradas/Anuladas</a>
				</li>				
			</ul>

		</div>       
		
		<div class="container-fluid">
			<br>            
			<div class="card text-left">
				<div class="card-header">
					<h4>Crear Nueva Factura</h4>
				</div>

				<div class="card-body">
					<form id="frm_factura" name="frm_factura" method="POST">

						<div class="row">
								<div class="col-sm-6">
									<div class="card text-left">
										<div class="card-header">
											<h6 class="card-title">Información para la Factura</h6>
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
				                                <label for="id_eps" class="col-sm-2 col-form-label">Convenio con la EPS</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="id_convenio" name="id_convenio">
				                                        <option value=""></option>
				                                        <?php
				                                        $sql="SELECT id_convenio,convenio_eps FROM vw_convenio WHERE estado_conv='A' ORDER BY nombre_eps";
				                                        $result=mysqli_query($conexion,$sql);
				                                        while($row=mysqli_fetch_row($result)){
				                                            echo "<option value='$row[0]'>$row[1]</option>";
				                                        }
				                                        ?>
				                                    </select>
				                                </div>
				                            </div>
				                            <div class="form-group row">
				                                <label for="fecha_fac" class="col-sm-2 col-form-label">Fecha</label>
				                                <div class="col-sm-4">
				                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $hoy;?>">
				                                    <input type="hidden" id="fecha_fac" name="fecha_fac">
				                                </div>
				                            </div>
				                            <div class="form-group row">
				                                <label for="id_eps" class="col-sm-2 col-form-label">Forma de Pago</label>
				                                <div class="col-sm-10">
				                                    <select class="form-control form-control-sm" id="formapago_fac" name="formapago_fac">
				                                        <option value=""></option>
				                                        <?php
				                                        $sql="SELECT codi_det,descripcion_det FROM vw_forma_pago ORDER BY descripcion_det";
				                                        $result=mysqli_query($conexion,$sql);
				                                        while($row=mysqli_fetch_row($result)){
				                                            echo "<option value='$row[0]'>$row[1]</option>";
				                                        }
				                                        ?>
				                                    </select>
				                                </div>
				                            </div>

				                            <div class="form-group row">
				                                <label for="fechaini_fac" class="col-sm-2 col-form-label">Periodo</label>
				                                <div class="col-sm-4">
				                                    <input type="date" class="form-control" id="fechaini" name="fechaini" value="<?php echo $ini;?>">
				                                    <input type="hidden" id="fechaini_fac" name="fechaini_fac">
				                                </div>
				                                <div class="col-sm-4">				                                    
				                                    <input type="date" class="form-control" id="fechafin" name="fechafin" value="<?php echo $fin;?>">
				                                    <input type="hidden" id="fechafin_fac" name="fechafin_fac">
				                                </div>				                                
				                            </div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-sm-6">
											<span class="btn btn-primary" title="Guardar" onclick="validar()" id="btn_nuevo">Guardar <span class="fas fa-save"></span></span>
                            				</span>
										</div>										
									</div>

								</div>

								<div class="col-sm-6">
									<div class="card text-left">
										<div class="card-header">
											<h6>Detalles sin Facturar</h6>
										</div>
									
										<div class="card-body">
											<div id="tablaDataconsulta"></div>
										</div>
									</div>
								</div>
						</div>

						<input type="hidden" id="id_aten" name="id_aten">
						<input type="hidden" id="condicion" name="condicion">
					</form>
				</div>
				<div class="card-footer text-muted">
					By Soluciones Thin & Thin
				</div>
			</div>
		</div>
	</div>
	<form id="frm_factura2" name="frm_factura2" action="mn_factura11.php" method="POST"></form>
</body>

</html>

<script type="text/javascript">
	actualizar();
    $(document).ready(function(){
        $("#tablaDataconsulta").load("tablaconsultasinfac.php");

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
    	condicion="estado_aten='C'";
    	if(document.frm_factura.id_persona.value!=""){
    		condicion=condicion+" AND id_persona='"+document.frm_factura.id_persona.value+"'";
    	}    	
    	$('#condicion').val(condicion);
    	$(document).ready(function(){
    		datos=$('#frm_factura').serialize();
	    	$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizarcons.php",
				
			});
			$("#tablaDataconsulta").load("tablaconsultasinfac.php");
			$('#id_aten').val("");
    	});
    }

    function seleccionar(idaten,nombre,idper){
    	$('#id_aten').val(idaten);
    	$('#id_persona').val(idper);
    	$('#nombre_pac').val(nombre);
    }


</script>

<script type="text/javascript">
	function validar(){
        err="";
        if(document.frm_factura.id_persona.value==''){err="Paciente, ";}
        if(document.frm_factura.id_convenio.value==''){err+="Convenio, ";}
        if(document.frm_factura.fecha.value==''){err+="Fecha de la Factura";}
        if(document.frm_factura.fechaini.value==''){err+="Fecha inicial del Periodo";}
        if(document.frm_factura.fechafin.value==''){err+="Fecha final del Periodo";}
        if(document.frm_factura.formapago_fac.value==''){err+="Forma de Pago";}

        if(err!=''){
            alertify.error('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
        	$('#fecha_fac').val(document.frm_factura.fecha.value);
        	$('#fechaini_fac').val(document.frm_factura.fechaini.value);
        	$('#fechafin_fac').val(document.frm_factura.fechafin.value);
            guardar();
            actualizar();
            //document.frm_factura2.submit();
        }
    }
    
    function guardar(){
        $(document).ready(function(){
	        datos=$('#frm_factura').serialize();	        
	        $.ajax({
	            type:"POST",
	            data:datos,
	            url:"procesos/agregarfactura.php",
	            success:function(r){
	                if(r==1){
	                    alertify.success("Registro guardado");
	                    $('#frm_factura')[0].reset();
	                }
	                else{
	                    alertify.error("Error: Registro no guardado. Asegurese que el código a reportar en el convenio sea igual al código cups de la consulta");
	                }
	            }
	        });
        });
    }
</script>

