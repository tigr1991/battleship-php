<?php

declare(strict_types=1);

namespace PSD\Battleship;

class FleetCreator
{


    public function getRandomFleet(): array
    {
//        return $this->returnDemo();
        switch (\random_int(1, 6)) {
            case 1:
                return $this->var1();
            case 2:
//                return $this->var2();
            case 3:
                return $this->var3();
            case 4:
                return $this->var4();
            case 5:
                return $this->var5();
            case 6:
                return $this->var6();
        }
    }
    public function getRandomComputerPhraseMiss(): string
    {
        switch (\random_int(1, 9)) {
            case 1:
            case 7:
            case 8:
            case 9:
                return 'Лошара';
            case 2:
                return 'Loser';
            case 3:
                return 'Ha-ha';
            case 4:
                return 'Лох';
            case 5:
                return 'Cry';
            case 6:
                return 'Miss';
        }
    }
    public function getRandomComputerPhraseHit(): string
    {
        switch (\random_int(1, 6)) {
            case 1:
                return 'Shit';
            case 2:
                return 'Nooo';
            case 3:
                return 'No please';
            case 4:
                return 'Pain';
            case 5:
                return 'Monster';
            case 6:
                return 'Ouche';
        }
    }

    protected function var1()
    {
        $fleet = GameController::initializeShips();

        array_push($fleet[0]->getPositions(), new PositionNew('B', 4));
        array_push($fleet[0]->getPositions(), new PositionNew('B', 5));
        array_push($fleet[0]->getPositions(), new PositionNew('B', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('B', 7));
        array_push($fleet[0]->getPositions(), new PositionNew('B', 8));

        array_push($fleet[1]->getPositions(), new PositionNew('E', 6));
        array_push($fleet[1]->getPositions(), new PositionNew('E', 7));
        array_push($fleet[1]->getPositions(), new PositionNew('E', 8));
        array_push($fleet[1]->getPositions(), new PositionNew('E', 9));

        array_push($fleet[2]->getPositions(), new PositionNew('A', 3));
        array_push($fleet[2]->getPositions(), new PositionNew('B', 3));
        array_push($fleet[2]->getPositions(), new PositionNew('C', 3));

        array_push($fleet[3]->getPositions(), new PositionNew('F', 8));
        array_push($fleet[3]->getPositions(), new PositionNew('G', 8));
        array_push($fleet[3]->getPositions(), new PositionNew('H', 8));

        array_push($fleet[4]->getPositions(), new PositionNew('C', 5));
        array_push($fleet[4]->getPositions(), new PositionNew('C', 6));

        return $fleet;
    }

    protected function var2()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new PositionNew('B', 2));
        array_push($fleet[0]->getPositions(), new PositionNew('C', 2));
        array_push($fleet[0]->getPositions(), new PositionNew('D', 2));
        array_push($fleet[0]->getPositions(), new PositionNew('E', 2));
        array_push($fleet[0]->getPositions(), new PositionNew('F', 2));
        array_push($fleet[1]->getPositions(), new PositionNew('B', 4));
        array_push($fleet[1]->getPositions(), new PositionNew('B', 5));
        array_push($fleet[1]->getPositions(), new PositionNew('B', 6));
        array_push($fleet[1]->getPositions(), new PositionNew('B', 7));
        array_push($fleet[2]->getPositions(), new PositionNew('D', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('E', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('F', 4));
        array_push($fleet[3]->getPositions(), new PositionNew('D', 7));
        array_push($fleet[3]->getPositions(), new PositionNew('E', 7));
        array_push($fleet[3]->getPositions(), new PositionNew('F', 8));
        array_push($fleet[4]->getPositions(), new PositionNew('H', 5));
        array_push($fleet[4]->getPositions(), new PositionNew('H', 6));
        return $fleet;
    }

    protected function var3()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new PositionNew('A', 1));
        array_push($fleet[0]->getPositions(), new PositionNew('A', 2));
        array_push($fleet[0]->getPositions(), new PositionNew('A', 3));
        array_push($fleet[0]->getPositions(), new PositionNew('A', 4));
        array_push($fleet[0]->getPositions(), new PositionNew('A', 5));
        array_push($fleet[1]->getPositions(), new PositionNew('C', 1));
        array_push($fleet[1]->getPositions(), new PositionNew('D', 2));
        array_push($fleet[1]->getPositions(), new PositionNew('E', 3));
        array_push($fleet[1]->getPositions(), new PositionNew('F', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('E', 5));
        array_push($fleet[2]->getPositions(), new PositionNew('E', 6));
        array_push($fleet[2]->getPositions(), new PositionNew('E', 7));
        array_push($fleet[3]->getPositions(), new PositionNew('G', 4));
        array_push($fleet[3]->getPositions(), new PositionNew('G', 5));
        array_push($fleet[3]->getPositions(), new PositionNew('G', 6));
        array_push($fleet[4]->getPositions(), new PositionNew('C', 5));
        array_push($fleet[4]->getPositions(), new PositionNew('C', 6));
        return $fleet;
    }

    protected function var4()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new PositionNew('C', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('D', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('E', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('F', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('G', 6));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 3));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 4));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 5));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 6));
        array_push($fleet[2]->getPositions(), new PositionNew('D', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('E', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('F', 4));
        array_push($fleet[3]->getPositions(), new PositionNew('H', 2));
        array_push($fleet[3]->getPositions(), new PositionNew('H', 3));
        array_push($fleet[3]->getPositions(), new PositionNew('H', 4));
        array_push($fleet[4]->getPositions(), new PositionNew('D', 2));
        array_push($fleet[4]->getPositions(), new PositionNew('E', 2));
        return $fleet;
    }

    protected function var5()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new PositionNew('B', 8));
        array_push($fleet[0]->getPositions(), new PositionNew('C', 8));
        array_push($fleet[0]->getPositions(), new PositionNew('D', 8));
        array_push($fleet[0]->getPositions(), new PositionNew('E', 8));
        array_push($fleet[0]->getPositions(), new PositionNew('F', 8));
        array_push($fleet[1]->getPositions(), new PositionNew('D', 3));
        array_push($fleet[1]->getPositions(), new PositionNew('D', 4));
        array_push($fleet[1]->getPositions(), new PositionNew('D', 5));
        array_push($fleet[1]->getPositions(), new PositionNew('D', 6));
        array_push($fleet[2]->getPositions(), new PositionNew('B', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('B', 5));
        array_push($fleet[2]->getPositions(), new PositionNew('B', 6));
        array_push($fleet[3]->getPositions(), new PositionNew('F', 2));
        array_push($fleet[3]->getPositions(), new PositionNew('F', 3));
        array_push($fleet[3]->getPositions(), new PositionNew('F', 4));
        array_push($fleet[4]->getPositions(), new PositionNew('B', 1));
        array_push($fleet[4]->getPositions(), new PositionNew('C', 1));
        return $fleet;
    }

    protected function var6()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new PositionNew('B', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('C', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('D', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('E', 6));
        array_push($fleet[0]->getPositions(), new PositionNew('F', 6));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 1));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 2));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 3));
        array_push($fleet[1]->getPositions(), new PositionNew('A', 4));
        array_push($fleet[2]->getPositions(), new PositionNew('D', 2));
        array_push($fleet[2]->getPositions(), new PositionNew('D', 3));
        array_push($fleet[2]->getPositions(), new PositionNew('D', 4));
        array_push($fleet[3]->getPositions(), new PositionNew('F', 4));
        array_push($fleet[3]->getPositions(), new PositionNew('G', 4));
        array_push($fleet[3]->getPositions(), new PositionNew('H', 4));
        array_push($fleet[4]->getPositions(), new PositionNew('E', 8));
        array_push($fleet[4]->getPositions(), new PositionNew('F', 8));
        return $fleet;
    }

    private function returnDemo()
    {
        $ship = new Ship("TEST", 1, Color::ORANGE);
        array_push($ship->getPositions(), new PositionNew('A', 1));
        return [$ship];
    }
}
