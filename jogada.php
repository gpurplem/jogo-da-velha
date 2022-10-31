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

    <?php
    session_start();
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

        <!-- Pegar posições marcadas -->
        <script>
            var jogadorPosicao = Array();
            const idLoggedPlayer = <?php echo $_SESSION['id']; ?>;
        </script>
        <?php
        $idCasa = $_SESSION['id'];
        $idPartida = $_GET['1'];
        $idAdv = $_GET['0'];
        $_SESSION['idPartida'] = $idPartida;
        $_SESSION['idAdv'] = $idAdv;

        include("acessarBD.php");
        $sql = "SELECT * FROM `jogada` WHERE `idPartida` = $idPartida AND `idJogadorAtual` IN ($idCasa, $idAdv) AND `idJogadorEspera` IN ($idCasa, $idAdv)";
        $preparado = $conn->prepare($sql);
        $preparado->execute();

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

        <!-- Pintar posições marcadas 1 a 9 -->
        <script>
            for (let i = 0; i < jogadorPosicao.length; i += 2) {
                let player = jogadorPosicao[i];
                let pos = jogadorPosicao[i + 1];

                if (idLoggedPlayer == player) {
                    document.getElementById(pos).classList.add("marked-logged");
                } else {
                    document.getElementById(pos).classList.add("marked-opponent");
                }
            }
        </script>

        <!-- Verificar se é a vez de quem está logado -->

        <!-- Capturar apenas elementos que podem ser selecionados e marcar jogada -->
        <script>
            let onlyPosTmp = [];
            let urlData;

            for (let i = 1; i < jogadorPosicao.length; i += 2) {
                onlyPosTmp.push(jogadorPosicao[i]);
            }

            let positions = new Set(['1', '2', '3', '4', '5', '6', '7', '8', '9']);
            let positionsTaken = new Set(onlyPosTmp);
            let positionsAvailtmp = new Set([...positions].filter(x => !positionsTaken.has(x)));
            let positionsAvail = Array.from(positionsAvailtmp);

            function markMove() {
                this.classList.add("marked-logged");

                for (let i = 0; i < positionsAvail.length; i++) {
                    document.getElementById(positionsAvail[i]).removeEventListener("click", markMove);
                }

                urlData = window.location.href;
                let strpos = urlData.indexOf("php") + 3;
                urlData = urlData.substr(0, strpos) + "?cellid=" + this.id;
                urlData = urlData.replace("jogada", "salvarjogada");

                let confirmP = document.createElement("p");
                confirmP.setAttribute("style", "text-align:center;padding: 2%");

                let confirmLink = document.createElement("a");
                confirmLink.setAttribute("href", urlData);
                confirmLink.innerHTML = "CONFIRMAR";

                confirmP.appendChild(confirmLink);

                document.getElementsByClassName("jogada-inner-container")[0].appendChild(confirmP);
            }

            for (let i = 0; i < positionsAvail.length; i++) {
                document.getElementById(positionsAvail[i]).addEventListener("click", markMove);
            }
        </script>

    <?php
    } else {
    ?>
        <main class="main-index">
            <div class="main-outer-container">
                <div class="jogada-inner-container">
                    <div style="display:flex; height: 100%;justify-content: center;align-items: center;">
                        <p>Faça login!</p>
                    </div>
                </div>
            </div>
        </main>
    <?php
    }
    ?>

</body>

</html>