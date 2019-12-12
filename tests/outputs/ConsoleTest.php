<?php

namespace outputs;

use GameOfLife\Field;
use GameOfLife\outputs\Console;
use PHPUnit\Framework\TestCase;

class ConsoleTest extends TestCase
{
    public function testConsoleOutput()
    {
        $field = new Field(5, 5, 1);
        $field->setFieldValue(3, 3, 1);
        $console = new Console();
        $console->outputField($field);

        $this->expectOutputString("     \n     \n     \n   $ \n     \n");
    }

    public function testFieldIsEmpty()
    {
        $field = new Field(5, 5, 1);
        $console = new Console();
        $console->outputField($field);

        $this->expectOutputString("     \n     \n     \n     \n     \n");
    }
}
