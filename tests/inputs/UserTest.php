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

use GameOfLife\Field;
use GameOfLife\inputs\User;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

class UserTest extends TestCase
{
    public function testUserInput()
    {
        global $input;
        $field = new Field(5, 5, 1);
        $option = new Getopt();
        $user = new User();
        $input[] = "2,2,1";
        $input[] = "exit";
        $user->fillField($field, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $field2 = Field::createFromArray($pattern, 0);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testInstantExit()
    {
        global $input;
        $field = new Field(5, 5, 1);
        $option = new Getopt();
        $user = new User();
        $input[] = "exit";
        $user->fillField($field, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $field2 = Field::createFromArray($pattern, 0);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testHitAndRun()
    {
        global $input;
        $field = new Field(5, 5, 1);
        $option = new Getopt();
        $user = new User();
        $input[] = "1,1";
        $input[] = "1,1,0";
        $input[] = "exit";
        $user->fillField($field, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $field2 = Field::createFromArray($pattern, 0);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testStateZeroStayZero()
    {
        global $input;
        $field = new Field(5, 5, 1);
        $option = new Getopt();
        $user = new User();
        $input[] = "1,1,0";
        $input[] = "exit";
        $user->fillField($field, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $field2 = Field::createFromArray($pattern, 0);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testOutOfBounce()
    {
        global $input;
        $field = new Field(5, 5, 1);
        $option = new Getopt();
        $user = new User();
        $input[] = "-1,-1,1";
        $input[] = "6,6,1";
        $input[] = "exit";
        $user->fillField($field, new Console(), $option);

        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ];

        $field2 = Field::createFromArray($pattern, 0);

        $this->assertTrue($field->isEqualTo($field2));
    }
}
