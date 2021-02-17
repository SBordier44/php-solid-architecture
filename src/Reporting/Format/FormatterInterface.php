<?php

declare(strict_types=1);

namespace App\Reporting\Format;

use App\Reporting\Report;

interface FormatterInterface
{
    public function format(Report $report): string;
}
