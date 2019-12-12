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

        $isEqual = $this->compare($field, $pattern);
        $this->assertTrue($isEqual);
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

        $isEqual = $this->compare($field, $pattern);
        $this->assertTrue($isEqual);
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

        $isEqual = $this->compare($field, $pattern);
        $this->assertTrue($isEqual);
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

        $isEqual = $this->compare($field, $pattern);
        $this->assertTrue($isEqual);
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

        $isEqual = $this->compare($field, $pattern);
        $this->assertTrue($isEqual);
    }

    /**
     * @param Field $field
     * @param array $pattern
     * @return bool
     */
    public function compare(Field $field, array $pattern): bool
    {
        $isEqual = true;
        for ($y = 0; $y < $field->height(); $y++)
        {
            for ($x = 0; $x < $field->width(); $x++)
            {
                if ($field->fieldValue($x, $y) != $pattern[$y][$x])
                {
                    $isEqual = false;
                }
            }
        }
        return $isEqual;
    }
}
