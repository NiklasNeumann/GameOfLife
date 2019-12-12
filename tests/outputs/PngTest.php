<?php

namespace GameOfLife\outputs;

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

function expectColor($r, $g, $b)
{
    global $input;
    $input[] = $r;
    $input[] = $g;
    $input[] = $b;
}

namespace outputs;

use GameOfLife\Field;
use GameOfLife\outputs\Png;
use PHPUnit\Framework\TestCase;
use Ulrichsg\Getopt;
use function GameOfLife\outputs\expectColor;

class PngTest extends TestCase
{
    public function testOutputWithoutColors()
    {
        $field = new Field(5, 5, 1);
        $field->setFieldValue(2, 2, 1);
        $option = new Getopt();
        $png = new Png();
        $png->startOutput($option);
        $png->outputField($field);

        $picture = imagecreatefrompng("outPng/000.png");

        $this->assertTrue($this->comparePicture($field, $picture));
    }

    public function testCellColor()
    {
        $field = new Field(5, 5, 1);
        $field->setFieldValue(2, 2, 1);
        $option = new Getopt();
        $png = new Png();
        $png->addOptions($option);
        $option->parse("--pngOutputBackgroundColor");
        expectColor("122", "122", "122");
        $png->startOutput($option);
        $png->outputField($field);

        $picture = imagecreatefrompng("outPng/000.png");

        $this->assertTrue($this->comparePicture($field, $picture, ["red" => 255, "green" => 255, "blue" => 255, "alpha" => 0], ["red" => 122, "green" => 122, "blue" => 122, "alpha" => 0]));
    }

    public function testBackgroundColor()
    {
        $field = new Field(5, 5, 1);
        $field->setFieldValue(2, 2, 1);
        $option = new Getopt();
        $png = new Png();
        $png->addOptions($option);
        $option->parse("--pngOutputCellColor");
        expectColor("200", "200", "200");
        $png->startOutput($option);
        $png->outputField($field);

        $picture = imagecreatefrompng("outPng/000.png");

        $this->assertTrue($this->comparePicture($field, $picture, ["red" => 200, "green" => 200, "blue" => 200, "alpha" => 0]));
    }

    public function testCellSizeBecauseKevinToldMeToDoSo()
    {
        $field = new Field(2, 2, 1);
        $field->setFieldValue(0, 1, 1);
        $field->setFieldValue(1, 0, 1);
        $option = new Getopt();
        $png = new Png();
        $png->addOptions($option);
        $size = 4; //TODO: Resize only works with 2^x! Any other number won't work!
        $option->parse("--pngOutputSize " . $size);
        $png->startOutput($option);
        $png->outputField($field);

        $picture = imagecreatefrompng("outPng/000.png");
        $counter = 0;
        $previousColor = imagecolorat($picture, 0 , 0);



        for($y = 0; $y < $field->width() * $size; $y++)
        {
            if (imagecolorat($picture, 0 , $y) == $previousColor)
            {
                $counter++;
            }
            else
            {
                $this->assertEquals($size, $counter);
                break;
            }
        }
    }

    /**
     * @param Field $field
     * @param $picture
     * @param $cellColor
     * @param $backgroundColor
     * @return bool
     */
    public function comparePicture(Field $field, $picture,
                                   $cellColor = ["red" => 255, "green" => 255, "blue" => 255, "alpha" => 0],
                                   $backgroundColor = ["red" => 0, "green" => 0, "blue" => 0, "alpha" => 0]): bool
    {
        $isEqual = true;
        for ($y = 0; $y < $field->height(); $y++)
        {
            for ($x = 0; $x < $field->width(); $x++)
            {
                $pxlColor = imagecolorat($picture, $x, $y);
                $color = imagecolorsforindex($picture, $pxlColor);

                if ($field->fieldValue($x, $y) == true)
                {
                    if ($color != $cellColor)
                    {
                        $isEqual = false;
                    }
                }
                else
                {
                    if ($color != $backgroundColor)
                    {
                        $isEqual = false;
                    }
                }
            }
        }
        return $isEqual;
    }
}