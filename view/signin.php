<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/style.css">

    <title>Cadastrar</title>
</head>

<body>
    <main class="whole-page">
        <div class="content-align">
            <div class="content">
                <div class="form">
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
    </main>

</body>

</html>