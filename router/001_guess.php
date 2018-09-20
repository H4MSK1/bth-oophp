<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



$app->router->get('gissa/get', function () use ($app) {
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

    $data = [
        'title' => 'Gissa spelet GET',
        'game' => $game,
        'guess' => $guess,
        'tries' => $tries,
        'res' => $res,
    ];

    $app->view->add('anax/v2/guess/get', $data);

    return $app->page->render([
        'title' => $data['title'],
    ]);
});

$app->router->any(['GET', 'POST'], 'gissa/post', function () use ($app) {
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

    $data = [
        'title' => 'Gissa spelet POST',
        'game' => $game,
        'guess' => $guess,
        'tries' => $tries,
        'res' => $res,
    ];

    $app->view->add('anax/v2/guess/post', $data);

    return $app->page->render([
        'title' => $data['title'],
    ]);
});

$app->router->any(['GET', 'POST'], 'gissa/session', function () use ($app) {
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

    $data = [
        'title' => 'Gissa spelet SESSION',
        'game' => $game,
        'guess' => $guess,
        'res' => $res,
        'session' => $session,
    ];

    $app->view->add('anax/v2/guess/session', $data);

    return $app->page->render([
        'title' => $data['title'],
    ]);
});
