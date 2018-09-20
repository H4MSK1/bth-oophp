<?php

namespace Anax\View;

?><h2>Guess game</h2>
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
