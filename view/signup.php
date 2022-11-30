<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/style.css">
    <script src="../controller/User.js"></script>

    <title>Cadastrar</title>
</head>

<body>
    <main class="whole-page">
        <div class="content-align">
            <div class="content">
                <div class="form" id="formContainer">
                    <form id="signin-form">
                        <label for="name">Nome</label>
                        <input type="text" id="name">

                        <label for="email">Email</label>
                        <input type="email" id="email">

                        <label for="password">Senha</label>
                        <input type="password" id="password">

                        <input type="button" value="CADASTRAR" onclick="User.signup()"><br>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>