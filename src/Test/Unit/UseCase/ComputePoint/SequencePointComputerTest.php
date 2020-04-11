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
     * @param \DateTime[] $points
     * @param Sequence $sequence
     * @param string[] $results
     */
    public function testComputePoint(array $points, Sequence $sequence, array $results)
    {
        foreach ($points as $index => $point) {
            $this->assertEquals(
                $results[$index],
                $this->computer->computePoint($point, $sequence)->information
            );
        }
    }

    public function dataProviderComputePoint(): array
    {
        return [
            [
                [new \DateTime('2020-03-08')],
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
                ['3']
            ],
            [
                [new \DateTime('2020-03-01')],
                new Sequence(
                    'test1',
                    new \DateTime('2020-03-01'),
                    [
                        new SequencePoint('1'),
                        new SequencePoint('2'),
                        new SequencePoint('3'),
                    ]
                ),
                ['1']
            ],
            [
                [new \DateTime('2020-02-23')],
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
                ['2']
            ],
            [
                [
                    new \DateTime('2020-04-03'),
                    new \DateTime('2020-04-04'),
                    new \DateTime('2020-04-05'),
                    new \DateTime('2020-04-06'),
                ],
                $this->get223(),
                [
                    'Popołudniu',
                    'Popołudniu',
                    'Nocka',
                    'Nocka'
                ]
            ]
        ];
    }

    private function get223()
    {
        $earlyPoint = New SequencePoint('Rano');
        $latePoint  = New SequencePoint('Popołudniu');
        $nightPoint = New SequencePoint('Nocka');
        $freePoint  = New SequencePoint('Wolne');

        return new Sequence(
            '2-2-3 Fiolka Piotr',
            new \DateTime('2020-04-01'),
            [
                $earlyPoint,
                $earlyPoint,

                $latePoint,
                $latePoint,

                $nightPoint,
                $nightPoint,
                $nightPoint,

                $freePoint,
                $freePoint,

                $earlyPoint,
                $earlyPoint,

                $latePoint,
                $latePoint,
                $latePoint,

                $nightPoint,
                $nightPoint,

                $freePoint,
                $freePoint,

                $earlyPoint,
                $earlyPoint,
                $earlyPoint,

                $latePoint,
                $latePoint,

                $nightPoint,
                $nightPoint,

                $freePoint,
                $freePoint,
                $freePoint
            ]
        );
    }
}