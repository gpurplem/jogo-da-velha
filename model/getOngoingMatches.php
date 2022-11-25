<?php
$userIsLogged = isset($_SESSION['id']);

if ($userIsLogged) {

    $loggedId = $_SESSION['id'];
    $OngoingMatchSql = "SELECT * FROM `partida` WHERE (`idLogado` = $loggedId OR `idAdv` = $loggedId) AND`idVencedor` = 0";

    $preparedTemplateForMatch = $conn->prepare($OngoingMatchSql);
    $preparedTemplateForMatch->execute();

    while ($matchRow = $preparedTemplateForMatch->fetch(PDO::FETCH_ASSOC)) {
        $matchDate = $matchRow['dataInicio'];
        $matchId = $matchRow['id'];

        $adversaryIsLogged = $matchRow['idAdv'] == $loggedId;
        if ($adversaryIsLogged) {
            $adversaryId = $loggedId;
        } else {
            $adversaryId = $matchRow['idAdv'];
        }

        $adversaryDataSql = "SELECT * FROM `users` WHERE `id` = $adversaryId";
        $preparedTemplateForAdversary = $conn->prepare($adversaryDataSql);
        $preparedTemplateForAdversary->execute();
        $adversaryRow = $preparedTemplateForAdversary->fetch(PDO::FETCH_ASSOC);

        $LastPlayer;
        $isFirstMatch = $matchRow['idUltimoJogar'] == 0;
        if (!$isFirstMatch) {
            $loggedIdPlayedLast = $loggedId == $matchRow['idUltimoJogar'];
            if ($loggedIdPlayedLast) {
                $LastPlayer = "você";
            } else {
                $LastPlayer = $adversaryRow['nome'];
            }
        } else {
            $LastPlayer = "-";
        }

        $adversaryName = $resultAdv['nome'];

        echo "<p><a href='jogada.php?0=$idAdv&1=$idPartida'>$adversaryName | $dataPartida | último:$idUltJogar<a></p>";
    }
}
?>