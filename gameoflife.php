<?php

namespace GameOfLife;

use GameOfLife\inputs\BaseInput;
use Ulrichsg\Getopt;

require "autoloader.php";

require_once "Getopt.php";
require_once "Field.php";

/**
 * @var BaseInput
 */
$allInputs = [];
$maxSteps = 500;

$width = 50;
$height = 20;

$options = new Getopt
([
    ["h", "help", Getopt::NO_ARGUMENT, "Shows help text."],
    ["v", "version", Getopt::NO_ARGUMENT, "Shows current version of the game."],
    [null, "width", Getopt::REQUIRED_ARGUMENT, "Allows to set the fields width manually. (HEIGHT STAYS ON DEFAULT)"],
    [null, "height", Getopt::REQUIRED_ARGUMENT, "Allows to set the field height manually. (WIDTH STAYS ON DEFAULT)"],
    [null, "maxSteps", Getopt::REQUIRED_ARGUMENT, "Allows to set the maximum times the program should run through."],
    [null, "input", Getopt::REQUIRED_ARGUMENT, "Allows to start the game's as stats manually."]
]);

foreach (glob("inputs/*.php") as $file)
{
    $baseName = basename($file, ".php");
    $className = "GameOfLife\\inputs\\" . $baseName;
    if ($baseName == "BaseInput") continue;
    if (!class_exists($className)) continue;
    $input = new $className;
    $allInputs[$baseName] = $input;
    $input->addOptions($options);
}

$options->parse();

if ($options->getOption("help"))
{
    $options->showHelp();
    echo "INFO: IF NO OPERANDS ARE SET, THE PROGRAM WILL RUN A RANDOM-START WITH THE DEFAULT SETTINGS!\n";
    die;
}

if ($options->getOption("version"))
{
    echo "Game of Life\nVersion 2.0, CN-Consult GmbH 2019\n";
    die;
}

if ($options->getOption("width"))
{
    $width = intval($options->getOption("width"));

    if ($width < 10) $width = 10;
}

if ($options->getOption("height"))
{
    $height = intval($options->getOption("height"));

    if ($height < 10) $height = 10;
}

if ($options->getOption("maxSteps") != null)
{
    $maxSteps = intval($options->getOption("maxSteps"));
}

if ($options->getOption("input"))
{
    $field = new Field($width, $height, $maxSteps);

    if (isset($allInputs[$options->getOption("input")]))
    {
        $allInputs[$options->getOption("input")]->fillField($field, $options);
    }

    $field->start();
}
