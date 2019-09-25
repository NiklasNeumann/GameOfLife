<?php

$field = [];
$size = 50;
$maxIterationen = 100;

/**
 * Generate the field.
 * Sets x- and y-coordinates for the field and fills them with random 0s and 1s.
 */
for ($y = 0; $y < $size; $y++)
{
    for ($x = 0; $x < $size; $x++)
    {
        $field[$x][$y] = rand(0, 1);
    }
}

/**
 * Print the field.
 * Generates a field and replaces 1->"$" and 0->" ".
 */
function printField()
{
    global $field;
    global $size;

    for ($y = 0; $y < $size; $y++)
    {
        for ($x = 0; $x < $size; $x++)
        {
            echo ($field[$x][$y] ? "$" : " ");
        }
        echo "\n";
    }
}

/**
 * Count living neighbours and returns their count.
 * @param $_x int X-coordinates of the field.
 * @param $_y int Y-coordinates of the field.
 * @return int Of the neighbour-count.
 */
function countNeighbours($_x, $_y)
{
    global $field;
    global $size;

    $neighbours = 0;

    for ($ny = $_y - 1; $ny <= $_y + 1; $ny++)
    {
        for ($nx = $_x - 1; $nx <= $_x + 1; $nx++)
        {
            if ($nx >= $size or $nx < 0)
            {
                continue;
            }
            if ($ny >= $size or $ny < 0)
            {
                continue;
            }
            if ($nx == $_x and $ny == $_y)
            {
                continue;
            }

            if ($field[$nx][$ny] == 1)
            {
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
    global $field;
    global $size;

    $puffer = [];

    //set puffer to 0
    for ($y = 0; $y < $size; $y++)
    {
        for ($x = 0; $x < $size; $x++)
        {
            $puffer[$x][$y] = 0;
        }
    }

    for ($y = 0; $y < $size; $y++)
    {
        for ($x = 0; $x < $size; $x++)
        {
            $neighbourCount = countNeighbours($x, $y);

            if ($neighbourCount === 3)
            {
                //set alive
                $puffer[$x][$y] = 1;
            }
            if ($neighbourCount == 2 and $field[$x][$y] == 1)
            {
                $puffer[$x][$y] = 1;
            }
        }
    }
    $field = $puffer;
}

printField();

/**
 * Echos the GoL.
 */
for ($i = 0; $i < $maxIterationen; $i++)
{
    echo "\n-----Next-Gen-----\n\n";
    nextGeneration();
    printField();
}
