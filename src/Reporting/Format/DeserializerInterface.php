<?php

declare(strict_types=1);

namespace App\Reporting\Format;

use App\Reporting\Report;

interface DeserializerInterface
{
    public function deserialize(string $str): Report;
}
