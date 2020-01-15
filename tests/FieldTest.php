<?php

namespace GameOfLife\tests;

use PHPUnit\Framework\TestCase;
use GameOfLife\Field;


class FieldTest extends TestCase
{
    public function testConstructedFieldIsEmpty()
    {
        $field = new Field(50, 25, 1);
        $isEmpty = true;

        for($y = 0; $y < $field->height(); $y++)
        {
            for($x = 0; $x < $field->width(); $x++)
            {
                if($field->fieldValue($x, $y) != 0)
                {
                    $isEmpty = false;
                }
            }
        }

        $this->assertTrue($isEmpty);

        return $field;
    }

    /**
     * @depends clone testConstructedFieldIsEmpty
     * @param Field $_field
     */
    public function testFieldElements(Field $_field)
    {
        $this->assertEquals(50, $_field->width());

        $this->assertEquals(25, $_field->height());
    }

    /**
     * @depends clone testConstructedFieldIsEmpty
     * @param Field $_field
     */
    public function testSetFieldValue(Field $_field)
    {
        $_field->setFieldValue(25, 15, 1);
        $this->assertEquals(1, $_field->fieldValue(25, 15));
    }

    /**
     * @depends clone testConstructedFieldIsEmpty
     * @param Field $_field
     */
    public function testNextGenerationOnEmptyFieldYieldsEmptyField(Field $_field)
    {
        $_field->start(new DummyOutput());

        $isEmpty = true;

        for($y = 0; $y < $_field->height(); $y++)
        {
            for($x = 0; $x < $_field->width(); $x++)
            {
                if($_field->fieldValue($x, $y) != 0)
                {
                    $isEmpty = false;
                }
            }
        }

        $this->assertTrue($isEmpty);
    }

    /**
     * @depends clone testConstructedFieldIsEmpty
     * @param Field $_field
     */
    public function testCountNeighbourIsAlive(Field $_field)
    {
        $_field->setFieldValue(25, 15, 1);
        $_field->setFieldValue(25, 14, 1);
        $_field->setFieldValue(25, 13, 1);

        $_field->start(new DummyOutput());

        $this->assertEquals(1, $_field->fieldValue(26, 14));
        $this->assertEquals(1, $_field->fieldValue(25, 14));
        $this->assertEquals(1, $_field->fieldValue(24, 14));
        $this->assertEquals(0, $_field->fieldValue(25, 15));
        $this->assertEquals(0, $_field->fieldValue(25, 13));
    }

    public function testIfTheIsEqualFunctionWorks()
    {
        $field = new Field(5, 5, 5);
        $field2 = new Field(5, 5, 5);

        $this->assertTrue($field->isEqualTo($field2));
    }

    public function testCompareWithSmallerField()
    {
        $field = new Field(5, 5, 5);
        $field2 = new Field(3, 2, 5);

        $this->assertFalse($field->isEqualTo($field2));
    }

    public function testCompareWithLargerField()
    {
        $field = new Field(5, 5, 5);
        $field2 = new Field(3, 2, 5);

        $this->assertFalse($field->isEqualTo($field2));
    }

    public function testCompareToDifferentFields()
    {
        $field = new Field(5, 5, 5);
        $field2 = new Field(3, 2, 5);

        $field->setFieldValue(3, 3, 1);

        $this->assertFalse($field->isEqualTo($field2));
    }


}