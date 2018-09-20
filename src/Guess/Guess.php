<?php
namespace H4MSK1\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * The current secret number
     * @var int
     */
    private $number;

    /**
     * Number of tries a guess has been made.
     * @var int
     */
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($number == -1) {
            $this->randomizeNumber();
        } else {
            $this->number = $number;
        }

        $this->tries = $tries;
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function randomizeNumber()
    {
        $this->number = rand(1, 100);
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function getTries()
    {
        return $this->tries;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @param  int $number The guess
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($number)
    {
        try {
            $this->tries = $this->tries - 1;

            if ($this->getTries() < 1) {
                $this->reset();
                throw new GuessException("No guesses remains, game was resetted.");
            }

            if ($number < 1 || $number > 100) {
                throw new GuessException("Your guess must be between 1 and 100.");
            }

            $expected = $this->getNumber();

            if ($number > $expected) {
                return "Too high.";
            } else if ($number < $expected) {
                return "Too low.";
            } else {
                $this->reset();
                return "Correct.";
            }
        } catch (GuessException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Reset the game and the tries
     * @return string
     */
    public function reset()
    {
        $this->tries = 6;
        $this->randomizeNumber();

        return "Game was resetted.";
    }

    /**
     * Return the correct number
     * @return string
     */
    public function cheat()
    {
        return "The correct answer is: {$this->getNumber()}";
    }
}
