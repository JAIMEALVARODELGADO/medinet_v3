<?php
set_time_limit(1200);
?>
        <div class="container-fluid" style="background-color:#2574a9">
            <div class="row">
                <div class="col-sm-1"><img src="imagenes/medinet.png" height="50" width="100" class="img-responsive img-rounded" alt=""></div>
                <div class="col-sm-11"><h1 style="color:#ffffff"><?php echo $_SESSION['gnombre_ent'];?></h1></div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-9"><h5 style="color:#ffffff">Historia Clínica</h5></div>
                <div class="col-sm-2">
                    <h7 style="color:#ffffff">Medinet V3</h7>
                    <br><h7 style="color:#ffffff">Usuario: <span class="badge badge-primary"><?php echo $_SESSION['gnombreusu_log'];?></span>
                    </h7>
                </div>
            </div>
            
        </div>
