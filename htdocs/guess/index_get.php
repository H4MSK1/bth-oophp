<?php

require __DIR__ . '/config.php';
require __DIR__ . '/autoload.php';

$title = "Guess my number (GET)";

$number = $_GET['number'] ?? -1;
$tries = $_GET['tries'] ?? 6;
$guess = $_GET['guess'] ?? null;

$game = new \H4MSK1\Guess\Guess($number, $tries);
$res = null;

if (isset($_GET['doReset'])) {
    $res = $game->reset();
}

if (isset($_GET['doCheat'])) {
    $res = $game->cheat();
}

if (isset($_GET['doGuess'])) {
    $res = "You guessed number (" . intval($guess) . "), it was: " . $game->makeGuess($guess);
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

    <form method="get">
        <input type="hidden" name="number" value="<?= $game->getNumber(); ?>">

        <input type="hidden" name="tries" value="<?= $game->getTries(); ?>">

        <input type="text" name="guess" value="" placeholder="Take a guess" autofocus="">

        <input type="submit" name="doGuess" value="Make a guess">

        <input type="submit" name="doReset" value="Reset game">

        <input type="submit" name="doCheat" value="Cheat">
    </form>

    <h5><?= $res; ?></h5>
</body>
</html>