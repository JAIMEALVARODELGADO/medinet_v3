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
                                        <a class="nav-link active" href="">Datos de la Remisión</a>
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
                                <label for="tipo_refer" class="col-sm-2 col-form-label">Tipo de Referencia:</label>
                                <div class="col-sm-2">
                                    <select class="form-control form-control-sm" id="tipo_refer" name="tipo_refer">
                                        <option value=""></option>
                                        <?php
                                        $sql="SELECT codi_det,descripcion_det FROM vw_tipo_referencia ORDER BY valor_det";
                                        $result=mysqli_query($conexion,$sql);
                                        while($row=mysqli_fetch_row($result)){
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                            
                                <label for="fecha_remi" class="col-sm-2 col-form-label">Fecha de Remisión:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="fecha_remi" name="fecha_remi" placeholder="aaaa-mm-dd">
                                </div>
                                <label for="hora_salida" class="col-sm-2 col-form-label">Hora de Salida:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="hora_salida" name="hora_salida" placeholder="hh:mm">
                                </div>
                            </div>

                            
                            <div class="form-group row">                                
                                <label for="cod_habilitacion_remi" class="col-sm-4 col-form-label">Código de habilitacion de la entidad que remite:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="cod_habilitacion_remi" name="cod_habilitacion_remi" size="12" maxlength="12">
                                </div>
                                <label for="nombre_ent_remite" class="col-sm-2 col-form-label">Nombre de la entidad:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="nombre_ent_remite" name="nombre_ent_remite" placeholder="Nombre de la entidad que remite" maxlength="60">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profesional_remite" class="col-sm-3 col-form-label">Profesional quien remite:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="profesional_remite" name="profesional_remite" size="60" maxlength="60">
                                </div>

                                <label for="cargo_remite" class="col-sm-2 col-form-label">Cargo:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="cargo_remite" name="cargo_remite" size="30" maxlength="30">
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <label for="fecha_ingre_remi" class="col-sm-3 col-form-label">Fecha y hora de ingreso:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="fecha_ingre_remi" name="fecha_ingre_remi" placeholder="aaaa-mm-dd hh:mm">
                                </div>
                                <label for="id_profesional_recibe" class="col-sm-2 col-form-label">Profesional que recibe</label>
                                <div class="col-sm-4">
                                    <select class="form-control form-control-sm" id="id_profesional_recibe" name="id_profesional_recibe">
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
                                    <span class="btn btn-primary" title="Guardar" onclick="validarremision()" id="btn_nuevo">
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
                actualizar_remision(idreclamacion);
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

    function validarremision(){
        err="";
        if(document.frm_furips.tipo_refer.value==''){err+="Tipo de Referencia\n";}        
        if(document.frm_furips.fecha_remi.value==''){err+="Fecha de remisión\n"}
        if(document.frm_furips.hora_salida.value==''){err+="Hora de salida\n"}
        if(document.frm_furips.cod_habilitacion_remi.value==''){err+="Código de habilitacion\n"}
        if(document.frm_furips.profesional_remite.value==''){err+="Profesional quien remite\n"}
        if(document.frm_furips.cargo_remite.value==''){err+="Cargo del profesional quien remite\n"}
        if(document.frm_furips.fecha_ingre_remi.value==''){err+="Fecha de ingreso\n"}
        if(document.frm_furips.id_profesional_recibe.value==''){err+="Profesional quien recibe\n"}        
        if(err!=''){
            alert('Para continuar debe completar la siguiente información:\n'+err);
        }
        else{
            guardaremision();
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

    function guardaremision(){
        $(document).ready(function(){
            //$("#btn_nuevo").click(function(){
                datos=$('#frm_furips').serialize();
                $.ajax({
                    type:"POST",
                    data:datos,
                    url:"procesos/agregarfurips_remision.php",
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

    function actualizar_remision(idreclamacion){        
        $.ajax({
            type:"POST",
            data:"idreclamacion="+idreclamacion,
            url:"procesos/obtenDatosremision.php",
            success:function(r){
                var datos = JSON.parse(r);
                $('#tipo_refer').val(datos['tipo_refer']);                
                $('#fecha_remi').val(datos['fecha_remi']);
                $('#hora_salida').val(datos['hora_salida']);
                $('#cod_habilitacion_remi').val(datos['cod_habilitacion_remi']);
                $('#nombre_ent_remite').val(datos['nombre_ent_remite']);
                $('#profesional_remite').val(datos['profesional_remite']);
                $('#cargo_remite').val(datos['cargo_remite']);
                $('#fecha_ingre_remi').val(datos['fecha_ingre_remi']);
                $('#id_profesional_recibe').val(datos['id_profesional_recibe']);                
            }
        })
    }
</script>
