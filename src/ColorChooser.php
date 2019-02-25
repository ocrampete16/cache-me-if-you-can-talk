<?php

declare(strict_types=1);

namespace App;

final class ColorChooser
{
    public function random(): string
    {
        sleep(1);

        return sprintf('#%06s', dechex(random_int(0, 16 ** 6 - 1)));
    }
}
