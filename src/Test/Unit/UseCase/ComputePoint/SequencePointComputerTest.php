<?php

namespace Test\Unit\UseCase\ComputePoint;

use Model\Sequence;
use Model\SequencePoint;
use PHPUnit\Framework\TestCase;
use UseCase\ComputePoint\SequencePointComputer;

class SequencePointComputerTest extends TestCase
{

    /**
     * @var SequencePointComputer
     */
    private $computer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->computer = new SequencePointComputer();
    }

    /**
     * @dataProvider dataProviderComputePoint
     *
     * @param \DateTime $point
     * @param Sequence $sequence
     * @param SequencePoint $result
     */
    public function testComputePoint(\DateTime $point, Sequence $sequence, SequencePoint $result)
    {
        $this->assertEquals($result->information, $this->computer->computePoint($point, $sequence)->information);
    }

    public function dataProviderComputePoint(): array
    {
        return [
            [
                new \DateTime('2020-03-08'),
                new Sequence(
                    'test1',
                    new \DateTime('2020-03-01'),
                    [
                        new SequencePoint('1'),
                        new SequencePoint('2'),
                        new SequencePoint('3'),
                        new SequencePoint('4'),
                        new SequencePoint('5'),
                    ]
                ),
                new SequencePoint('3')
            ],
            [
                new \DateTime('2020-03-01'),
                new Sequence(
                    'test1',
                    new \DateTime('2020-03-01'),
                    [
                        new SequencePoint('1'),
                        new SequencePoint('2'),
                        new SequencePoint('3'),
                    ]
                ),
                new SequencePoint('1')
            ],
            [
                new \DateTime('2020-02-23'),
                new Sequence(
                    'test1',
                    new \DateTime('2020-03-01'),
                    [
                        new SequencePoint('1'),
                        new SequencePoint('2'),
                        new SequencePoint('3'),
                        new SequencePoint('4'),
                    ]
                ),
                new SequencePoint('2')
            ]
        ];
    }
}