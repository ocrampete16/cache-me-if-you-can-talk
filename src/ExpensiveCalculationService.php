<?php

declare(strict_types=1);

namespace App;

final class ExpensiveCalculationService
{
    public function calculate(): string
    {
        sleep(1);

        return '#'.dechex(random_int(0, 16 ** 6 - 1));
    }
}
