<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">

    <title>Sair</title>
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
                session_start();
                $_SESSION = array();
                session_destroy();
                ?>
                <span>Sessão finalizada.</span>
                <span>Clique em HOME.</span>
            </div>
        </div>
    </main>

</body>

</html>