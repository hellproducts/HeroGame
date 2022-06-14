<?php

namespace App\Emagia\Tests;

use App\Emagia\Character\Beast;
use App\Emagia\Character\Orderus;
use App\Emagia\Exception\MissingGameConfigException;
use App\Emagia\Game;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class GameTest extends TestCase
{
    private Game $game;

    public function setUp(): void
    {
        $this->game = new Game(['rounds' => 10]);
    }

    public function testBeastWillDrawFirstBlood()
    {
        $orderus = (new Orderus())
        ->setHealth(100)
        ->setDefence(53)
        ->setLuck(25)
        ->setSpeed(45)
        ->setStrength(80);

        $beast = (new Beast())
        ->setHealth(95)
        ->setDefence(59)
        ->setLuck(35)
        ->setSpeed(56)
        ->setStrength(90);

        $result = $this->callPrivateMethod(
            $this->game,
            'determineFirstBlood',
            [$orderus, $beast]
        );
        $this->assertInstanceOf(Beast::class, $result[0]);
    }

    public function testItThrowsAnExceptionIfRoundsAreNotDefined(): void
    {
        $this->expectException(MissingGameConfigException::class);

        $this->game = new Game([]);
    }

    public function callPrivateMethod($object, string $methodName, array $params = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $params);
    }
}
