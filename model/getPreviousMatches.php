<?php

$userIsLogged = isset($_SESSION['id']);

if ($userIsLogged) {
    $loggedId = $_SESSION['id'];
    $previousMatchesSql = "SELECT * FROM `partida` WHERE (`idLogado` = $loggedId OR `idAdv` = $loggedId) AND `idVencedor` != 0";

    $preparedTemplateForMatches = $conn->prepare($previousMatchesSql);
    $preparedTemplateForMatches->execute();

    while ($matchesRow = $preparedTemplateForMatches->fetch(PDO::FETCH_ASSOC)) {
        $matchDate = $matchesRow['dataInicio'];
        $matchId = $matchesRow['id'];
        $winnerId = $matchesRow['idVencedor'];
        $winnerName;
        $adversaryId;

        $adversaryIsLogged = $matchesRow['idAdv'] == $loggedId;
        if($adversaryIsLogged){
            $adversaryId = $loggedId;
        } else {
            $adversaryId = $matchesRow['idAdv'];
        }

        $adversaryDataSql = "SELECT * FROM `users` WHERE `id` = $adversaryId";
        $preparedTemplateForAdversary = $conn->prepare($adversaryDataSql);
        $preparedTemplateForAdversary->execute();
        $adversaryRow = $preparedTemplateForAdversary->fetch(PDO::FETCH_ASSOC);
        $adversaryName = $adversaryRow['nome'];

        $winnerIsLogged = $winnerId == $loggedId;
        if ($winnerIsLogged) {
            $winnerName = "você";
        } else {
            $winnerName =  $adversaryName;
        }
        
        echo "<p><a href='jogada.php?0=$adversaryId&1=$matchId'>$adversaryName | $matchDate | vencedor: $winnerName</a></p>";
    }
}
?>