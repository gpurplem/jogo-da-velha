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
                        <div class="main-signin">

    <?php
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        include("./acessarBD.php");

        $sql = "INSERT INTO `users` (`id`, `nome`, `senha`, `email`) VALUES (NULL, '$nome', '$password', '$email')";

        

        try{
            $result = $conn->query($sql);

            if($result) {
                echo "<p>Cadastro realizado com sucesso!</p>";
            } else {
                echo "<p>Cadastro não realizado!</p><br>";
            }
        } catch(Exception $e) {
            echo "<p>Cadastro não realizado!</p><br>";
        }
    ?>
                        </div>
                    </div>
                </div>
            </main>

</body>

</html>