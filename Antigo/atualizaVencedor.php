<?php
    $sql = $_POST['sql'];
    session_start();
    if(isset($_SESSION['id'])){
        include("acessarBD.php");
        $preparado = $conn->prepare($sql);
        $preparado->execute();
    }
    
?>