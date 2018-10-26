<?php
/**
 * Create routes using $app programming style.
 */

$app->router->any(['GET', 'POST'], 'dice100', function () use ($app) {
    $initiateGame = function () use ($app) {
        $app->session->set('game', new \H4MSK1\Game\Game(5, 5));
        return $app->session->get('game');
    };

    if (! $app->session->has('game')) {
        $initiateGame();
    }

    $game = $app->session->get('game');

    if ($game->isGameOver() === true || ! is_null($app->request->getPost('reset'))) {
        $app->session->destroy();

        $game = $initiateGame();
    }

    if (! is_null($app->request->getPost('player1'))) {
        $game->roll(1);
    }

    if (! is_null($app->request->getPost('player2'))) {
        $game->roll(2);
    }

    if (! is_null($app->request->getPost('switch_turn'))) {
        $game->switchTurn();
    }

    $data = [
        'game' => $game,
    ];

    $app->view->add('anax/v2/dice100/dice100', $data);

    return $app->page->render([
        'title' => 'Dice 100',
    ]);
});
