<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./view/css/style.css">

    <title>Tic-Tac-Toe</title>
</head>

<body>
    <main class="whole-page">
        <div class="content-align">
            <div class="content">
                <div class="intro-text">
                    <h2>Jogo da velha</h2>
                    <blockquote cite="https://pt.wikipedia.org/wiki/Jogo_da_velha">
                        A origem é desconhecida, com indicações de que pode ter começado no antigo Egito, onde foram encontrados tabuleiros esculpidos na rocha, que teriam mais de 3.500 anos.
                        De alguma forma, é um jogo "aparentado" dos "Merels" (ver Marel).
                        Algumas lendas urbanas contam que o jogo terá nascido em Portugal, na cidade de Almada no ano 545. No entanto, só foi popularizado no ano 1500, pelo descobridor Pedro Álvares Cabral, que adorava jogar este jogo durante as suas viagens.
                        Álvares Cabral terá decidido que este jogo seria o primeiro a ser ensinado ao povo indígena no Brasil.
                        O jogo pode ser jogado sobre um tabuleiro ou mesmo sendo riscado sobre um pedaço de papel ou mesa.
                        O menor tabuleiro do mundo foi feito com DNA.
                    </blockquote>
                    <small><a href="https://pt.wikipedia.org/wiki/Jogo_da_velha">Wikipedia</a></small>
                </div>
                <div class="form">
                    <form action="./Antigo/logar.php" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="">

                        <label for="password">Senha</label>
                        <input type="password" name="password" id="">

                        <input type="submit" value="LOGIN"><br>

                        <p><a href="./view/signin.php">Cadastre-se</a></p>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>