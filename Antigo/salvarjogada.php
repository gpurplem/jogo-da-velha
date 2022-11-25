<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/signin.css">
    <link rel="stylesheet" href="./css/jogada.css">

    <title>Salvar</title>
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
                if (isset($_SESSION['id'])) {
                    /*===== Salva posição da jogada =====*/
                    $idCasa = $_SESSION['id'];
                    $idPartida = $_SESSION['idPartida'];
                    $idAdv = $_SESSION['idAdv'];
                    $idCelula = $_GET['cellid'];

                    include("./acessarBD.php");
                    $sql = "INSERT INTO `jogada` (`idPartida`, `idJogadorAtual`, `idJogadorEspera`, `posicao`) VALUES ('$idPartida', '$idCasa', '$idAdv', '$idCelula')";

                    try {
                        $result = $conn->query($sql);
                        if ($result) {
                            $sql = "UPDATE `partida` SET `idUltimoJogar` = '$idCasa' WHERE `partida`.`id` = $idPartida;";
                            $conn->query($sql);
                            echo "<p>Posição marcada com sucesso!</p>";
                        } else {
                            echo "<p>Posição não marcada.</p>";
                        }
                    } catch (Exception $e) {
                        echo "<p>Posição não marcada.</p><br>";
                    }
                ?>
                    <script>
                        /*===== Verifica se há vencedor =====*/
                        let jogadorPosicao = Array();
                        const idJogadorLogado = <?php echo $idCasa; ?>;
                        const idJogadorAdv = <?php echo $idAdv; ?>;
                        const idPartida = <?php echo $idPartida; ?>;
                    </script>
                    <?php
                    /*===== Select de todos os movimentos da partida =====*/
                    include("acessarBD.php");
                    //Não precisa do AND, creio.
                    $sql = "SELECT * FROM `jogada` WHERE `idPartida` = $idPartida AND `idJogadorAtual` IN ($idCasa, $idAdv) AND `idJogadorEspera` IN ($idCasa,  $idAdv)";
                    $preparado = $conn->prepare($sql);
                    $preparado->execute();

                    while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
                        $jogador = $result['idJogadorAtual'];
                        $posicao = $result['posicao'];
                    ?>
                        <script>
                            jogadorPosicao.push("<?php echo $jogador; ?>");
                            jogadorPosicao.push("<?php echo $posicao; ?>");
                        </script>
                <?php
                    }
                ?>
                    <script>
                        let jogadorLogado = [];
                        let jogadorAdv = [];

                        for(let i=0; i<jogadorPosicao.length; i+=2){
                            if(jogadorPosicao[i]==idJogadorLogado){
                                jogadorLogado.push(jogadorPosicao[i+1]);
                            } else {
                                jogadorAdv.push(jogadorPosicao[i+1]);
                            }
                        }

                        function ehVencedor(arr){
                            //Horizontal
                            if(arr.includes('1') && arr.includes('2') && arr.includes('3')){
                                return true;
                            } else if(arr.includes('4') && arr.includes('5') && arr.includes('6')){
                                return true;
                            } else if(arr.includes('7') && arr.includes('8') && arr.includes('9')){
                                return true;
                            } 
                            //Vertical
                            else if(arr.includes('1') && arr.includes('4') && arr.includes('7')){
                                return true;
                            } else if(arr.includes('2') && arr.includes('5') && arr.includes('8')){
                                return true;
                            } else if(arr.includes('3') && arr.includes('6') && arr.includes('9')){
                                return true;
                            } 
                            //Diagonal
                            else if(arr.includes('1') && arr.includes('5') && arr.includes('9')){
                                return true;
                            } else if(arr.includes('3') && arr.includes('5') && arr.includes('7')){
                                return true;
                            }
                            //Não ganhou
                            else {
                                return false;
                            }
                        }

                        const jogadorLogadoVenceu = ehVencedor(jogadorLogado);
                        const jogadorAdvVenceu = ehVencedor(jogadorAdv);

                        //Enviar ao servidor quem é o ganhador e atualizad db
                        let strUrlDestino = window.location.href;
                        let strpos = strUrlDestino.indexOf("tictactoe-1") + 11;
                        strUrlDestino = strUrlDestino.substr(0, strpos) + "/atualizaVencedor.php";

                        const httpRequest = new XMLHttpRequest();
                        httpRequest.onreadystatechange = function(){
                            //Processar a esposta do servidor
                            if (httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200) {
                                //console.log(httpRequest.responseText);
                                console.log("Sucesso ao atualizar vencedor.");
                            } else {
                                console.log("Não atualizou vencedor.");
                            }
                        };
                        httpRequest.open('POST', strUrlDestino, true);
                        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                        if(jogadorLogadoVenceu){
                            let sql = "UPDATE `partida` SET `idVencedor` = '" + idJogadorLogado + "' WHERE `partida`.`id` = " + idPartida;
                            httpRequest.send("sql=" + sql);                        
                        } else if(jogadorAdvVenceu){
                            let sql = "UPDATE `partida` SET `idVencedor` = '" + idJogadorAdv + "' WHERE `partida`.`id` = " + idPartida;
                            httpRequest.send("sql=" + sql); 
                        }
                    </script>                    
                <?php
                } else {
                    echo "<p style='text-align:center'>Faça login!</p>";
                }
                ?>
            </div>
        </div>
    </main>

</body>

</html>