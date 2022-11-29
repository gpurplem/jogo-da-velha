<?php
class Matches
{
    public static function getPreviousMatches()
    {
        include_once "./Database.php";
        include_once "./Session.php";
        Session::startSession();
        Database::connectToDb();

        $loggedId = $_SESSION['id'];
        $previousMatchesSql = "SELECT * FROM `partida` WHERE (`idLogado` = $loggedId OR `idAdv` = $loggedId) AND `idVencedor` != 0";
        $preparedTemplateForMatches = $dbConnection->prepare($previousMatchesSql);
        $preparedTemplateForMatches->execute();

        while ($matchesRow = $preparedTemplateForMatches->fetch(PDO::FETCH_ASSOC)) {
            $matchDate = $matchesRow['dataInicio'];
            $matchId = $matchesRow['id'];
            $winnerId = $matchesRow['idVencedor'];
            $adversaryIsLogged = $matchesRow['idAdv'] == $loggedId;

            if ($adversaryIsLogged) {
                $adversaryId = $loggedId;
            } else {
                $adversaryId = $matchesRow['idAdv'];
            }

            $adversaryDataSql = "SELECT * FROM `users` WHERE `id` = $adversaryId";
            $preparedTemplateForAdversary = $dbConnection->prepare($adversaryDataSql);
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

    public static function getOngoingMatches()
    {
        include_once "./Database.php";
        include_once "./Session.php";
        Session::startSession();
        Database::connectToDb();

        $OngoingMatchSql = "SELECT * FROM `partida` WHERE (`idLogado` = $loggedId OR `idAdv` = $loggedId) AND`idVencedor` = 0";
        $preparedTemplateForMatch = $dbConnection->prepare($OngoingMatchSql);
        $preparedTemplateForMatch->execute();

        $loggedId = $_SESSION['id'];

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
            $preparedTemplateForAdversary = $dbConnection->prepare($adversaryDataSql);
            $preparedTemplateForAdversary->execute();
            $adversaryRow = $preparedTemplateForAdversary->fetch(PDO::FETCH_ASSOC);

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

            echo "<p><a href='jogada.php?0=$idAdv&1=$matchId'>$adversaryName | $matchDate | último:$LastPlayer<a></p>";
        }
    }
}
