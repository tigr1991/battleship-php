<?php

namespace PSD\Battleship;

class PositionNew
{

    public const STATUS_FREE = 0;
    public const STATUS_SHIP_ALIVE = 1;
    public const STATUS_SHIP_DESTROYED = 2;

    /**
     * @var string
     */
    private $column;
    private $row;

    private $status;

    /**
     * Position constructor.
     * @param string $letter
     * @param string $number
     */
    public function __construct($letter, $number)
    {
        $this->column = Letter::validate(strtoupper($letter));
        if (!\is_numeric($number)) {
            throw new \Exception("Invalid number");
        }
        $this->row = $number;

        $this->status = self::STATUS_FREE;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getRow()
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return PositionNew
     */
    public function setStatus(int $status): PositionNew
    {
        $this->status = $status;
        return $this;
    }


    public function __toString()
    {
        return sprintf("%s%s", $this->column, $this->row);
    }


}