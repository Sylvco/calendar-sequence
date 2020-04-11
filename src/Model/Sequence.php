<?php

namespace Model;

class Sequence
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var \DateTime
     */
    public $offsetDate;

    /**
     * @var SequencePoint[]
     */
    public $points;

    /**
     * @param string $name
     * @param \DateTime $offsetDate
     * @param SequencePoint[] $points
     */
    public function __construct(
        string $name,
        \DateTime $offsetDate,
        array $points
    ) {
        $this->name       = $name;
        $this->offsetDate = $offsetDate;
        $this->points     = $points;
    }
}