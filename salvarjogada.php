<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogada</title>

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
            <div class="main-inner-container">
                <div class="main-signin">

                    <?php
                    session_start();
                    if (isset($_SESSION['id'])) {
                        $idCasa = $_SESSION['id'];
                        $idPartida = $_SESSION['idPartida'];
                        $idAdv = $_SESSION['idAdv'];
                        $idCelula = $_GET['cellid'];

                        include("./acessarBD.php");
                        $sql = "INSERT INTO `jogada` (`idPartida`, `idJogadorAtual`, `idJogadorEspera`, `posicao`) VALUES ('$idPartida', '$idCasa', '$idAdv', '$idCelula')";

                        try {
                            $result = $conn->query($sql);
                            if ($result) {
                                echo "<p>Posição marcada com sucesso!</p>";
                                $sql = "UPDATE `partida` SET `idUltimoJogar` = '$idCasa' WHERE `partida`.`id` = $idPartida;";
                                $conn->query($sql);
                            } else {
                                echo "<p>Posição não marcada.</p>";
                            }
                        } catch (Exception $e) {
                            echo "<p>Posição não marcada.</p><br>";
                        }
                    } else {
                        echo "<p style='text-align:center'>Faça login!</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

</body>

</html>