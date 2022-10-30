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
                    <div class="main-form-outer">
                       <form action="./cadastrar.php" method="POST">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="">

                        <label for="email">Email</label>
                        <input type="email" name="email" id="">
                        
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="">

                        <input type="submit" value="CADASTRAR"><br>
                    </form> 
                    </div>
                </div>
            </div>
        </div>
    </main>



</body>

</html>