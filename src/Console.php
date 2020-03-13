<?php

namespace PSD;
//use Battleship\Color;

class Console
{
    function resetForegroundColor()
    {
        echo(Battleship\Color::DEFAULT_GREY);
    }

    function setForegroundColor($color)
    {
        echo($color);
    }

    function println($line = "", bool $withVoice = false)
    {
        echo "$line\n";
        if ($withVoice) {
            system("say \"{$line}\"");
        }
    }

    function say($line)
    {
        system("say \"{$line}\"");
    }
}