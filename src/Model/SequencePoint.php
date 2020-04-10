<?php

namespace Model;

class SequencePoint
{

    /**
     * @var string
     */
    public $information;

    public function __construct(string $information)
    {
        $this->information = $information;
    }
}