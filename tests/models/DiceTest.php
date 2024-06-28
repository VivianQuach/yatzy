<?php
namespace Yatzy\Test;

use Yatzy\Dice;
use PHPUnit\Framework\TestCase;

/*class DiceTest extends TestCase
{

    public function testConstructor()
    {
        $d = new Dice();
        $this->assertEquals(1, $d->min);
        $this->assertEquals(6, $d->max);

        $d = new Dice(10, 20);
        $this->assertEquals(10, $d->min);
        $this->assertEquals(20, $d->max);
    }
}*/
switch ($_GET["action"] ?? "version") {
case "roll":
    $d = new Dice();
    $data = ["value" => $d->roll()];
    break;
case "version":
default:
    $data = ["version" => "1.0"];
}

header("Content-Type: application/json");
echo json_encode($data);