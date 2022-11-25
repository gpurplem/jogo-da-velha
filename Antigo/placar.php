<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">

    <title>Placar</title>
</head>

<body>
    <?php
    session_start();
    include("acessarBD.php");
    if (isset($_SESSION['id'])) {
    ?>
        <nav class="nav-top">
            <div class="nav-container">
                <ul class="nav-options">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="placar.php">PLACAR</a></li>
                    <li><a href="sair.php">SAIR</a></li>
                </ul>
            </div>
        </nav>

        <main class="main-index">
            <div class="main-outer-container">
                <div class="main-inner-container">

                    <div class="main-intro">
                        <?php
                        $sql = "SELECT * FROM `partida` WHERE `idVencedor` != 0";
                        $preparado = $conn->prepare($sql);
                        $preparado->execute();

                        while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
                            $dataPartida = $result['dataInicio'];
                            $idPartida = $result['id'];
                            $idVencedor = $result['idVencedor'];
                            $idJogadorA = $result['idLogado'];
                            $idJogadorB = $result['idAdv'];  
                            $nomeVencedor;                       

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

                            /*===== Adequar quem é vencedor =====*/
                            if($idVencedor == $idJogadorA){
                                $nomeVencedor = $nomeJogadorA;
                            } else {
                                $nomeVencedor=  $nomeJogadorB;                               
                            }

                            echo "<p><a href='jogadaGlobal.php?0=$idJogadorA&1=$idPartida&2=$idJogadorB'>$nomeJogadorA VS $nomeJogadorB | $dataPartida | vencedor: $nomeVencedor</a></p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    <?php
    }
    ?>

</body>

</html>