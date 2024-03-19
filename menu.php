<?php
require_once "clases/conexion.php";
$obj=new conectar();
$conexion=$obj->conexion();    
?>

        <ul class="nav nav-pills" style="background-color:#024b83">
            <li class="nav-item">
                <a class="nav-link  btn-secondary"  href="inicio.php" role="button" aria-haspopup="true" aria-expanded="false">Inicio</a>                
            </li>
            <?php
                $consmenu="SELECT id_menu,opcion_menu,url_menu FROM menu WHERE nivel_menu='1' ORDER BY orden_menu";
                //echo $consmenu;
                $consmenu=mysqli_query($conexion,$consmenu);
                while ($rowmenu=mysqli_fetch_array($consmenu)){
                    //echo "<br>".$rowmenu['opcion_menu'];
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn-secondary" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $rowmenu['opcion_menu'];?></a>
                            
                                <?php
                                $consubmenu="SELECT opcion_menu,url_menu FROM vw_menu WHERE dependencia_menu='$rowmenu[id_menu]' AND id_persona='$_SESSION[gusuario_log]' ORDER BY orden_menu";
                                //echo $consubmenu;
                                $consubmenu=mysqli_query($conexion,$consubmenu);
                                if(mysqli_num_rows($consubmenu)<>0){
                                    echo "<div class='dropdown-menu'>";
                                    while($rowsub=mysqli_fetch_array($consubmenu)){
                                        echo "<a class='dropdown-item' href='$rowsub[url_menu]'>$rowsub[opcion_menu]</a>";
                                    }
                                    echo "</div>";
                                }
                                ?>                            
                        </li>
                    <?php
                }

            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle btn-secondary" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ayuda</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="mn_acercade.php" target="_blank" onclick="window.open(this.href, this.target, 'width=500,height=400'); return false;">Acerca de Medinet</a>
                    <a class="dropdown-item" href="mn_manual.php" target="_blank" onclick="window.open(this.href, this.target, 'width=500,height=700'); return false;">Manual de Usuario</a>                    
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link btn-secondary" href="index.php">Salir</a>                
            </li>
        </ul>

<!---Aqui desactivo la combinacion Ctrl-Click -->
<!--<script type="text/javascript">
    $('a').click(function (e){  
    if (e.ctrlKey) {
        return false;
    }
    });
</script>-->
