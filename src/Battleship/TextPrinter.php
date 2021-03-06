<?php
declare(strict_types=1);

namespace PSD\Battleship;

class TextPrinter
{
    private $console;

    public function __construct()
    {
        $this->console = new \PSD\Console();
    }

    public function drawCanon()
    {
        $this->console->println("\033[2J\033[;H");
        $this->console->println("                  __");
        $this->console->println("                 /  \\");
        $this->console->println("           .-.  |    |");
        $this->console->println("   *    _.-'  \\  \\__/");
        $this->console->println("    \\.-'       \\");
        $this->console->println("   /          _/");
        $this->console->println("  |      _  /\" \"");
        $this->console->println("  |     /_\'");
        $this->console->println("   \\    \\_/");
        $this->console->println("    \" \"\" \"\" \"\" \"");
    }

    public function drawShip()
    {
        $this->console->setForegroundColor(Color::MAGENTA);

        $this->console->println("                                     |__");
        $this->console->println("                                     |\\/");
        $this->console->println("                                     ---");
        $this->console->println("                                     / | [");
        $this->console->println("                              !      | |||");
        $this->console->println("                            _/|     _/|-++'");
        $this->console->println("                        +  +--|    |--|--|_ |-");
        $this->console->println("                     { /|__|  |/\\__|  |--- |||__/");
        $this->console->println("                    +---------------___[}-_===_.'____                 /\\");
        $this->console->println("                ____`-' ||___-{]_| _[}-  |     |_[___\\==--            \\/   _");
        $this->console->println(" __..._____--==/___]_|__|_____________________________[___\\==--____,------' .7");
        $this->console->println("|                        Welcome to Battleship                         BB-61/");
        $this->console->println(" \\_________________________________________________________________________|");
        $this->console->println();
        $this->console->resetForegroundColor();
    }

    public function drawBoom()
    {
        $this->console->println("                \\         .  ./");
        $this->console->println("              \\      .:\" \";'.:..\" \"   /");
        $this->console->println("                  (M^^.^~~:.'\" \").");
        $this->console->println("            -   (/  .    . . \\ \\)  -");
        $this->console->println("               ((| :. ~ ^  :. .|))");
        $this->console->println("            -   (\\- |  \\ /  |  /)  -");
        $this->console->println("                 -\\  \\     /  /-");
        $this->console->println("                   \\  \\   /  /");
    }

    public function drawWin()
    {
        $this->console->println("");
        $this->console->println("");
        $this->console->println("██╗   ██╗ ██████╗ ██╗   ██╗    ██╗    ██╗██╗███╗   ██╗██╗");
        $this->console->println("╚██╗ ██╔╝██╔═══██╗██║   ██║    ██║    ██║██║████╗  ██║██║");
        $this->console->println(" ╚████╔╝ ██║   ██║██║   ██║    ██║ █╗ ██║██║██╔██╗ ██║██║");
        $this->console->println("  ╚██╔╝  ██║   ██║██║   ██║    ██║███╗██║██║██║╚██╗██║╚═╝");
        $this->console->println("   ██║   ╚██████╔╝╚██████╔╝    ╚███╔███╔╝██║██║ ╚████║██╗");
        $this->console->println("   ╚═╝    ╚═════╝  ╚═════╝      ╚══╝╚══╝ ╚═╝╚═╝  ╚═══╝╚═╝");
        $this->console->println("");
        $this->console->say("You win! Congratulations!");
    }

    public function drawLose()
    {
        $this->console->println("");
        $this->console->println("");
        $this->console->println("██╗   ██╗ ██████╗ ██╗   ██╗    ██╗      ██████╗ ███████╗███████╗██╗");
        $this->console->println("╚██╗ ██╔╝██╔═══██╗██║   ██║    ██║     ██╔═══██╗██╔════╝██╔════╝██║");
        $this->console->println(" ╚████╔╝ ██║   ██║██║   ██║    ██║     ██║   ██║███████╗█████╗  ██║");
        $this->console->println("  ╚██╔╝  ██║   ██║██║   ██║    ██║     ██║   ██║╚════██║██╔══╝  ╚═╝");
        $this->console->println("   ██║   ╚██████╔╝╚██████╔╝    ███████╗╚██████╔╝███████║███████╗██╗");
        $this->console->println("   ╚═╝    ╚═════╝  ╚═════╝     ╚══════╝ ╚═════╝ ╚══════╝╚══════╝╚═╝");
        $this->console->println("");
        $this->console->say("You lose! Ha ha ha");
    }

}