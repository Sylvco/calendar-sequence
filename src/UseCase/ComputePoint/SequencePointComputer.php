<?php

namespace UseCase\ComputePoint;

use Model\Sequence;
use Model\SequencePoint;

final class SequencePointComputer
{

    public function computePoint(
        \DateTime $point,
        Sequence $sequence
    ): SequencePoint
    {
        if ($point > $sequence->offsetDate) {
            return $this->computePointInFuture($point, $sequence);
        } else {
            return $this->computePointInPast($point, $sequence);
        }
    }

    private function computePointInFuture(\DateTime $point, Sequence $sequence): SequencePoint
    {
        return $this->computePointWith(
            $point,
            \DateInterval::createFromDateString('+1days'),
            $sequence->offsetDate,
            $sequence->points
        );
    }

    private function computePointInPast(\DateTime $point, Sequence $sequence): SequencePoint
    {
        return $this->computePointWith(
            $point,
            \DateInterval::createFromDateString('-1days'),
            $sequence->offsetDate,
            array_merge(
                [$sequence->points[0]],
                array_reverse(array_slice($sequence->points, 1))
            )
        );
    }

    private function computePointWith(\DateTime $point, \DateInterval $interval, \DateTime $offsetDate, array $points): SequencePoint
    {
        $currentIndex = 0;
        $currentDate = $offsetDate;
        while ($point->diff($currentDate, true)->d > 0) {
            $currentIndex++;
            $currentDate->add($interval);
        }

        return $points[$currentIndex % count($points)];
    }
}