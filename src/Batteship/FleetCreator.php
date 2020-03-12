<?php
declare(strict_types=1);


namespace Battleship;


class FleetCreator
{


    public function getRandomFleet(): array
    {
        return $this->returnDemo();
        switch (\random_int(1, 6)) {
            case 1:
                return $this->var1();
            case 2:
                return $this->var2();
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

    protected function var1()
    {
        $fleet = GameController::initializeShips();

        array_push($fleet[0]->getPositions(), new Position('B', 4));
        array_push($fleet[0]->getPositions(), new Position('B', 5));
        array_push($fleet[0]->getPositions(), new Position('B', 6));
        array_push($fleet[0]->getPositions(), new Position('B', 7));
        array_push($fleet[0]->getPositions(), new Position('B', 8));

        array_push($fleet[1]->getPositions(), new Position('E', 6));
        array_push($fleet[1]->getPositions(), new Position('E', 7));
        array_push($fleet[1]->getPositions(), new Position('E', 8));
        array_push($fleet[1]->getPositions(), new Position('E', 9));

        array_push($fleet[2]->getPositions(), new Position('A', 3));
        array_push($fleet[2]->getPositions(), new Position('B', 3));
        array_push($fleet[2]->getPositions(), new Position('C', 3));

        array_push($fleet[3]->getPositions(), new Position('F', 8));
        array_push($fleet[3]->getPositions(), new Position('G', 8));
        array_push($fleet[3]->getPositions(), new Position('H', 8));

        array_push($fleet[4]->getPositions(), new Position('C', 5));
        array_push($fleet[4]->getPositions(), new Position('C', 6));

        return $fleet;
    }

    protected function var2()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new Position('B', 2));
        array_push($fleet[0]->getPositions(), new Position('C', 2));
        array_push($fleet[0]->getPositions(), new Position('D', 2));
        array_push($fleet[0]->getPositions(), new Position('E', 2));
        array_push($fleet[0]->getPositions(), new Position('F', 2));
        array_push($fleet[1]->getPositions(), new Position('B', 4));
        array_push($fleet[1]->getPositions(), new Position('B', 5));
        array_push($fleet[1]->getPositions(), new Position('B', 6));
        array_push($fleet[1]->getPositions(), new Position('B', 7));
        array_push($fleet[2]->getPositions(), new Position('D', 4));
        array_push($fleet[2]->getPositions(), new Position('E', 4));
        array_push($fleet[2]->getPositions(), new Position('F', 4));
        array_push($fleet[3]->getPositions(), new Position('D', 7));
        array_push($fleet[3]->getPositions(), new Position('E', 7));
        array_push($fleet[3]->getPositions(), new Position('F', 8));
        array_push($fleet[4]->getPositions(), new Position('H', 5));
        array_push($fleet[4]->getPositions(), new Position('H', 6));
        return $fleet;
    }

    protected function var3()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new Position('A', 1));
        array_push($fleet[0]->getPositions(), new Position('A', 2));
        array_push($fleet[0]->getPositions(), new Position('A', 3));
        array_push($fleet[0]->getPositions(), new Position('A', 4));
        array_push($fleet[0]->getPositions(), new Position('A', 5));
        array_push($fleet[1]->getPositions(), new Position('C', 1));
        array_push($fleet[1]->getPositions(), new Position('D', 2));
        array_push($fleet[1]->getPositions(), new Position('E', 3));
        array_push($fleet[1]->getPositions(), new Position('F', 4));
        array_push($fleet[2]->getPositions(), new Position('E', 5));
        array_push($fleet[2]->getPositions(), new Position('E', 6));
        array_push($fleet[2]->getPositions(), new Position('E', 7));
        array_push($fleet[3]->getPositions(), new Position('G', 4));
        array_push($fleet[3]->getPositions(), new Position('G', 5));
        array_push($fleet[3]->getPositions(), new Position('G', 6));
        array_push($fleet[4]->getPositions(), new Position('C', 5));
        array_push($fleet[4]->getPositions(), new Position('C', 6));
        return $fleet;
    }

    protected function var4()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new Position('C', 6));
        array_push($fleet[0]->getPositions(), new Position('D', 6));
        array_push($fleet[0]->getPositions(), new Position('E', 6));
        array_push($fleet[0]->getPositions(), new Position('F', 6));
        array_push($fleet[0]->getPositions(), new Position('G', 6));
        array_push($fleet[1]->getPositions(), new Position('A', 3));
        array_push($fleet[1]->getPositions(), new Position('A', 4));
        array_push($fleet[1]->getPositions(), new Position('A', 5));
        array_push($fleet[1]->getPositions(), new Position('A', 6));
        array_push($fleet[2]->getPositions(), new Position('D', 4));
        array_push($fleet[2]->getPositions(), new Position('E', 4));
        array_push($fleet[2]->getPositions(), new Position('F', 4));
        array_push($fleet[3]->getPositions(), new Position('H', 2));
        array_push($fleet[3]->getPositions(), new Position('H', 3));
        array_push($fleet[3]->getPositions(), new Position('H', 4));
        array_push($fleet[4]->getPositions(), new Position('D', 2));
        array_push($fleet[4]->getPositions(), new Position('E', 2));
        return $fleet;
    }

    protected function var5()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new Position('B', 8));
        array_push($fleet[0]->getPositions(), new Position('C', 8));
        array_push($fleet[0]->getPositions(), new Position('D', 8));
        array_push($fleet[0]->getPositions(), new Position('E', 8));
        array_push($fleet[0]->getPositions(), new Position('F', 8));
        array_push($fleet[1]->getPositions(), new Position('D', 3));
        array_push($fleet[1]->getPositions(), new Position('D', 4));
        array_push($fleet[1]->getPositions(), new Position('D', 5));
        array_push($fleet[1]->getPositions(), new Position('D', 6));
        array_push($fleet[2]->getPositions(), new Position('B', 4));
        array_push($fleet[2]->getPositions(), new Position('B', 5));
        array_push($fleet[2]->getPositions(), new Position('B', 6));
        array_push($fleet[3]->getPositions(), new Position('F', 2));
        array_push($fleet[3]->getPositions(), new Position('F', 3));
        array_push($fleet[3]->getPositions(), new Position('F', 4));
        array_push($fleet[4]->getPositions(), new Position('B', 1));
        array_push($fleet[4]->getPositions(), new Position('C', 1));
        return $fleet;
    }

    protected function var6()
    {
        $fleet = GameController::initializeShips();
        array_push($fleet[0]->getPositions(), new Position('B', 6));
        array_push($fleet[0]->getPositions(), new Position('C', 6));
        array_push($fleet[0]->getPositions(), new Position('D', 6));
        array_push($fleet[0]->getPositions(), new Position('E', 6));
        array_push($fleet[0]->getPositions(), new Position('F', 6));
        array_push($fleet[1]->getPositions(), new Position('A', 1));
        array_push($fleet[1]->getPositions(), new Position('A', 2));
        array_push($fleet[1]->getPositions(), new Position('A', 3));
        array_push($fleet[1]->getPositions(), new Position('A', 4));
        array_push($fleet[2]->getPositions(), new Position('D', 2));
        array_push($fleet[2]->getPositions(), new Position('D', 3));
        array_push($fleet[2]->getPositions(), new Position('D', 4));
        array_push($fleet[3]->getPositions(), new Position('F', 4));
        array_push($fleet[3]->getPositions(), new Position('G', 4));
        array_push($fleet[3]->getPositions(), new Position('H', 4));
        array_push($fleet[4]->getPositions(), new Position('E', 8));
        array_push($fleet[4]->getPositions(), new Position('F', 8));
        return $fleet;
    }

    private function returnDemo()
    {
        $ship = new Ship("TEST", 1, Color::ORANGE);
        array_push($ship->getPositions(), new Position('A', 1));
        return [$ship];
    }


}