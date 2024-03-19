<?php
session_start();
$_SESSION['gid_persona']=$_POST['id_persona'];
echo $_SESSION['gid_persona'];
?>