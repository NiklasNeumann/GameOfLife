<?php

namespace gameoflife;

class Field
{
    protected $field = [];
    protected $puffer = [];
    protected $generationCount = 1;
    protected $width;
    protected $height;
    protected $maxSteps;
    protected $history = [];

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
    function countNeighbours($_x, $_y)
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
     * Calculate next generation.
     * First $puffer is created, which copies the contents of the $fields variable and sets the cell-status to 0 (dead).
     * After that, the "set-alive-conditions" will be implemented and cells fitting the conditions will be set to 1 (alive).
     */
    function nextGeneration()
    {
        //$puffer = [];

        //set puffer to 0
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $this->puffer[$x][$y] = 0;
            }
        }

        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $neighbourCount = $this->countNeighbours($x, $y);

                if ($neighbourCount === 3) {
                    //set alive
                    $this->puffer[$x][$y] = 1;
                }
                if ($neighbourCount == 2 and $this->field[$x][$y] == 1) {
                    $this->puffer[$x][$y] = 1;
                }
            }
        }
        $this->generationCount++;
        $this->field = $this->puffer;
    }

    /**
     * Start-Game function
     * Prints the field, calculates the next Generation and prints the new field for "maxSteps"-times.
     * Also, if a field is printed double and the field does'nt change anymore, the program will stop automatic.
     */
    public function start()
    {
        echo $this->generationCount;
        $this->printField();

        for ($i = 0; $i < $this->maxSteps; $i++) {
            $this->history[] = $this->field; //feld speichern
            echo "\n-----Next-Generation:" . $this->generationCount . "-----\n\n";
            $this->nextGeneration();
            $this->printField();

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
            //vergleichen
        }
    }
}
