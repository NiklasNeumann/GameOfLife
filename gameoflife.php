<?php

namespace GameOfLife;

use GameOfLife\inputs\BaseInput;
use GameOfLife\outputs\BaseOutput;
use GameOfLife\outputs\Console;
use Ulrichsg\Getopt;

require "vendor/autoload.php";

require_once "Getopt.php";
require_once "Field.php";

/**
 * @var BaseInput
 */
$allInputs = [];
/**
 * @var BaseOutput $allOutputs
 */
$allOutputs = [];
$maxSteps = 500;

$width = 50;
$height = 20;

class test
{
    public $hey;
    public function __construct()
    {
        $this->hey = "hey";
    }
    public static function e()
    {
        self::e2();
        return new test();
    }
    public static function e2()
    {}
    public function abc()
    {

    }
}
test::e();

$options = new Getopt
([
    ["h", "help", Getopt::NO_ARGUMENT, "Shows help text."],
    ["v", "version", Getopt::NO_ARGUMENT, "Shows current version of the game."],
    [null, "width", Getopt::REQUIRED_ARGUMENT, "Allows to set the fields width manually. (HEIGHT STAYS ON DEFAULT)"],
    [null, "height", Getopt::REQUIRED_ARGUMENT, "Allows to set the field height manually. (WIDTH STAYS ON DEFAULT)"],
    [null, "maxSteps", Getopt::REQUIRED_ARGUMENT, "Allows to set the maximum times the program should run through."],
    [null, "input", Getopt::REQUIRED_ARGUMENT, "Allows to start the game's as stats manually."],
    [null, "output", Getopt::REQUIRED_ARGUMENT, "Allows to set the output-type manually."]
]);

foreach (glob("inputs/*.php") as $file)
{
    $baseName = basename($file, ".php");
    $className = "GameOfLife\\inputs\\" . $baseName;
    if ($baseName == "BaseInput") continue;
    if (!class_exists($className)) continue;
    $inputs = new $className;
    $allInputs[$baseName] = $inputs;
    $inputs->addOptions($options);
}

foreach (glob("outputs/*.php") as $file)
{
    $baseName = basename($file, ".php");
    $className = "GameOfLife\\outputs\\" . $baseName;
    if ($baseName == "BaseOutput") continue;
    if (!class_exists($className)) continue;
    $outputs = new $className;
    $allOutputs[$baseName] = $outputs;
    $outputs->addOptions($options);
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
    echo "Game of Life\nVersion 2.1, CN-Consult GmbH 2019\n";
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

$field = new Field($width, $height, $maxSteps);
if ($options->getOption("input"))
{
    if (isset($allInputs[$options->getOption("input")]))
    {
        $console = new Console();
        $allInputs[$options->getOption("input")]->fillField($field, $console, $options);
    }
}

if ($options->getOption("output"))
{
    $argument = $options->getOption("output");
    if (isset($allOutputs[$argument]))
    {
        $allOutputs[$argument]->startOutput($options);
        $field->start($allOutputs[$argument]);
        $allOutputs[$argument]->finishOutput();
    }
}

