<?php
    session_start();

    $idLogado = $_SESSION['id'];
    $nomeLogado = $_SESSION['nome'];

    //Dados adversário
    $emailAdv =  $_POST['player'];
    $idAdv;
    $nomeAdv;

    include("./acessarBD.php");
    $sql = "SELECT `id`, `nome` FROM `users` WHERE `email` LIKE '$emailAdv'";
    $result = $conn->query($sql); 
    if($result->rowCount() > 0) {
        $data = $result->fetch(PDO::FETCH_ASSOC);
        $idAdv = $data['id'];
        $nomeAdv = $data['nome'];
    } else {
        //Email não consta no DB.
        //Clique aqui para ir até a partida criada, ou clique em home caso queira jogar mais tarde.
        //Clicando aqui jogador vai pra página da partida em si
    }

    
    
?>
