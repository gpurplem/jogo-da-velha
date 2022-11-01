<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">

    <title>Cadastrar</title>
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
            <div class="main-inner-container main-inner-alert">
                <?php
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                include("./acessarBD.php");
                $sql = "INSERT INTO `users` (`id`, `nome`, `senha`, `email`) VALUES (NULL, '$nome', '$password', '$email')";

                try {
                    $result = $conn->query($sql);
                    echo "<span>Cadastro realizado com sucesso!</span>";
                    echo "<span>Clique em HOME.</span>";
                } catch (Exception $e) {
                    echo "<span>Cadastro não realizado.</span>";
                    echo "<span>E-mail já cadastrado.</span>";
                    echo "<span>Clique em HOME.</span>";
                }
                ?>
            </div>
        </div>
    </main>

</body>

</html>