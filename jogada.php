<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/jogada.css">

    <title>Jogar</title>
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
    ?>
        <main class="main-index">
            <div class="main-outer-container">
                <div class="jogada-inner-container">
                    <div class="placar">
                        <div class="nome voce"><span>VOCÊ</span></div>
                        <div class="nome adv"><span>OPONENTE</span></div>
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
            const idJogadorLogado = <?php echo $_SESSION['id']; ?>;
        </script>

        <?php
        $idCasa = $_SESSION['id'];
        $idPartida = $_GET['1'];
        $idAdv = $_GET['0'];
        $_SESSION['idPartida'] = $idPartida;
        $_SESSION['idAdv'] = $idAdv;

        /*===== Select de todos os movimentos da partida =====*/
        include("acessarBD.php");
        $sql = "SELECT * FROM `jogada` WHERE `idPartida` = $idPartida AND `idJogadorAtual` IN ($idCasa, $idAdv) AND `idJogadorEspera` IN ($idCasa,  $idAdv)";
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
            for (let i = 0; i < jogadorPosicao.length; i += 2) {
                let player = jogadorPosicao[i];
                let pos = jogadorPosicao[i + 1];
                if (idJogadorLogado == player) {
                    document.getElementById(pos).classList.add("marked-logged");
                } else {
                    document.getElementById(pos).classList.add("marked-opponent");
                }
            }
        </script>
        <!--===== Verificar se partida aceita jogadas ainda (não houve vencedor) =====-->
        <!--===== Controlar qual jogador pode marcar posição =====-->
        <?php
        $sql = "SELECT `idVencedor`, `idUltimoJogar` FROM `partida` WHERE `id` = $idPartida";
        $result = $conn->query($sql);
        if ($result->rowCount() > 0) {
            $dados = $result->fetch(PDO::FETCH_ASSOC);
            $idVencedor = $dados['idVencedor'];

            if($idVencedor == 0) {
                $idUltimo = $dados['idUltimoJogar'];
                if ($idUltimo != $idCasa) {
        ?>
                    <!--===== Capturar apenas elementos que podem ser selecionados =====-->
                    <script>
                        let strUrlDestino;
                        let setTodasPos = new Set(['1', '2', '3', '4', '5', '6', '7', '8', '9']);
                        let arrPosMarcadas = [];
                        for (let i = 1; i < jogadorPosicao.length; i += 2) {
                            arrPosMarcadas.push(jogadorPosicao[i]);
                        }
                        let setPosMarcadas = new Set(arrPosMarcadas);
                        let setPosDisponiveis = new Set([...setTodasPos].filter(x => !setPosMarcadas.has(x)));
                        let arrPosDisponiveis = Array.from(setPosDisponiveis);

                        /*===== Carregar eventListener apenas onde pode ser marcado =====*/
                        for (let i = 0; i < arrPosDisponiveis.length; i++) {
                            document.getElementById(arrPosDisponiveis[i]).addEventListener("click", marcarPos);
                        }

                        /*===== Marca posição, remove eventListeners, gera URL, cria botão confirma =====*/
                        function marcarPos() {
                            this.classList.add("marked-logged");

                            for (let i = 0; i < arrPosDisponiveis.length; i++) {
                                document.getElementById(arrPosDisponiveis[i]).removeEventListener("click", marcarPos);
                            }

                            strUrlDestino = window.location.href;
                            let strpos = strUrlDestino.indexOf("php") + 3;
                            strUrlDestino = strUrlDestino.substr(0, strpos) + "?cellid=" + this.id;
                            strUrlDestino = strUrlDestino.replace("jogada", "salvarjogada");

                            let confirmP = document.createElement("p");
                            confirmP.setAttribute("style", "text-align:center;padding: 2%");
                            let confirmLink = document.createElement("a");
                            confirmLink.setAttribute("href", strUrlDestino);
                            confirmLink.innerHTML = "CONFIRMAR";
                            confirmP.appendChild(confirmLink);
                            document.getElementsByClassName("jogada-inner-container")[0].appendChild(confirmP);
                        }
                    </script>
                <?php
                } ?>
            <?php
            }
        }
    /*===== Se houver usuário logado: fim =====*/
    /*===== Se não houver usuário logado =====*/
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