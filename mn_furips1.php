<?php
//session_start();
require("valida_sesion.php");
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();
$hoy=date("Y-m-d");
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

    <form id="frm_furips" name="frm_furips" method="POST">
	<div class="card text">
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link active" href="#">Formulario FURIPS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_furips2.php">Propietarios/Conductores</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mn_furips3.php">Listado de Furips</a>
				</li>				
			</ul>
		</div>    
		<br>
		<div class="container">
	        <div class="row">
	            <div class="col-sm-12">
	                <div class="card text-left">
	                    <div class="card-header">
	                        <h4>Formulario FURIPS</h4>
	                    </div>
	                    <div class="card-body">                            
                            <?php
                                require("mn_furips_datosreclamacion.php");
                            ?>
	                        <!---------------------------->
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Datos del Vehículo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="mn_furips12.php">Datos de la Remisión</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="mn_furips13.php">Datos de la Atención</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="mn_furips14.php">Datos del Amparo</a>
                                    </li>
                                </ul>
                            </div> 

                            <div class="form-group row">
                                <label for="propietario" class="col-sm-2 col-form-label">Propietario:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="propietario" name="propietario" size="40" maxlength="40">
                                    <input type='hidden' id='id_propietario' name='id_propietario'>
                                </div>
                            
                                <label for="conductor" class="col-sm-2 col-form-label">Conductor:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="conductor" name="conductor" size="40" maxlength="40">
                                    <input type='hidden' id='id_conductor' name='id_conductor'>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="estado_aseg" class="col-sm-3 col-form-label">Estado de Aseguramiento:</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" id="estado_aseg" name="estado_aseg">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_estado_aseguramiento ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            
                                <label for="marca_vehiculo" class="col-sm-2 col-form-label">Marca:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="marca_vehiculo" name="marca_vehiculo" size="15" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group row">
                               <label for="placa_vehiculo" class="col-sm-2 col-form-label">Placa:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="placa_vehiculo" name="placa_vehiculo" size="10" maxlength="10">
                                </div>
                            
                                <label for="tipo_vehiculo" class="col-sm-2 col-form-label">Tipo de vehículo:</label>
                                <div class="col-sm-4">
                                    <select class="form-control form-control-sm" id="tipo_vehiculo" name="tipo_vehiculo">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_tipo_vehiculo ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                               <label for="codigo_aseg" class="col-sm-2 col-form-label">Código de la Aseguradora:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="codigo_aseg" name="codigo_aseg" size="6" maxlength="6">
                                </div>
                                <label for="nombre_aseg" class="col-sm-2 col-form-label">Nombre de la Aseguradora:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nombre_aseg" name="nombre_aseg" size="45" maxlength="45">
                                </div>

                                <label for="numero_poliza" class="col-sm-2 col-form-label">Número de Poliza SOAT:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="numero_poliza" name="numero_poliza" size="20" maxlength="20">
                                </div>
                            </div>

                            <div class="form-group row">
                               <label for="fecha_inicio" class="col-sm-3 col-form-label">Fecha de Inicio de la Póliza:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" size="10" maxlength="10" placeholder="aaaa-mm-dd">
                                </div>

                                <label for="fecha_final" class="col-sm-3 col-form-label">Fecha de Finalización de la Póliza:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="fecha_final" name="fecha_final" size="10" maxlength="10" placeholder="aaaa-mm-dd">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="intervencion_aut" class="col-sm-3 col-form-label">
                                    <input type="checkbox" id="intervencion_aut" name="intervencion_aut">
                                    Intervención de la Autoridad
                                </label>
                                <label for="cobro_excedente" class="col-sm-3 col-form-label">
                                    <input type="checkbox" id="cobro_excedente" name="cobro_excedente">
                                    Cobro por excedente de la póliza
                                </label>
                            </div>

                            <div class="form-group row">
                               <label for="placa_vehiculo2" class="col-sm-2 col-form-label">Placa del Segundo Vehículo:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="placa_vehiculo2" name="placa_vehiculo2" size="10" maxlength="10">
                                </div>
                            
                                <label for="tipoiden_propvehi2" class="col-sm-2 col-form-label">Tipo de documento del propietario del segudo vehículo:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="tipoiden_propvehi2" name="tipoiden_propvehi2">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_tipo_ident ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <label for="identprop_vehi2" class="col-sm-2 col-form-label">Número de Identificación del propietario del segundo vehículo:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="identprop_vehi2" name="identprop_vehi2" size="16" maxlength="16">
                                </div>
                            </div>

                            <div class="form-group row">
                               <label for="placa_vehiculo3" class="col-sm-2 col-form-label">Placa del Tercer Vehículo:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="placa_vehiculo3" name="placa_vehiculo3" size="10" maxlength="10">
                                </div>
                            
                                <label for="tipoiden_propvehi2" class="col-sm-2 col-form-label">Tipo de documento del propietario del tercer vehículo:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="tipoiden_propvehi3" name="tipoiden_propvehi3">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_tipo_ident ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <label for="identprop_vehi3" class="col-sm-2 col-form-label">Número de Identificación del propietario del tercer vehículo:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="identprop_vehi3" name="identprop_vehi3" size="16" maxlength="16">
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <span class="btn btn-primary" title="Guardar" onclick="validarvehiculo()" id="btn_nuevo">
                                    Guardar <span class="fas fa-save"></span></span>
                                    </span>
                                </div>
                            </div>
                            <!---------------------------->                     
                        </div>
	                    <div class="card-footer text-muted">
	                        By Soluciones Thin & Thin
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>		
	</div>
        <input type="hidden" id="id_reclamacion" name="id_reclamacion" value="<?php echo $_SESSION['gid_reclamacion'];?>">
    </form>
</body>
</html>

<?php
    if(isset($_POST['id_reclamacion'])){
        $_SESSION['gid_reclamacion']=$_POST['id_reclamacion'];
    }
    /*else{
        $_SESSION['gid_reclamacion']=0;
    }*/

    if($_SESSION['gid_reclamacion']<>0){        
        //echo $_SESSION['gid_reclamacion'];
        $idrec=$_SESSION['gid_reclamacion'];
        ?>
        <script type="text/javascript">
            idreclamacion='<?php echo $idrec;?>';            
            $(document).ready(function(){                
                actualizar(idreclamacion);
                actualizar_amparo(idreclamacion);
            });            
        </script>
        
        <?php
    }    
?>
<script type="text/javascript">
    $().ready(function() {  
        $("#numero_fac").autocomplete("procesos/autocomp_factura.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#numero_fac").result(function(event, data, formatted) {
            $("#id_factura").val(data[1]);
        });

        $("#municipio").autocomplete("procesos/autocomp_municipio.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#municipio").result(function(event, data, formatted) {
            $("#municipio_even").val(data[1]);
        });

        $("#propietario").autocomplete("procesos/autocomp_furipspersona.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#propietario").result(function(event, data, formatted) {
            $("#id_propietario").val(data[1]);
        });

        $("#conductor").autocomplete("procesos/autocomp_furipspersona.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#conductor").result(function(event, data, formatted) {
            $("#id_conductor").val(data[1]);
        });
    });

    function validar(){               
        err="";
        if(document.frm_furips.id_factura.value==''){err+="Factura\n";}
        if(document.frm_furips.condi_victima.value==''){err+="Condición de la víctima\n";}
        if(document.frm_furips.naturaleza_even.value==''){err+="Naturaleza del evento\n";}
        if(document.frm_furips.municipio_even.value==''){err+="Municipio del evento\n";}        
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
            guardar();            
        }
    }

    function validarvehiculo(){
        err="";
        if(document.frm_furips.id_propietario.value==''){err+="Propietario\n";}        
        if(document.frm_furips.id_conductor.value==''){err+="Conductor\n";}
        //if(document.frm_furips.id_reclamacion.value==''){err+="Debe guardar el encabezado de la reclamación\n";
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
            guardarvehiculo();
        }
    }

    function guardar(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#frm_furips').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarfurips.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            //$('#frm_furips')[0].reset();
                        }
                        else{
                            alertify.error("Error: Registro no guardado");
                        }
                    }
                });
            //});
        });
    }

    function guardarvehiculo(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#frm_furips').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarfurips_vehiculo.php",
                    success:function(r){
                        if(r==1){
                            alertify.success("Registro guardado");
                            //$('#frm_furips')[0].reset();
                        }
                        else{
                            alertify.error("Error: Registro no guardado");
                        }
                    }
                });
            //});
        });
    }

    function actualizar(idreclamacion){        
        $.ajax({
            type:"POST",
            data:"idreclamacion="+idreclamacion,
            url:"procesos/obtenDatosfurips.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#numero_recant').val(datos['numero_recant']);
                $('#respglo_recla').val(datos['respglo_recla']);
                $('#id_factura').val(datos['id_factura']);
                $('#numero_fac').val(datos['descripcion']);
                $('#condi_victima').val(datos['condi_victima']);
                $('#naturaleza_even').val(datos['naturaleza_even']);
                $('#descripcion_even').val(datos['descripcion_even']);
                $('#direccion_even').val(datos['direccion_even']);
                $('#fecha_even').val(datos['fecha_even']);                
                $('#municipio_even').val(datos['municipio_even']);
                $('#municipio').val(datos['nombre_mun']);
                $('#zona_even').val(datos['zona_even']);
            }
        })
    }

    function actualizar_amparo(idreclamacion){        
        $.ajax({
            type:"POST",
            data:"idreclamacion="+idreclamacion,
            url:"procesos/obtenDatosvehiculo.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#id_propietario').val(datos['id_propietario']);
                $('#id_conductor').val(datos['id_conductor']);
                $('#propietario').val(datos['nombre_propietario']);
                $('#conductor').val(datos['nombre_conductor']);
                $('#estado_aseg').val(datos['estado_aseg']);
                $('#marca_vehiculo').val(datos['marca_vehiculo']);
                $('#placa_vehiculo').val(datos['placa_vehiculo']);
                $('#tipo_vehiculo').val(datos['tipo_vehiculo']);
                $('#codigo_aseg').val(datos['codigo_aseg']);
                $('#nombre_aseg').val(datos['nombre_aseg']);
                $('#numero_poliza').val(datos['numero_poliza']);
                $('#marca_vehiculo').val(datos['marca_vehiculo']);
                $('#fecha_inicio').val(datos['fecha_inicio']);
                $('#fecha_final').val(datos['fecha_final']);
                if(datos['intervencion_aut']=='1'){
                    $('#intervencion_aut').attr('checked', true);
                }
                else{
                    $('#intervencion_aut').attr('checked', false);
                }
                if(datos['cobro_excedente']=='1'){
                    $('#cobro_excedente').attr('checked', true);
                }
                else{
                    $('#cobro_excedente').attr('checked', false);
                }                
                $('#placa_vehiculo2').val(datos['placa_vehiculo2']);
                $('#tipoiden_propvehi2').val(datos['tipoiden_propvehi2']);
                $('#identprop_vehi2').val(datos['identprop_vehi2']);
                $('#placa_vehiculo3').val(datos['placa_vehiculo3']);
                $('#tipoiden_propvehi3').val(datos['tipoiden_propvehi3']);
                $('#identprop_vehi3').val(datos['identprop_vehi3']);
            }
        })
    }
</script>


