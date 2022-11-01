<?php
    $sql = $_POST['sql'];
    include("acessarBD.php");
    $preparado = $conn->prepare($sql);
    $preparado->execute();
?>