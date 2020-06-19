<?php

namespace rules;

use GameOfLife\Board;
use GameOfLife\rules\AntiConway;
use PHPUnit\Framework\TestCase;

class AntiConwayTest extends TestCase
{

    public function testIfAntiConwayWorks()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(2, 1, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(2, 3, 1);
        $board->setBoardValue(1, 2, 1);

        $fields = [];
        $fields[] = $board->field(2, 1);
        $fields[] = $board->field(2, 2);
        $fields[] = $board->field(2, 3);
        $fields[] = $board->field(3, 1);
        $fields[] = $board->field(3, 2);
        $fields[] = $board->field(3, 3);
        $fields[] = $board->field(1, 2);

        $rule = new AntiConway();
        foreach($fields as $field)
        {
            $this->assertTrue($rule->calculateNewState($field));
        }
    }
}
