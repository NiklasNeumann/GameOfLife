<?php

namespace gameoflife;
use Ulrichsg\Getopt;

require_once "Getopt.php";
require_once "Field.php";
require_once "Random.php";
require_once "Glider.php";

//$finalSize = 50;
$maxSteps = 500;

$width = 50;
$height = 25;

$options = new Getopt
([
    ['h', "help", Getopt::NO_ARGUMENT, "Shows help text."],
    ["v", "version", Getopt::NO_ARGUMENT, "Shows current version of the game."],
    [null, "width", Getopt::REQUIRED_ARGUMENT, "Allows to set the fields width manually. (HEIGHT STAYS ON DEFAULT)"],
    [null, "height", Getopt::REQUIRED_ARGUMENT, "Allows to set the field height manually. (WIDTH STAYS ON DEFAULT)"],
    [null, "maxSteps", Getopt::REQUIRED_ARGUMENT, "Allows to set the maximum times the program should run through."],
    [null, "startGlider", Getopt::NO_ARGUMENT, "Starts the game with a glider-object."],
    [null, "startRandom", Getopt::NO_ARGUMENT, "Starts the game with a random play-field."]
]);

$options->parse();

if ($options->getOption("help"))
{
    $options->showHelp();
    echo "INFO: IF NO OPERANDS ARE SET, THE PROGRAM WILL RUN A RANDOM-START WITH THE DEFAULT SETTINGS!\n";
    die;
}

if ($options->getOption("version"))
{
    echo "Game of Life\nVersion 1.0, CN-Consult GmbH 2019-2019\n";
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

if ($options->getOption("maxSteps"))
{
    $maxSteps = intval($options->getOption("maxSteps"));
}

if ($options->getOption("startRandom"))
{
    $startRandom = new Random("$width", "$height", "$maxSteps");
    $startRandom->start();
    die;
}

if ($options->getOption("startGlider"))
{
    $startGlider = new Glider("$width", "$height", "$maxSteps");
    $startGlider->start();
    die;
}

$startRandom = new Random("$width", "$height", "$maxSteps");
$startRandom->start();