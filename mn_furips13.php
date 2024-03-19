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
                                        <a class="nav-link" href="mn_furips1.php">Datos del Vehículo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="mn_furips12.php">Datos de la Remisión</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Datos de la Atención</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="mn_furips14.php">Datos del Amparo</a>
                                    </li>
                                </ul>
                            </div> 

                            <div class="form-group row">                                
                                <label for="fecha_ingreso" class="col-sm-3 col-form-label">Fecha y hora de ingreso:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso" placeholder="aaaa-mm-dd">
                                </div>
                            
                                <label for="fecha_egreso" class="col-sm-3 col-form-label">Fecha y hora de egreso:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="fecha_egreso" name="fecha_egreso" placeholder="aaaa-mm-dd">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dx_principal_ingre" class="col-sm-2 col-form-label">Dx Principal de ingreso:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="desc_principal_ingre" name="desc_principal_ingre">
                                    <input type='hidden' id='dx_principal_ingre' name='dx_principal_ingre'>
                                </div>
                                <label for="dx_principal_egre" class="col-sm-2 col-form-label">Dx Principal de egreso:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="desc_principal_egre" name="desc_principal_egre">                                        
                                    <input type='hidden' id='dx_principal_egre' name='dx_principal_egre'>
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <label for="dx_relac1_ingre" class="col-sm-2 col-form-label">Dx Relacionado 1 de ingreso:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="desc_relac1_ingre" name="desc_relac_ingre">
                                    <input type='hidden' id='dx_relac1_ingre' name='dx_relac1_ingre'>
                                </div>
                                <label for="dx_relac2_egre" class="col-sm-2 col-form-label">Dx Relacionado 2 de egreso:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="desc_relac1_egre" name="desc_relac2_egre">
                                    <input type='hidden' id='dx_relac1_egre' name='dx_relac1_egre'>
                                </div>                                
                            </div>

                            <div class="form-group row">
                                <label for="dx_relac2_ingre" class="col-sm-2 col-form-label">Dx Relacionado 2 de ingreso:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="desc_relac2_ingre" name="desc_relac2_ingre">
                                    <input type='hidden' id='dx_relac2_ingre' name='dx_relac2_ingre'>
                                </div>
                                <label for="dx_relac2_egre" class="col-sm-2 col-form-label">Dx Relacionado 2 de egreso:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="desc_relac2_egre" name="desc_relac2_egre">
                                    <input type='hidden' id='dx_relac2_egre' name='dx_relac2_egre'>
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <label for="id_profesional" class="col-sm-2 col-form-label">Profesional tratante</label>
                                <div class="col-sm-4">
                                    <select class="form-control form-control-sm" id="id_profesional" name="id_profesional">
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
                                <div class="col-sm-3">
                                    <span class="btn btn-primary" title="Guardar" onclick="validaratencion()" id="btn_nuevo">
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
    /*if(isset($_POST['id_reclamacion'])){
        $_SESSION['gid_reclamacion']=$_POST['id_reclamacion'];
    }
    else{
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
                actualizar_atencion(idreclamacion);
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

        $("#desc_principal_ingre").autocomplete("procesos/autocomp_cie.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#desc_principal_ingre").result(function(event, data, formatted) {
            $("#dx_principal_ingre").val(data[1]);
        });

        $("#desc_principal_egre").autocomplete("procesos/autocomp_cie.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#desc_principal_egre").result(function(event, data, formatted) {
            $("#dx_principal_egre").val(data[1]);
        });

        $("#desc_relac1_ingre").autocomplete("procesos/autocomp_cie.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#desc_relac1_ingre").result(function(event, data, formatted) {
            $("#dx_relac1_ingre").val(data[1]);
        });
        
        $("#desc_relac1_egre").autocomplete("procesos/autocomp_cie.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#desc_relac1_egre").result(function(event, data, formatted) {
            $("#dx_relac1_egre").val(data[1]);
        });
        
        $("#desc_relac2_ingre").autocomplete("procesos/autocomp_cie.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#desc_relac2_ingre").result(function(event, data, formatted) {
            $("#dx_relac2_ingre").val(data[1]);
        });
        
        $("#desc_relac2_egre").autocomplete("procesos/autocomp_cie.php", {
            width: 460,
            matchContains: false,
            mustMatch: false,
            selectFirst: false
        });
        $("#desc_relac2_egre").result(function(event, data, formatted) {
            $("#dx_relac2_egre").val(data[1]);
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

    function validaratencion(){
        err="";

        if(document.frm_furips.fecha_ingreso.value==''){err+="Fecha de ingreso\n";}
        if(document.frm_furips.fecha_egreso.value==''){err+="Fecha de egreso\n";}
        if(document.frm_furips.dx_principal_ingre.value==''){err+="Dx principal al ingreso\n";}
        if(document.frm_furips.dx_principal_egre.value==''){err+="Dx principal al egreso\n";}
        if(document.frm_furips.id_profesional.value==''){err+="Profesional tratante\n";}        
        //if(document.frm_furips.id_reclamacion.value=='0'){err+="Debe guardar el encabezado de la reclamación\n";
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
            guardaratencion();
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

    function guardaratencion(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#frm_furips').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarfurips_atencion.php",
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

    function actualizar_atencion(idreclamacion){        
        $.ajax({
            type:"POST",
            data:"idreclamacion="+idreclamacion,
            url:"procesos/obtenDatosatencion.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#fecha_ingreso').val(datos['fecha_ingreso']);                
                $('#fecha_egreso').val(datos['fecha_egreso']);
                $('#dx_principal_ingre').val(datos['dx_principal_ingre']);
                $('#dx_relac1_ingre').val(datos['dx_relac1_ingre']);
                $('#dx_relac2_ingre').val(datos['dx_relac2_ingre']);
                $('#dx_principal_egre').val(datos['dx_principal_egre']);
                $('#dx_relac1_egre').val(datos['dx_relac1_egre']);
                $('#dx_relac2_egre').val(datos['dx_relac2_egre']);
                $('#id_profesional').val(datos['id_profesional']);
                $('#desc_principal_ingre').val(datos['desc_principal_ingre']);
                $('#desc_principal_egre').val(datos['desc_principal_egre']);
                $('#desc_relac1_ingre').val(datos['desc_relac1_ingre']);
                $('#desc_relac2_ingre').val(datos['desc_relac2_ingre']);
                $('#desc_relac1_egre').val(datos['desc_relac1_egre']);
                $('#desc_relac2_egre').val(datos['desc_relac2_egre']);
            }
        })
    }
</script>
