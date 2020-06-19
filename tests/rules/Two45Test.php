<?php

namespace rules;

use GameOfLife\Board;
use GameOfLife\rules\Two45Rule;
use PHPUnit\Framework\TestCase;

class Two45Test extends TestCase
{
    public function testIfRuleTwo45Works()
    {
        $board = new Board(5, 5);
        $board->setBoardValue(1, 2, 1);
        $board->setBoardValue(2, 2, 1);
        $board->setBoardValue(3, 2, 1);
        $board->setBoardValue(4, 2, 1);

        $fields = [];
        $fields[] = $board->field(2, 1);
        $fields[] = $board->field(2, 2);
        $fields[] = $board->field(2, 3);
        $fields[] = $board->field(3, 1);
        $fields[] = $board->field(3, 2);
        $fields[] = $board->field(3, 3);

        $rule = new Two45Rule();
        foreach($fields as $field)
        {
            $this->assertTrue($rule->calculateNewState($field));
        }
    }
}
