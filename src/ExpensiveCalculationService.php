<?php

declare(strict_types=1);

namespace App;

final class ExpensiveCalculationService
{
    public function calculate(): int
    {
        sleep(3);

        return 42;
    }
}
