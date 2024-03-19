<?php
session_start();
$_SESSION['gcondicionA']=substr($_POST['condicionA'], 5);
$_SESSION['gcondicionB']=substr($_POST['condicionB'], 5);
echo "<br>".$_SESSION['gcondicionA'];
echo "<br>".$_SESSION['gcondicionB'];

?>