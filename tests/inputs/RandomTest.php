<?php

namespace inputs;

use GameOfLife\Field;
use GameOfLife\inputs\Random;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

class RandomTest extends TestCase
{
    public function testFieldIsNotEmpty()
    {
        $field = new Field(5, 5, 1);
        $random = new Random();
        $random->fillField($field, new Console(), new Getopt());

        $isNotEmpty = true;

        for ($y = 0; $y < $field->height(); $y++)
        {
            for ($x = 0; $x < $field->width(); $x++)
            {
                if ($field->fieldValue($x, $y) != 0)
                {
                    $isNotEmpty = false;
                }
            }
        }

        $this->assertFalse($isNotEmpty);
    }

    public function testAddOptions()
    {
        $field = new Field(5, 5, 1);
        $random = new Random();
        $option = new Getopt();
        $random->addOptions($option);
        $option->parse("--filling 20");
        $random->fillField($field, new Console(), $option);


        $isNotEmpty = true;

        for ($y = 0; $y < $field->height(); $y++)
        {
            for ($x = 0; $x < $field->width(); $x++)
            {
                if ($field->fieldValue($x, $y) != 0)
                {
                    $isNotEmpty = false;
                }
            }
        }
        $this->assertFalse($isNotEmpty);
    }

    public function testFilling100Fills100Percent()
    {
        $field = new Field(5, 5, 1);
        $random = new Random();
        $option = new Getopt();
        $random->addOptions($option);
        $option->parse("--filling 100");
        $random->fillField($field, new Console(), $option);


        $isFilled = true;

        for ($y = 0; $y < $field->height(); $y++)
        {
            for ($x = 0; $x < $field->width(); $x++)
            {
                if ($field->fieldValue($x, $y) == 0)
                {
                    $isFilled = false;
                }
            }
        }
        $this->assertTrue($isFilled);
    }
}
