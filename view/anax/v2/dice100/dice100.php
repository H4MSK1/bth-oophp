<?php

namespace Anax\View;

?><h2>Dice 100</h2>
<div class="jumbotron">
    <h4>Rules:</h4>
    <p>
        If one player gets a dice with the number 1, the player will lose all their points for this round and switch turns.
        <br>
        First player that gets 100 points wins, have fun!
    </p>

    <?php if ($game->isGameOver()) { ?>
        <p><h2 style="color: red;">Game over!</h2></p>
    <?php } ?>

    <form method="post">
        <h4>Round number: <?= $game->getRound() ?></h4>
        <hr>

        <?php if ($game->isPlayerDisabled(2)) { ?>
            <button class="btn btn-info" type="submit" name="switch_turn">
                Switch turn to Computer
            </button>
        <?php } ?>

        <hr>
        <h5>Player one:</h5>
        <p>
            <button class="btn btn-success" type="submit" name="player1" <?= ($game->isPlayerDisabled(1) ? "disabled" : "") ?>>
                Roll dices for player one
            </button>
        </p>
        <p>
            <h5>Sum: <?= $game->getPlayerSum(1) ?></h5>
            <br>
            <h5>Dices:</h5>
            <br>
            <?php
            foreach ($game->playerRoundsDices(1) as $round => $dices) {
                echo "<h5>Round {$round}:</h5>";
                echo "<div class=\"dice-utf8\">";

                foreach ($dices as $dice) {
                    echo "<span class=\"dice-{$dice}\"></span>";
                }

                echo "</div>";
            }
            ?>
        </p>

        <h5>Computer:</h5>
        <p>
            <button class="btn btn-success" type="submit" name="player2" <?= ($game->isPlayerDisabled(2) ? "disabled" : "") ?>>
                Roll dices for computer
            </button>
        </p>
        <p>
            <h5>Sum: <?= $game->getPlayerSum(2) ?></h5>
            <br>
            <h5>Dices:</h5>
            <br>
            <?php
            foreach ($game->playerRoundsDices(2) as $round => $dices) {
                echo "<h5>Round {$round}:</h5>";
                echo "<div class=\"dice-utf8\">";

                foreach ($dices as $dice) {
                    echo "<span class=\"dice-{$dice}\"></span>";
                }

                echo "</div>";
            }
            ?>
        </p>

        <button type="submit" class="btn btn-danger btn-block" name="reset">Reset</button>
    </form>
</div>
