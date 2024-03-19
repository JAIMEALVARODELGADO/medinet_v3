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
                                        <a class="nav-link" href="mn_furips13.php">Datos de la Atención</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Datos del Amparo</a>
                                    </li>
                                </ul>
                            </div> 

                            <div class="form-group row">                                
                                <label for="total_facturado" class="col-sm-4 col-form-label">Total facturado por amparo de gastos médicos quirúrgicos:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="total_facturado" name="total_facturado" size="15" maxlength="15" onfocus="traer_valorfac()">
                                </div>                                
                                <label for="total_reclamo" class="col-sm-4 col-form-label">Total reclamado por amparo de gastos médicos quirúrgicos:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="total_reclamo" name="total_reclamo" size="15" maxlength="15">
                                </div>
                            </div>
                            <div class="form-group row">                                
                                <label for="total_transporte" class="col-sm-4 col-form-label">Total facturado por amparo de gastos de transporte y movilización de la víctima:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="total_transporte" name="total_transporte" size="15" maxlength="15">
                                </div>                                
                                <label for="total_reclamo_trans" class="col-sm-4 col-form-label">Total reclamado por amparo de gastos de transporte y movilización de la víctima:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="total_reclamo_trans" name="total_reclamo_trans" size="15" maxlength="15">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="total_folios" class="col-sm-2 col-form-label">Total folios:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="total_folios" name="total_folios">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <span class="btn btn-primary" title="Guardar" onclick="validaramparo()" id="btn_nuevo">
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

    function validaramparo(){
        err="";
        if(document.frm_furips.total_facturado.value==''){err+="Total facturado\n";}
        //if(document.frm_furips.total_reclamo.value==''){err+="Total reclamado\n";}
        //if(document.frm_furips.total_folios.value==''){err+="Total folios\n";}        
        //if(document.frm_furips.id_reclamacion.value=='0'){err+="Debe guardar el encabezado de la reclamación\n";
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
            guardaramparo();
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

    function guardaramparo(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#frm_furips').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarfurips_amparo.php",
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
                idfac=datos['id_factura'];                
            }
        })
    }

    function actualizar_amparo(idreclamacion){        
        $.ajax({
            type:"POST",
            data:"idreclamacion="+idreclamacion,
            url:"procesos/obtenDatosamparo.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#total_facturado').val(datos['total_facturado']);
                $('#total_reclamo').val(datos['total_reclamo']);
                $('#total_transporte').val(datos['total_transporte']);
                $('#total_reclamo_trans').val(datos['total_reclamo_trans']);
                $('#total_folios').val(datos['total_folios']);
            }
        })
    }

     function traer_valorfac(){
        if(document.frm_furips.total_facturado.value==""){
            idfac=document.frm_furips.id_factura.value;
            $.ajax({
                type:"POST",
                data:"idfac="+idfac,
                url:"procesos/obtenDatosfac.php",
                success:function(r){
                    var datos = JSON.parse(r);
                    $('#total_facturado').val(datos['valortot_fac']);
                }
            })
        }
    }
</script>


