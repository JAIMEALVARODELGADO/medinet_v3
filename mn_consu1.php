<?php
require("valida_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Medinet V3</title>
    <?php require_once "scripts.php";?>
</head>

<body>
    <?php
    require("encabezado.php");
    require("menu.php");
    $hoy=date("Y-m-d");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-left">
                    <div class="card-header">
                        <h4>Pacientes Agendados</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id_persona" class="col-sm-2 col-form-label">Fecha</label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $hoy;?>">
                            </div>
                            <div class="col-sm-3">
                                <span class="btn btn-primary" title="Buscar" onclick="actualizar_citas()" id="btn_buscar">Buscar <span class="fas fa-search"></span></span>
                                </span>
                            </div>
                        </div>
                        <div id="tablaDatatable"></div>
                    </div>
                    <div class="card-footer text-muted">
                        By Soluciones Thin & Thin
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <form id="form1" name='form1' method="POST">
        <input type="hidden" id="id_agc" name="id_agc">
        <input type="hidden" id="id_aten" name="id_aten">
        <input type="hidden" id="fecha_cita" name="fecha_cita">
    </form>
</body>

</html>

<script type="text/javascript">
    actualizar_citas();

    function atender(id_agc){
        $('#id_agc').val(id_agc);
        document.form1.action='mn_consu11.php'
        document.form1.target="";
        document.form1.submit();
    }

    function inasistencia(id_agc,nombre_){
        alertify.confirm('Registrar Inasistencia', 'Desea registrar la inasistencia del paciente: '+nombre_,
            function(){ 
                $.ajax({
                    type:"POST",
                    data:"id_agc="+id_agc,
                    url:"procesos/inasistencia.php",
                    success:function(r){
                        if(r==1){
                            $("#tablaDatatable").load("tablaagendamedico.php");
                            alertify.success("Inasistencia Registrada!");
                        }else{
                            alertify.error("Inasistencia no Registrada!");
                        }
                    }
                })

            }
            ,function(){

            });
    }

    function imprimir(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_historia.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function imprimirformula(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_formula.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function imprimirorden(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_orden.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function imprimirproced(id_aten){        
        $('#id_aten').val(id_aten);
        document.form1.action="mn_impr_proced.php";
        document.form1.target="new";
        document.form1.submit();
    }

    function actualizar_citas(){
        $('#fecha_cita').val($('#fecha').val());
        $(document).ready(function(){
            datos=$('#form1').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"procesos/actualizarcitas.php",                
            });
            $("#tablaDatatable").load("tablaagendamedico.php");            
        });
    }
</script>

<!---Aqui desactivo la combinacion Ctrl-Click -->
<script type="text/javascript">
    $('a').click(function (e){  
    if (e.ctrlKey) {
        return false;
    }
    });
</script>