<?php

namespace rules;

use GameOfLife\Board;
use GameOfLife\rules\CopyRule;
use PHPUnit\Framework\TestCase;

class CopyRuleTest extends TestCase
{
    public function testIfCopyRuleWorks()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(2, 3, 1);

        $fields = [];
        $fields[] = $board->field(2, 2);
        $fields[] = $board->field(2, 3);
        $fields[] = $board->field(1, 1);
        $fields[] = $board->field(2, 1);
        $fields[] = $board->field(3, 1);
        $fields[] = $board->field(1, 4);
        $fields[] = $board->field(2, 4);
        $fields[] = $board->field(3, 4);


        $rule = new CopyRule();
        foreach($fields as $field)
        {
            $this->assertTrue($rule->calculateNewState($field));
        }
    }
}
