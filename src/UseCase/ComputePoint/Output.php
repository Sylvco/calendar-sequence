<?php

namespace UseCase\ComputePoint;

class Output
{

    /**
     * @var string
     */
    public $pointInformation;

    public function __construct(
        string $pointInformation
    )
    {
        $this->pointInformation = $pointInformation;
    }
}