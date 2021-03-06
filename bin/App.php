<?php

use PSD\Battleship\PositionNew;
use PSD\Battleship\GameController;
use PSD\Battleship\Letter;
use PSD\Battleship\Color;
use PSD\Battleship\Ship;
use PSD\Battleship\TextPrinter;
use PSD\Console;

class App
{
    private static $myFleet = [];
    /** @var Ship[] */
    private static $enemyFleet = [];
    /** @var Console */
    private static $console;
    /** @var TextPrinter */
    private static $textPrinter;

    /** @var PositionNew[] */
    protected $myHistory = [];
    /** @var PositionNew[] */
    protected $enemyHistory = [];

    static function run()
    {
        self::$console = new Console();
        self::$textPrinter = new TextPrinter();

        self::$textPrinter->drawShip();
        self::InitializeGame();
        self::StartGame();
    }

    public static function InitializeEnemyFleet()
    {
        $creator = new \PSD\Battleship\FleetCreator();
        self::$enemyFleet = $creator->getRandomFleet();
    }

    public static function InitializeComputerPhraseHit()
    {
        $creator = new \PSD\Battleship\FleetCreator();
        return $creator->getRandomComputerPhraseHit();
    }
    public static function InitializeComputerPhraseMiss()
    {
        $creator = new \PSD\Battleship\FleetCreator();
        return $creator->getRandomComputerPhraseMiss();
    }

    public static function getRandomPosition()
    {
        $rows = 8;
        $lines = 8;

        $letter = Letter::value(random_int(0, $lines - 1));
        $number = random_int(0, $rows - 1);

        return new PositionNew($letter, $number);
    }

    public static function InitializeMyFleet()
    {
        self::$myFleet = GameController::initializeShips();

        self::$console->println("Please position your fleet (Game board has size from A to H and 1 to 8) :", false);

        /** @var Ship $ship */
        foreach (self::$myFleet as $ship) {

            self::$console->println();
            printf("Please enter the positions for the %s (size: %s)", $ship->getName(), $ship->getSize());
            while (true) {
                self::$console->println(Color::YELLOW);
                printf("\nEnter position and direction (i.e A3R, A3L, A3U, A3D):");
                self::$console->println(Color::DEFAULT_GREY);
                $input = readline("");
                try {
                    $ship->createPositions($input);
                    break;
                } catch (\Exception $e) {
                    printf(Color::RED);
                    printf("Incorrect input, pls try again!");
                    printf(Color::DEFAULT_GREY);
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
                if ($ship->getStatus() === Ship::OK) {
                    echo Color::CHARTREUSE;
                    echo "{$ship->getName()} - Alive\n";
                }
                if ($ship->getStatus() === Ship::ERROR) {
                    echo Color::RED;
                    echo "{$ship->getName()} - Killed\n";
                }
            }
            echo Color::DEFAULT_GREY;

            while(true) {
                self::$console->println(Color::YELLOW);
                self::$console->println("Enter coordinates for your shot:");
                printf(Color::DEFAULT_GREY);
                $position = readline("");

                if ($position === 'sw') {
                    system('clear; telnet towel.blinkenlights.nl');
                }

                try {
                    $isHit = GameController::checkIsHit(self::$enemyFleet, self::parsePosition($position));
                    break;
                } catch (\Exception $e) {
                    printf(Color::RED);
                    printf("Incorrect input, pls try again!");
                    printf(Color::DEFAULT_GREY);
                }
            }

            if ($isHit) {
                self::$console->println(Color::RED);
                static::hit();
                echo "Yeah ! Nice hit !";
                self::$console->say(self::InitializeComputerPhraseHit());

                self::$console->println(Color::DEFAULT_GREY);
            } else {
                self::$console->println(Color::CADET_BLUE);
                echo "Miss";
                self::$console->say(self::InitializeComputerPhraseMiss());
                self::$console->println(Color::DEFAULT_GREY);
            }

            if(static::checkFinish(static::$enemyFleet)) {
                self::$textPrinter->drawWin();
                exit();
            }

            self::$console->println();
            usleep(100000);
            static::step('Computer', Color::YELLOW);
            $position = self::getRandomPosition();
            $isHit = GameController::checkIsHit(self::$myFleet, $position);

            if ($isHit) {
                self::$console->println(Color::RED);
                static::hit();
                echo "Oooops! Computer hit you!";
                self::$console->println(Color::DEFAULT_GREY);
            } else {
                self::$console->println(Color::CADET_BLUE);
                echo "Yeah! Computer miss";
                self::$console->println(Color::DEFAULT_GREY);
            }

            self::$console->println();
            printf("Computer shoot in %s%s and %s", $position->getColumn(), $position->getRow(), $isHit ? "hit your ship !\n" : "miss\n");

            if(static::checkFinish(static::$myFleet)) {
                self::$textPrinter->drawLose();
                exit();
            }
            usleep(100000);
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
            throw new \Exception("Not a valid number!");
        }

        return new PositionNew($letter, $number);
    }

    static protected function hit()
    {
        self::beep();
        self::$textPrinter->drawBoom();
    }

    static protected function step(string $who, string $color)
    {
        $default = Color::DEFAULT_GREY;
        $magenta = Color::MAGENTA;
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
            if ($ship->getStatus() !== Ship::ERROR) {
                $end = false;
            }
        }

        return $end;
    }
}