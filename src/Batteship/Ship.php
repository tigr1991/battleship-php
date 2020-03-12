<?php

namespace Battleship;


class Ship
{

    public const OK = 1;
    public const WARNING = 2;
    public const ERROR = 3;

    private $name;
    private $size;
    private $color;
    private $positions = array();

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

        $position = new Position($letter, $number);
        $position->setStatus(Position::STATUS_SHIP_ALIVE);

        array_push($this->positions, $position);
    }

    public function &getPositions()
    {
        return $this->positions;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getStatus()
    {
        $countHitted = 0;
        foreach ($this->positions as $position) {
            if ($position->getStatus() === \Battleship\Position::STATUS_SHIP_DESTROYED) {
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

}