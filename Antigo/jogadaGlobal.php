<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/jogada.css">

    <title>Jogadas</title>
</head>

<body>
    <nav class="nav-top">
        <div class="nav-container">
            <ul class="nav-options">
                <li><a href="index.php">HOME</a></li>
            </ul>
        </div>
    </nav>

    <?php
    session_start();

    /*===== Se houver usuário logado: início =====*/
    if (isset($_SESSION['id'])) {
        include("acessarBD.php");

        $idJogadorA = $_GET['0'];
        $idJogadorB = $_GET['2'];
        $idPartida = $_GET['1'];

        $sqlAdv = "SELECT * FROM `users` WHERE `id` = $idJogadorA";
        $preparadoAdv = $conn->prepare($sqlAdv);
        $preparadoAdv->execute();
        $resultAdv = $preparadoAdv->fetch(PDO::FETCH_ASSOC);
        $nomeJogadorA = $resultAdv['nome'];

        $sqlAdv = "SELECT * FROM `users` WHERE `id` = $idJogadorB";
        $preparadoAdv = $conn->prepare($sqlAdv);
        $preparadoAdv->execute();
        $resultAdv = $preparadoAdv->fetch(PDO::FETCH_ASSOC);
        $nomeJogadorB = $resultAdv['nome'];
    ?>
        <main class="main-index">
            <div class="main-outer-container">
                <div class="jogada-inner-container">
                    <div class="placar">
                        <div class="nome voce"><span><?php echo $nomeJogadorA; ?></span></div>
                        <div class="nome adv"><span><?php echo $nomeJogadorB; ?></span></div>
                    </div>
                    <div class="tabuleiro">
                        <div class="table">
                            <div class="table-row">
                                <div class="table-cell" id="1"></div>
                                <div class="table-cell left-right" id="2"></div>
                                <div class="table-cell" id="3"></div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell top-down" id="4"></div>
                                <div class="table-cell top-down left-right" id="5"></div>
                                <div class="table-cell top-down" id="6"></div>
                            </div>
                            <div class="table-row">
                                <div class="table-cell" id="7"></div>
                                <div class="table-cell left-right" id="8"></div>
                                <div class="table-cell" id="9"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--===== Coletar: [quem jogou, posição escolhida,...]: início =====-->
        <script>
            let jogadorPosicao = Array();
        </script>

        <?php
        /*===== Select de todos os movimentos da partida =====*/
        $sql = "SELECT * FROM `jogada` WHERE `idPartida` = $idPartida";
        $preparado = $conn->prepare($sql);
        $preparado->execute();

        /*===== Carregar vetor js =====*/
        while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
            $jogador = $result['idJogadorAtual'];
            $posicao = $result['posicao'];
        ?>
            <script>
                jogadorPosicao.push("<?php echo $jogador; ?>");
                jogadorPosicao.push("<?php echo $posicao; ?>");
            </script>
        <?php
        }
        ?>
        <!--===== Coletar: [quem jogou, posição escolhida,...]: fim =====-->
        <!--===== Pintar posições marcadas 1 a 9 =====-->
        <script>
            let idJogadorA = <?php echo $idJogadorA; ?>;
            for (let i = 0; i < jogadorPosicao.length; i += 2) {
                let player = jogadorPosicao[i];
                let pos = jogadorPosicao[i + 1];
                if (idJogadorA == player) {
                    document.getElementById(pos).classList.add("marked-logged");
                } else {
                    document.getElementById(pos).classList.add("marked-opponent");
                }
            }
        </script>
    <?php
    } else {
        ?>
        <main class="main-index">
            <div class="main-outer-container">
                <div class="main-inner-container main-inner-alert">
                    <p>Faça login!</p>
                </div>
            </div>
        </main>
    <?php
    }
    ?>

</body>
</html>