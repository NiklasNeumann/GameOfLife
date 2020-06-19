<?php

namespace GameOfLife;

use GameOfLife\inputs\BaseInput;
use GameOfLife\inputs\Random;
use GameOfLife\outputs\BaseOutput;
use GameOfLife\outputs\Console;
use GameOfLife\rules\BaseRule;
use GameOfLife\rules\StandardRule;
use Ulrichsg\Getopt;

require "vendor/autoload.php";

require_once "Getopt.php";
require_once "Board.php";

/**
 * @var BaseInput
 */
$allInputs = [];
/**
 * @var BaseOutput[] $allOutputs
 */
$allOutputs = [];
/**
 * @var BaseRule[] $allRules
 */
$allRules = [];

$currentOutput = null;
$currentRule = null;

$maxSteps = 40;
$width = 10;
$height = 10;


$options = new Getopt
([
    ["h", "help", Getopt::NO_ARGUMENT, "Shows help text."],
    ["v", "version", Getopt::NO_ARGUMENT, "Shows current version of the game."],
    [null, "width", Getopt::REQUIRED_ARGUMENT, "Allows to set the boards width manually. (HEIGHT STAYS ON DEFAULT)"],
    [null, "height", Getopt::REQUIRED_ARGUMENT, "Allows to set the boards height manually. (WIDTH STAYS ON DEFAULT)"],
    [null, "maxSteps", Getopt::REQUIRED_ARGUMENT, "Allows to set the maximum times the program should run through."],
    [null, "input", Getopt::REQUIRED_ARGUMENT, "Allows to start the game's as stats manually."],
    [null, "output", Getopt::REQUIRED_ARGUMENT, "Allows to set the output-type manually."],
    [null, "rule", Getopt::REQUIRED_ARGUMENT, "Allows to set the rule-type for the game."]
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

foreach (glob("rules/*.php") as $file)
{
    $baseName = basename($file, ".php");
    $className = "GameOfLife\\rules\\" . $baseName;
    if ($baseName == "BaseRule") continue;
    if (!class_exists($className)) continue;
    $rule = new $className;
    $allRules[$baseName] = $rule;
    $rule->addOptions($options);
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

$board = new Board($width, $height);

if ($options->getOption("input"))
{
    $argument = $options->getOption("input");
    if (isset($allInputs[$argument]))
    {
        $console = new Console();
        $allInputs[$argument]->fillBoard($board, $console, $options);
    }
}
else
{
    $console = new Console();
    $input = new Random();
    $input->fillBoard($board, $console, $options);
}

if ($options->getOption("output"))
{
    $argument = $options->getOption("output");
    $currentOutput = $allOutputs[$argument];
}
else
{
    $currentOutput = new Console();
}

if ($options->getOption("rule"))
{
    $argument = $options->getOption("rule");
    $currentRule = $allRules[$argument];
}
else
{
    $currentRule = new StandardRule();
}

$currentOutput->startOutput($options);
$gameLogic = new GameLogic($currentRule);

for ($i = 0; $i < $maxSteps; $i++)
{
    $currentOutput->outputBoard($board);
    $gameLogic->calculateNextBoard($board);
    if ($gameLogic->isLoopDetected())
        break;
}

$currentOutput->finishOutput();