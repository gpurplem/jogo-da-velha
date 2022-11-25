<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">

    <title>Tic-Tac-Toe</title>
</head>

<body>
    <?php
    session_start();
    include("acessarBD.php");


    /*=================================================
    Página inicial quando está deslogado.
    =================================================*/


    if (!isset($_SESSION['id'])) {
    ?>
        <nav class="nav-top">
            <div class="nav-container">
                <ul class="nav-options">
                    <li><a href="index.php">HOME</a></li>
                </ul>
            </div>
        </nav>

        <main class="main-index">
            <div class="main-outer-container">
                <div class="main-inner-container">
                    <div class="main-intro">
                        <h2>Jogo da velha</h2>
                        <blockquote cite="https://pt.wikipedia.org/wiki/Jogo_da_velha">
                            A origem é desconhecida, com indicações de que pode ter começado no antigo Egito, onde foram encontrados tabuleiros esculpidos na rocha, que teriam mais de 3.500 anos.
                            De alguma forma, é um jogo "aparentado" dos "Merels" (ver Marel).
                            Algumas lendas urbanas contam que o jogo terá nascido em Portugal, na cidade de Almada no ano 545. No entanto, só foi popularizado no ano 1500, pelo descobridor Pedro Álvares Cabral, que adorava jogar este jogo durante as suas viagens.
                            Álvares Cabral terá decidido que este jogo seria o primeiro a ser ensinado ao povo indígena no Brasil.
                            O jogo pode ser jogado sobre um tabuleiro ou mesmo sendo riscado sobre um pedaço de papel ou mesa.
                            O menor tabuleiro do mundo foi feito com DNA.
                        </blockquote>
                        <small><a href="https://pt.wikipedia.org/wiki/Jogo_da_velha">pt.wikipedia.org/wiki/Jogo_da_velha</a></small>
                    </div>
                    <div class="main-login">
                        <form action="logar.php" method="post">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="">

                            <label for="password">Senha</label>
                            <input type="password" name="password" id="">

                            <input type="submit" value="LOGIN"><br>

                            <p><a href="frm-cadastrar.php">Cadastre-se</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    <?php


        /*=================================================
    Página inicial quando está logado.
    =================================================*/


    } else {
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
                        Partidas anteriores:
                        <?php
                        $idLogado = $_SESSION['id'];
                        $sql = "SELECT * FROM `partida` WHERE (`idLogado` = $idLogado OR `idAdv` = $idLogado) AND `idVencedor` != 0";
                        $preparado = $conn->prepare($sql);
                        $preparado->execute();

                        while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
                            $dataPartida = $result['dataInicio'];
                            $idPartida = $result['id'];
                            $idVencedor = $result['idVencedor'];
                            $nomeVencedor;                            

                            /*===== Adequar quem é adversário =====*/
                            $idAdv = $result['idAdv'];
                            if ($idAdv == $idLogado) {
                                $idAdv = $result['idLogado'];
                            }

                            $sqlAdv = "SELECT * FROM `users` WHERE `id` = $idAdv";
                            $preparadoAdv = $conn->prepare($sqlAdv);
                            $preparadoAdv->execute();
                            $resultAdv = $preparadoAdv->fetch(PDO::FETCH_ASSOC);
                            $advNome = $resultAdv['nome'];

                            /*===== Adequar quem é vencedor =====*/
                            if($idVencedor == $idLogado){
                                $nomeVencedor = "você";
                            } else {
                                $nomeVencedor=  $advNome;                               
                            }

                            echo "<p><a href='jogada.php?0=$idAdv&1=$idPartida'>$advNome | $dataPartida | vencedor: $nomeVencedor</a></p>";
                        }
                        ?>
                    </div>

                    <div class="main-matches">
                        <div class="main-matches-inner">

                            <!-- Continuar partida (apenas se idvencedor=0) -->
                            <div class="main-matches-continue">
                                <p>Continuar partida contra:</p>
                                <?php
                                $idLogado = $_SESSION['id'];
                                $sql = "SELECT * FROM `partida` WHERE (`idLogado` = $idLogado OR `idAdv` = $idLogado) AND `idVencedor` = 0";
                                $preparado = $conn->prepare($sql);
                                $preparado->execute();

                                while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
                                    $dataPartida = $result['dataInicio'];
                                    $idPartida = $result['id'];

                                    /*===== Adequar quem é adversário =====*/
                                    $idAdv = $result['idAdv'];
                                    if ($idAdv == $idLogado) {
                                        $idAdv = $result['idLogado'];
                                    }

                                    $sqlAdv = "SELECT * FROM `users` WHERE `id` = $idAdv";
                                    $preparadoAdv = $conn->prepare($sqlAdv);
                                    $preparadoAdv->execute();
                                    $resultAdv = $preparadoAdv->fetch(PDO::FETCH_ASSOC);
                                    $idUltJogar;
                                    if ($result['idUltimoJogar'] != 0) {
                                        if ($idLogado == $result['idUltimoJogar']) {
                                            $idUltJogar = "você";
                                        } else {
                                            $idUltJogar = $resultAdv['nome'];
                                        }
                                    } else {
                                        $idUltJogar = "-";
                                    }
                                    $advNome = $resultAdv['nome'];
                                    echo "<p><a href='jogada.php?0=$idAdv&1=$idPartida'>$advNome | $dataPartida | último: $idUltJogar</a></p>";
                                }
                                ?>
                            </div>

                            <!-- Escolher oponente de nova partida -->
                            <link rel="stylesheet" href="./css/autocomplete.css">
                            <div class="main-matches-new">
                                <p>Nova partida contra:</p>
                                <form autocomplete="off" action="nova-partida.php" method="POST">
                                    <div class="autocomplete">
                                        <input id="input-adv" type="text" name="player" placeholder="Jogadores">
                                    </div>
                                    <input id="input-adv-btn" type="submit" value="JOGAR" name="jogador">
                                </form>
                            </div>
                            <script src="./js/getNames.js"></script>
                            <script>
                                var nomes = Array();
                                <?php
                                $thisID = $_SESSION['id'];
                                $sql = "SELECT `email` FROM `users` WHERE `id` != '$thisID'";

                                $preparado = $conn->prepare($sql);
                                $preparado->execute();

                                while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
                                    $email = $result['email'];
                                    echo "nomes.push('$email');";
                                }
                                ?>
                                autocomplete(document.getElementById("input-adv"), nomes);
                            </script>

                        </div>
                    </div>

                </div>
            </div>
        </main>
    <?php
    }
    ?>

</body>

</html>