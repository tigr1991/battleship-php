<?php

use Battleship\GameController;
use Battleship\Position;
use Battleship\Letter;
use Battleship\Color;

class App
{
    private static $myFleet = array();
    /** @var \Battleship\Ship[] */
    private static $enemyFleet = array();
    private static $console;

    static function run()
    {
        self::$console = new Console();
        self::$console->setForegroundColor(Color::MAGENTA);

        self::$console->println("                                     |__");
        self::$console->println("                                     |\\/");
        self::$console->println("                                     ---");
        self::$console->println("                                     / | [");
        self::$console->println("                              !      | |||");
        self::$console->println("                            _/|     _/|-++'");
        self::$console->println("                        +  +--|    |--|--|_ |-");
        self::$console->println("                     { /|__|  |/\\__|  |--- |||__/");
        self::$console->println("                    +---------------___[}-_===_.'____                 /\\");
        self::$console->println("                ____`-' ||___-{]_| _[}-  |     |_[___\\==--            \\/   _");
        self::$console->println(" __..._____--==/___]_|__|_____________________________[___\\==--____,------' .7");
        self::$console->println("|                        Welcome to Battleship                         BB-61/");
        self::$console->println(" \\_________________________________________________________________________|");
        self::$console->println();
        self::$console->resetForegroundColor();
        self::InitializeGame();
        self::StartGame();
    }

    public static function InitializeEnemyFleet()
    {
        self::$enemyFleet = GameController::initializeShips();

        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 4));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 5));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 6));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 7));
        array_push(self::$enemyFleet[0]->getPositions(), new Position('B', 8));

        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 6));
        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 7));
        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 8));
        array_push(self::$enemyFleet[1]->getPositions(), new Position('E', 9));

        array_push(self::$enemyFleet[2]->getPositions(), new Position('A', 3));
        array_push(self::$enemyFleet[2]->getPositions(), new Position('B', 3));
        array_push(self::$enemyFleet[2]->getPositions(), new Position('C', 3));

        array_push(self::$enemyFleet[3]->getPositions(), new Position('F', 8));
        array_push(self::$enemyFleet[3]->getPositions(), new Position('G', 8));
        array_push(self::$enemyFleet[3]->getPositions(), new Position('H', 8));

        array_push(self::$enemyFleet[4]->getPositions(), new Position('C', 5));
        array_push(self::$enemyFleet[4]->getPositions(), new Position('C', 6));
    }

    public static function getRandomPosition()
    {
        $rows = 8;
        $lines = 8;

        $letter = Letter::value(random_int(0, $lines - 1));
        $number = random_int(0, $rows - 1);

        return new Position($letter, $number);
    }

    public static function InitializeMyFleet()
    {
        self::$myFleet = GameController::initializeShips();

        self::$console->println("Please position your fleet (Game board has size from A to H and 1 to 8) :");

        foreach (self::$myFleet as $ship) {

            self::$console->println();
            printf("Please enter the positions for the %s (size: %s)", $ship->getName(), $ship->getSize());
break;
            for ($i = 1; $i <= $ship->getSize(); $i++) {
                printf("\nEnter position %s of %s (i.e A3):", $i, $ship->getSize());
                $input = readline("");
                $ship->addPosition($input);
            }
        }
    }

    public static function beep()
    {
        echo "\007";
    }

    public static function InitializeGame()
    {
        self::InitializeMyFleet();
        self::InitializeEnemyFleet();
    }

    public static function StartGame()
    {

        self::$console->println("\033[2J\033[;H");
        self::$console->println("                  __");
        self::$console->println("                 /  \\");
        self::$console->println("           .-.  |    |");
        self::$console->println("   *    _.-'  \\  \\__/");
        self::$console->println("    \\.-'       \\");
        self::$console->println("   /          _/");
        self::$console->println("  |      _  /\" \"");
        self::$console->println("  |     /_\'");
        self::$console->println("   \\    \\_/");
        self::$console->println("    \" \"\" \"\" \"\" \"");

        $step = 1;
        while (true) {
            self::$console->println("\n\n\n==========================================================================================");
            self::$console->println("==========================================================================================");

            static::step($step, 'You', Color::YELLOW);
            self::$console->println("Player, it's your turn");
            self::$console->println("Enter coordinates for your shot :");
            $position = readline("");

            $isHit = GameController::checkIsHit(self::$enemyFleet, self::parsePosition($position));
            if ($isHit) {
                self::$console->println(\Battleship\Color::RED);
                static::hit();
                echo "Yeah ! Nice hit !";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            } else {
                self::$console->println(\Battleship\Color::CADET_BLUE);
                static::hit();
                echo "Miss";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            }

            self::$console->println();

            static::step($step, 'Computer', Color::YELLOW);
            $position = self::getRandomPosition();
            $isHit = GameController::checkIsHit(self::$myFleet, $position);

            if ($isHit) {
                self::$console->println(\Battleship\Color::RED);
                static::hit();
                echo "Oooop! Computer hit you!";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            } else {
                self::$console->println(\Battleship\Color::CADET_BLUE);
                static::hit();
                echo "Yeah! Computer miss";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            }

            self::$console->println();
            printf("Computer shoot in %s%s and %s", $position->getColumn(), $position->getRow(), $isHit ? "hit your ship !\n" : "miss\n");
            if ($isHit) {
                self::$console->println(\Battleship\Color::RED);
                static::hit();
                echo "Yeah ! Nice hit !";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            }


            $step++;
//            exit();
        }
    }

    public static function parsePosition($input)
    {
        $letter = substr($input, 0, 1);
        $number = substr($input, 1, 1);

        if(!is_numeric($number)) {
            throw new Exception("Not a number: $number");
        }

        return new Position($letter, $number);
    }

    static protected function hit()
    {
        self::beep();
        self::$console->println("                \\         .  ./");
        self::$console->println("              \\      .:\" \";'.:..\" \"   /");
        self::$console->println("                  (M^^.^~~:.'\" \").");
        self::$console->println("            -   (/  .    . . \\ \\)  -");
        self::$console->println("               ((| :. ~ ^  :. .|))");
        self::$console->println("            -   (\\- |  \\ /  |  /)  -");
        self::$console->println("                 -\\  \\     /  /-");
        self::$console->println("                   \\  \\   /  /");
    }

    static protected function step(int $step, string $who, string $color)
    {
        $default = \Battleship\Color::DEFAULT_GREY;
        $magenta = \Battleship\Color::MAGENTA;
        self::$console->println($magenta);
        self::$console->println("\n\n-------------------------------");
        self::$console->println("Step №{$step} {$color}({$who}){$magenta}");
        self::$console->println("-------------------------------");
        self::$console->println($default);
    }
}