<?php

namespace gameoflife;

/**
 * Create playing field
 * The class Field is responsible für generating and printing the fields and cells needed for the GoL.
 * It will also count the cell's neighbours and generate the next generation of cells by following the default GoL rules.
 * @package gameoflife
 */
class Field
{
    protected $field = [];
    protected $width;
    protected $height;
    protected $maxSteps;
    private $history = [];
    private $generationCount = 1;

    /**
     * Field constructor
     * Constructs an empty field, which can be overwritten by the child constructor.
     * @param $_width int
     * @param $_height int
     * @param $_maxSteps int
     */
    public function __construct($_width, $_height, $_maxSteps)
    {
        $this->width = $_width;
        $this->height = $_height;
        $this->maxSteps = $_maxSteps;
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $this->field[$x][$y] = 0;
            }
        }
    }

    /**
     * Print the field
     * Generates a field and replaces 1->"$" and 0->" ".
     */
    public function printField()
    {
        for ($y = 0; $y < $this->height; $y++)
        {
            for ($x = 0; $x < $this->width; $x++)
            {
                echo($this->field[$x][$y] ? "$" : " ");
            }
            echo "\n";
        }
    }

    /**
     * Count living neighbours
     * @param $_x int X-coordinates of the field.
     * @param $_y int Y-coordinates of the field.
     * @return int Of the neighbour-count.
     */
    public function countNeighbours($_x, $_y)
    {
        $neighbours = 0;

        for ($ny = $_y - 1; $ny <= $_y + 1; $ny++) {
            for ($nx = $_x - 1; $nx <= $_x + 1; $nx++) {
                if ($nx >= $this->width or $nx < 0) {
                    continue;
                }
                if ($ny >= $this->height or $ny < 0) {
                    continue;
                }
                if ($nx == $_x and $ny == $_y) {
                    continue;
                }

                if ($this->field[$nx][$ny] == 1) {
                    $neighbours++;
                }
            }
        }
        return $neighbours;
    }

    /**
     * Calculate next generation
     * First $puffer is created, which copies the contents of the $fields variable and sets the cell-status to 0 (dead).
     * After that, the "set-alive-conditions" will be implemented and cells fitting the conditions will be set to 1 (alive).
     */
    public function nextGeneration()
    {
        $nextField = [];

        //set nextField to 0
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $nextField[$x][$y] = 0;
            }
        }

        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $neighbourCount = $this->countNeighbours($x, $y);

                if ($neighbourCount === 3) {
                    //set alive
                    $nextField[$x][$y] = 1;
                }
                if ($neighbourCount == 2 and $this->field[$x][$y] == 1) {
                    $nextField[$x][$y] = 1;
                }
            }
        }
        $this->generationCount++;
        $this->field = $nextField;
    }

    /**
     * Start-Game function
     * Prints the field, calculates the next Generation and prints the new field for "maxSteps"-times.
     * Also, if a field is printed double and the field does'nt change anymore, the program will stop automatically.
     */
    public function start()
    {
        echo $this->generationCount;
        $this->printField();

        for ($i = 0; $i < $this->maxSteps; $i++) {
            $this->history[] = $this->field; //saves field
            echo "\n-----Next-Generation:" . $this->generationCount . "-----\n\n";
            $this->nextGeneration();
            $this->printField();

            //compare
            foreach ($this->history as $previousField) {
                $equal = true;
                for ($y = 0; $y < $this->height; $y++) {
                    for ($x = 0; $x < $this->width; $x++) {
                        if ($previousField[$x][$y] != $this->field[$x][$y]) {
                            $equal = false;
                        }
                    }
                }
                if ($equal == true) {
                    return;
                }
            }

            if (count($this->history) > 2) {
                array_shift($this->history);
            }
        }
    }
}
