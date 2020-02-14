<?php

namespace GameOfLife\inputs;

$input = [];

function readline($prompt = null)
{
    global $input;
    if (empty($input))
    {
        return "";
    }

    return array_shift($input);
}

namespace inputs;

use GameOfLife\Board;
use GameOfLife\inputs\User;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

class UserTest extends TestCase
{
    public function testUserInput()
    {
        global $input;
        $board = new Board(5, 5);
        $option = new Getopt();
        $user = new User();
        $input[] = "2,2,1";
        $input[] = "exit";
        $user->fillBoard($board, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }

    public function testInstantExit()
    {
        global $input;
        $board = new Board(5, 5);
        $option = new Getopt();
        $user = new User();
        $input[] = "exit";
        $user->fillBoard($board, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }

    public function testHitAndRun()
    {
        global $input;
        $board = new Board(5, 5);
        $option = new Getopt();
        $user = new User();
        $input[] = "1,1";
        $input[] = "1,1,0";
        $input[] = "exit";
        $user->fillBoard($board, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }

    public function testStateZeroStayZero()
    {
        global $input;
        $board = new Board(5, 5);
        $option = new Getopt();
        $user = new User();
        $input[] = "1,1,0";
        $input[] = "exit";
        $user->fillBoard($board, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }

    public function testOutOfBounce()
    {
        global $input;
        $board = new Board(5, 5);
        $option = new Getopt();
        $user = new User();
        $input[] = "-1,-1,1";
        $input[] = "6,6,1";
        $input[] = "exit";
        $user->fillBoard($board, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $board2 = Board::createFromArray($pattern);

        $this->assertTrue($board->isEqualTo($board2));
    }
}
