<?php
declare(strict_types=1);


namespace Battleship;


class FleetCreator
{



    public function getRandomFleet(): array
    {
        switch (\random_int(1,5)) {
            case 1:
                return $this->var1();
            case 2:
                return $this->var1();
            case 3:
                return $this->var1();
            case 4:
                return $this->var1();
            case 5:
                return $this->var1();
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

    }

    protected function var3()
    {

    }

    protected function var4()
    {

    }

    protected function var5()
    {

    }


}