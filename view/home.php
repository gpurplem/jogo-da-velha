<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/autocomplete.css">

    <title>Tic-Tac-Toe</title>
</head>

<body>
    <?php
    include("../model/Matches.php");
    ?>

    <nav class="nav-whole">
        <div class="nav-align">
            <ul class="nav-options">
                <li><a href="index.php">HOME</a></li>
                <li><a href="placar.php">PLACAR</a></li>
                <li><a href="sair.php">SAIR</a></li>
            </ul>
        </div>
    </nav>

    <div class="whole-page make-height-90v">
        <div class="content-align">
            <div class="content">
                <div class="home-previous-matches">
                    <p>Partidas anteriores:</p>
                    <?php
                    Matches::getPreviousMatches();
                    ?>
                </div>
                <div class="home-play-container">
                    <div class="home-play-align">
                        <div class="home-play-continue">
                            <p>Continuar partida contra:</p>
                            <?php 
                            Matches::getOngoingMatches();
                            ?>
                        </div>
                        <div class="home-play-new">
                            <p>Nova partida contra:</p>
                            <form autocomplete="off" action="nova-partida.php" method="POST">
                                <div class="autocomplete">
                                    <input id="adversary-name" type="text" name="player" placeholder="Jogadores">
                                </div>
                                <input id="adversary-name-btn" type="submit" value="JOGAR" name="jogador">
                            </form>

                            <script src="../controller/getNamesForAutocomplete.js"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>