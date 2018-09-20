<?php

namespace H4MSK1\Guess;

require __DIR__ . '/config.php';
require __DIR__ . '/autoload.php';

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
