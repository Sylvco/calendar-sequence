<?php

namespace UseCase\ComputePoint;

class Input
{

    /**
     * @var \DateTime
     */
    public $point;

    /**
     * @var string
     */
    public $sequenceName;

    public function __construct(
        \DateTime $point,
        string $sequenceName
    ) {
        $this->point        = $point;
        $this->sequenceName = $sequenceName;
    }
}