<?php

require __DIR__ . '/config.php';
require __DIR__ . '/autoload.php';

$title = "Guess my number (POST)";

$session = new \H4MSK1\Guess\Session();
$session->start();

$guess = $_POST['guess'] ?? null;

$game = new \H4MSK1\Guess\Guess($session->get('number', -1), $session->get('tries', 6));

$session->set('number', $game->getNumber());
$session->set('tries', $game->getTries());

$res = null;

if (isset($_POST['doReset'])) {
    $res = $game->reset();

    $session->set('number', $game->getNumber());
    $session->set('tries', $game->getTries());
}

if (isset($_POST['doCheat'])) {
    $res = $game->cheat();
}

if (isset($_POST['doGuess'])) {
    $session->set('guess', $game->makeGuess($guess));
    $session->set('lastGuess', $guess);

    $session->set('number', $game->getNumber());
    $session->set('tries', $game->getTries());

    $res = "You guessed number (" . intval($session->get('lastGuess')) . "), it was: " . $session->get('guess');
}

if (isset($_POST['destroy'])) {
    $session->destroy();
    $res = "Session data was destroyed.";
}

?><!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
</head>
<style type="text/css">
html, body {
    color: #333;
    font-family: Verdana, sans-serif, monospace;
}
</style>
<body>
    <h2>Guess game</h2>
    <h5>Guess a number between 1 and 100, you have <?= $game->getTries(); ?> tries left.</h5>

    <form method="post">
        <input type="hidden" name="number" value="<?= $game->getNumber(); ?>">

        <input type="hidden" name="tries" value="<?= $game->getTries(); ?>">

        <input type="text" name="guess" value="" placeholder="Take a guess" autofocus="">

        <input type="submit" name="doGuess" value="Make a guess">

        <input type="submit" name="doReset" value="Reset game">

        <input type="submit" name="doCheat" value="Cheat">

        <input type="submit" name="destroy" value="Destroy session">
    </form>

    <h5><?= $res; ?></h5>
</body>
</html>