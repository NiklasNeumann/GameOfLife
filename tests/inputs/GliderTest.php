<?php

namespace inputs;

use GameOfLife\Field;
use GameOfLife\inputs\Glider;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;

require_once "Getopt.php";

class GliderTest extends TestCase
{
    public function testFillFieldYieldsNotEmptyField()
    {
        $field = new Field(5, 5, 1);
        $glider = new Glider();
        $options = new Getopt();
        $console = new Console();

        $glider->fillField($field, $console, $options);
        $isEmpty = true;

        for ($y = 0; $y < $field->height(); $y++)
        {
            for ($x = 0; $x < $field->width(); $x++)
            {
                if ($field->fieldValue($x, $y) != 0)
                {
                    $isEmpty = false;
                }
            }
        }

        $this->assertFalse($isEmpty);

        return $field;
    }

    /**
     * @depends testFillFieldYieldsNotEmptyField
     * @param Field $field
     */
    public function testGliderPattern(Field $field)
    {
        $pattern = [
            [0, 0, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [0, 0, 0, 1, 0],
            [0, 1, 1, 1, 0],
            [0, 0, 0, 0, 0]];

        $field2 = Field::createFromArray($pattern,0);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testFieldIsTooSmallForGlider()
    {
        $isEqual = true;
        $field = new Field(2, 2, 1);
        $glider = new Glider();
        $glider->fillField($field,new Console(), new Getopt());

        $expected = [
            [0,1],
            [1,1]];

        $field2 = Field::createFromArray($expected,0);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testCustomPosition()
    {
        $field = new Field(5, 5, 1);
        $option = new Getopt();
        $glider = new Glider();
        $glider->addOptions($option);
        $option->parse("-x 0 -y 0");
        $glider->fillField($field, new Console(), $option);

        $pattern = [
            [0, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]];

        $field2 = Field::createFromArray($pattern,0);

        $this->assertTrue($field->isEqualTo($field2));
    }
}
