<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>

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
        $email = $_POST['email'];
        $password = $_POST['password'];

        include("./acessarBD.php");

        $sql = "SELECT `id`, `nome`, `email` FROM `users` WHERE `email` LIKE '$email' AND `senha` LIKE '$password'";  

        try{
            $result = $conn->query($sql);            

            if($result->rowCount() > 0) {
                echo "<p>Login realizado com sucesso!</p>";

                $data = $result->fetch(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION['id'] = $data['id'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['nome'] = $data['nome'];
            } else {
                echo "<p>Email e/ou senha com erro!</p>";
            }
        } catch(Exception $e) {
            echo "<p>Email e/ou senha com erro!</p>";
        }
    ?>
                        </div>
                    </div>
                </div>
            </main>

</body>

</html>