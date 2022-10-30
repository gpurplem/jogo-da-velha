<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe</title>

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!-- Página sem estar logada -->
    <?php
    session_start();
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

        <!-- Página logada -->

    <?php
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
                        Partidas anteriores
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>
                        <p>A X B -> A</p>
                        <p>C X D -> D</p>

                    </div>
                    <div class="main-matches">
                        <div class="main-matches-inner">
                            <div class="main-matches-continue">
                                <p>Continuar partida contra:</p>
                                <p>A</p>
                                <p>B</p>
                                <p>C</p>
                                <p>D</p>
                                <p>E</p>
                                <p>F</p>
                                <p>G</p>
                                <p>H</p>
                                <p>A</p>
                                <p>B</p>
                                <p>C</p>
                                <p>D</p>
                                <p>E</p>
                                <p>F</p>
                                <p>G</p>
                                <p>H</p>
                            </div>

                            <link rel="stylesheet" href="./css/autocomplete.css">
                            <div class="main-matches-new">
                                <p>Nova partida contra:</p>
                                <form autocomplete="off" action="nova-partida.php">
                                    <div class="autocomplete">
                                        <input id="input-adv" type="text" name="players" placeholder="Jogadores">                                        
                                    </div>
                                </form>
                                <input id="input-adv-btn" type="submit" value="JOGAR">
                            </div>

                            <script src="./js/getNames.js"></script>
                            <script>
                                var nomes = Array();
                                <?php                                
                                    $thisID = $_SESSION['id'];
                                    include("acessarBD.php");
                                    $sql = "SELECT `id`, `nome` FROM `users` WHERE `id` != '$thisID'";  

                                    $preparado = $conn->prepare($sql);
                                    $preparado->execute();
                                    
                                    while($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
                                        $nome_atual = $result['nome'];
                                        $id_atual = $result['id'];
                                        echo "nomes.push('$nome_atual');";
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