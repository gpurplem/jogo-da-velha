<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/signin.css">
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
                if ($result->rowCount() > 0) {
                    $data = $result->fetch(PDO::FETCH_ASSOC);
                    $idAdv = $data['id'];
                    $nomeAdv = $data['nome'];

                    date_default_timezone_set('America/Sao_Paulo');
                    $date = date("Y-m-d");

                    $sql = "INSERT INTO `partida` (`id`, `idLogado`, `idAdv`, `dataInicio`) VALUES (NULL, '$idLogado', '$idAdv', '$date')";
                    $conn->query($sql);

                    echo "<p>Partida inicializada. Clique em HOME.</p>";
                } else {
                    echo "<p>Oponente inexistente. Clique em HOME.</p>";
                }
                ?>
            </div>
        </div>
    </main>

</body>

</html>