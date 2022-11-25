<link rel="stylesheet" href="./css/autocomplete.css">


<div class="main-matches-new">
    <p>Nova partida contra:</p>
    <form autocomplete="off" action="nova-partida.php" method="POST">
        <div class="autocomplete">
            <input id="input-adv" type="text" name="player" placeholder="Jogadores">
        </div>
        <input id="input-adv-btn" type="submit" value="JOGAR" name="jogador">
    </form>
</div>


<script src="./js/getNames.js"></script>


<script>
    var nomes = Array();
    <?php
    $thisID = $_SESSION['id'];
    $sql = "SELECT `email` FROM `users` WHERE `id` != '$thisID'";
    $preparado = $conn->prepare($sql);
    $preparado->execute();
    while ($result = $preparado->fetch(PDO::FETCH_ASSOC)) {
        $email = $result['email'];
        echo "nomes.push('$email');";
    }
    ?>
    autocomplete(document.getElementById("input-adv"), nomes);
</script>