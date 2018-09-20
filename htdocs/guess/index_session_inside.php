<?php

namespace H4MSK1\Guess;

require __DIR__ . '/config.php';
require __DIR__ . '/autoload.php';

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
