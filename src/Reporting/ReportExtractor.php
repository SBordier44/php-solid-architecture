<?php

declare(strict_types=1);

namespace App\Reporting;

use App\Reporting\Format\FormatterInterface;

class ReportExtractor
{
    protected array $formatters = [];

    public function addFormatter(FormatterInterface $formatter): void
    {
        $this->formatters[] = $formatter;
    }

    public function process(Report $report): array
    {
        $results = [];

        foreach ($this->formatters as $formatter) {
            $results[] = $formatter->format($report);
        }

        return $results;
    }
}
