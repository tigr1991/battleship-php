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
    /** @var \Battleship\TextPrinter */
    private static $textPrinter;

    /** @var Position[] */
    protected $myHistory = [];
    /** @var Position[] */
    protected $enemyHistory = [];

    static function run()
    {
        self::$console = new \Console();
        self::$textPrinter = new \Battleship\TextPrinter();

        self::$textPrinter->drawShip();
        self::InitializeGame();
        self::StartGame();
    }

    public static function InitializeEnemyFleet()
    {
        $creator = new \Battleship\FleetCreator();
        self::$enemyFleet = $creator->getRandomFleet();
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

        /** @var \Battleship\Ship $ship */
        foreach (self::$myFleet as $ship) {

            self::$console->println();
            printf("Please enter the positions for the %s (size: %s)", $ship->getName(), $ship->getSize());
            for ($i = 1; $i <= $ship->getSize(); $i++) {
                while(true) {
                    self::$console->println(\Battleship\Color::YELLOW);
                    printf("\nEnter position %s of %s (i.e A3):", $i, $ship->getSize());
                    self::$console->println(\Battleship\Color::DEFAULT_GREY);
                    $input = readline("");
                    try {
                        $ship->addPosition($input);
                        break;
                    } catch (Exception $e) {
                        printf(\Battleship\Color::RED);
                        printf("Incorrect input, pls try again!");
                        printf(\Battleship\Color::DEFAULT_GREY);
                    }
                }
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
            self::$console->println("----------------------------------------- Step №{$step} ----------------------------------------");
            self::$console->println("==========================================================================================");

            static::step('You', Color::YELLOW);
            self::$console->println("Player, it's your turn");

            self::$console->println("Enemy fleet status:");
            foreach (self::$enemyFleet as $ship) {
                if ($ship->getStatus() === \Battleship\Ship::OK) {
                    echo Color::CHARTREUSE;
                    echo "{$ship->getName()} - Alive\n";
                }
                if ($ship->getStatus() === \Battleship\Ship::ERROR) {
                    echo Color::RED;
                    echo "{$ship->getName()} - Killed\n";
                }
            }
            echo Color::DEFAULT_GREY;

            while(true) {
                self::$console->println(\Battleship\Color::YELLOW);
                self::$console->println("Enter coordinates for your shot:");
                printf(\Battleship\Color::DEFAULT_GREY);
                $position = readline("");
                try {
                    $isHit = GameController::checkIsHit(self::$enemyFleet, self::parsePosition($position));
                    break;
                } catch (Exception $e) {
                    printf(\Battleship\Color::RED);
                    printf("Incorrect input, pls try again!");
                    printf(\Battleship\Color::DEFAULT_GREY);
                }
            }

            if ($isHit) {
                self::$console->println(\Battleship\Color::RED);
                static::hit();
                echo "Yeah ! Nice hit !";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            } else {
                self::$console->println(\Battleship\Color::CADET_BLUE);
                echo "Miss";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            }

            if(static::checkFinish(static::$enemyFleet)) {
                self::$textPrinter->drawWin();
                exit();
            }

            self::$console->println();

            static::step('Computer', Color::YELLOW);
            $position = self::getRandomPosition();
            $isHit = GameController::checkIsHit(self::$myFleet, $position);

            if ($isHit) {
                self::$console->println(\Battleship\Color::RED);
                static::hit();
                echo "Oooops! Computer hit you!";
                self::$console->println(\Battleship\Color::DEFAULT_GREY);
            } else {
                self::$console->println(\Battleship\Color::CADET_BLUE);
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


            if(static::checkFinish(static::$myFleet)) {
                self::$textPrinter->drawLose();
                exit();
            }

            $step++;
//            exit();
            self::$console->println("\n\n\n==========================================================================================");
            self::$console->println("==========================================================================================");

        }
    }

    public static function parsePosition($input)
    {
        $letter = substr($input, 0, 1);
        $number = substr($input, 1, 1);

        if(strlen($input) !== 2) {
            throw new Exception("Not a valid number!");
        }

        return new Position($letter, $number);
    }

    static protected function hit()
    {
        self::beep();
        self::$textPrinter->drawBoom();
    }

    static protected function step(string $who, string $color)
    {
        $default = \Battleship\Color::DEFAULT_GREY;
        $magenta = \Battleship\Color::MAGENTA;
        printf($magenta);
        self::$console->println("\n\n-------------------------------");
        self::$console->println("Step by {$color}({$who}){$magenta}");
        self::$console->println("-------------------------------");
        printf($default);
    }

    static protected function checkFinish($ships)
    {
        $end = true;
        foreach ($ships as $ship) {
            if ($ship->getStatus() !== \Battleship\Ship::ERROR) {
                $end = false;
            }
        }

        return $end;
    }
}