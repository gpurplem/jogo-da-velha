<?php
session_start();
$userIsLogged = isset($_SESSION['id']);

if ($userIsLogged) {
    $thisID = $_SESSION['id'];
    $getAdversaryNamesSql = "SELECT `email` FROM `users` WHERE `id` != '$thisID'";
    $preparedTemplateForAdversary = $conn->prepare($getAdversaryNamesSql);
    $preparedTemplateForAdversary->execute();

    $nameArray = array();

    while ($userRow = $preparedTemplateForAdversary->fetch(PDO::FETCH_ASSOC)) {
        array_push($nameArray, $userRow['email']);
    }

    echo json_encode($nameArray);
    echo "oi";
}

echo "fora";
?>