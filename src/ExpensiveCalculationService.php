<?php
declare(strict_types=1);

namespace App;


final class ExpensiveCalculationService
{
    public function calculate(string $question): int
    {
        sleep(1);
        return 42;
    }
}