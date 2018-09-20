<?php

namespace H4MSK1\Guess;

require __DIR__ . '/config.php';
require __DIR__ . '/autoload.php';

$number = $_POST['number'] ?? -1;
$tries = $_POST['tries'] ?? 6;
$guess = $_POST['guess'] ?? null;

$game = new \H4MSK1\Guess\Guess($number, $tries);
$res = null;

if (isset($_POST['doReset'])) {
    $res = $game->reset();
}

if (isset($_POST['doCheat'])) {
    $res = $game->cheat();
}

if (isset($_POST['doGuess'])) {
    $res = "You guessed number (" . intval($guess) . "), it was: " . $game->makeGuess($guess);
}
