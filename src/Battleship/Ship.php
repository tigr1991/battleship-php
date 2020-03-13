<?php

namespace PSD\Battleship;

class Ship
{

    public const OK      = 1;
    public const WARNING = 2;
    public const ERROR   = 3;

    private $name;
    private $size;
    private $color;
    private $positions = [];

    public function __construct($name, $size, $color = null)
    {
        $this->name = $name;
        $this->size = $size;
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    public function addPosition($input)
    {
        $letter = substr($input, 0, 1);
        $number = substr($input, 1, 1);

        $position = new PositionNew($letter, $number);
        $position->setStatus(PositionNew::STATUS_SHIP_ALIVE);

        array_push($this->positions, $position);
    }

    public function &getPositions()
    {
        return $this->positions;
    }

    public function getStatus()
    {
        $countHitted = 0;
        foreach ($this->positions as $position) {
            if ($position->getStatus() === \PSD\Battleship\PositionNew::STATUS_SHIP_DESTROYED) {
                $countHitted++;
            }
        }
        switch (true) {
            case $countHitted === count($this->positions):
                return self::ERROR;
            case $countHitted === 0:
                return self::OK;
            default:
                return self::WARNING;
        }
    }

    public function createPositions(string $position)
    {
        \preg_match('#([ABCDEFGH]{1,1})([1-8]{1,1})([RLUD]{1,1})#ui', $position, $matches);
        $letter = $matches[1] ?? null;
        $number = $matches[2] ?? null;
        $direction = $matches[3] ?? null;
        if (null === $letter || null === $number || null === $direction) {
            throw new \Exception();
        }
        $letter = \strtoupper($letter);
        $direction = \strtoupper($direction);
        $positions = [];
        for ($i = 1; $i <= $this->size; $i++) {
            $position = new PositionNew($letter, $number);
            $positions[] = $position;
            if ($i === $this->size) {
                break;
            }
            switch ($direction) {
                case 'R':
                    $number++;
                    if ($number > 8) {
                        throw new \Exception();
                    }
                    break;
                case 'L':
                    $number--;
                    if ($number < 1) {
                        throw new \Exception();
                    }
                    break;
                case 'U':
                    $index = \array_search($letter, \PSD\Battleship\Letter::$letters);
                    $index--;
                    if ($index < 0) {
                        throw new \Exception();
                    }
                    $letter = \PSD\Battleship\Letter::$letters[$index];
                    break;
                case 'D':
                    $index = \array_search($letter, \PSD\Battleship\Letter::$letters);
                    $index++;
                    if ($index >= \count(\PSD\Battleship\Letter::$letters)) {
                        throw new \Exception();
                    }
                    $letter = \PSD\Battleship\Letter::$letters[$index];
                    break;
                default:
                    throw new \Exception();

            }

        }

        $this->positions = $positions;
    }

}