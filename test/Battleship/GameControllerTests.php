<?php


namespace App\Tests\Battleship;

use PSD\Battleship\GameController;
use PSD\Battleship\Letter;
use PSD\Battleship\PositionNew;
use PSD\Battleship\Ship;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TypeError;

//use PHPUnit\Util\Exception;

final class GameControllerTests extends TestCase
{
    public function testCheckIsHitTrue()
    {
        $ships = GameController::initializeShips();
        $counter = 0;

        foreach ($ships as $ship) {
            $letter = Letter::$letters[$counter];

            for ($i = 0; $i < $ship->getSize(); $i++) {
                array_push($ship->getPositions(), new PositionNew($letter, $i));
            }

            $counter++;
        }

        $result = GameController::checkIsHit($ships, new PositionNew('A', 1));

        $this->assertTrue($result);
    }

    public function testCheckIsHitFalse()
    {
        $ships = GameController::initializeShips();
        $counter = 0;

        foreach ($ships as $ship) {
            $letter = Letter::$letters[$counter];

            for ($i = 0; $i < $ship->getSize(); $i++) {
                array_push($ship->getPositions(), new PositionNew($letter, $i));
            }

            $counter++;
        }

        $result = GameController::checkIsHit($ships, new PositionNew('H', 1));

        $this->assertFalse($result);
    }

    public function testCheckIsHitPositstionIsNull()
    {
        $this->expectException(InvalidArgumentException::class);
        GameController::checkIsHit(GameController::initializeShips(), null);
    }

    public function testCheckIsHitShipIsNull()
    {
        $this->expectException(TypeError::class);
        GameController::checkIsHit(null, new PositionNew('H', 1));
    }

    public function testIsShipValidFalse()
    {
        $ship = new Ship("TestShip", 3);
        $result = GameController::isShipValid($ship);

        $this->assertFalse($result);
    }

    public function testIsShipValidTrue()
    {
        $positions = array(new PositionNew('A', 1), new PositionNew('A', 1), new PositionNew('A', 1));
        $ship = new Ship("TestShip", 3);
        foreach ($positions as $position) {
            array_push($ship->getPositions(), $position);
        }

        $result = GameController::isShipValid($ship);

        $this->assertTrue($result);
    }
}