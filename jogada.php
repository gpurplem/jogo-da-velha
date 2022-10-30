<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogadas</title>

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/signin.css">
    <link rel="stylesheet" href="./css/jogada.css">
</head>

<body>

    <nav class="nav-top">
        <div class="nav-container">
            <ul class="nav-options">
                <li><a href="index.php">HOME</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-index">
                <div class="main-outer-container">
                    <div class="jogada-inner-container">
                        <div class="placar">
                            <div class="nome"><span>JOGADOR 1</span></div>
                            <div class="nome"><span>JOGADOR 2</span></div>
                        </div>
                        <div class="tabuleiro">
                            <div class="table">
                                <div class="table-row">
                                    <div class="table-cell"></div>
                                    <div class="table-cell left-right"></div>
                                    <div class="table-cell"></div>
                                </div>
                                <div class="table-row">
                                    <div class="table-cell top-down"></div>
                                    <div class="table-cell top-down left-right"></div>
                                    <div class="table-cell top-down"></div>
                                </div>
                                <div class="table-row">
                                    <div class="table-cell"></div>
                                    <div class="table-cell left-right"></div>
                                    <div class="table-cell"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

</body>

</html>




<?php
    session_start();
    if(isset($_SESSION['id'])){

    } else {

    }
?>