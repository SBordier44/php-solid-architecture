<?php

declare(strict_types=1);

namespace App\Reporting\Format;

use App\Reporting\Report;

class JsonFormatter implements FormatterInterface, DeserializerInterface
{
    public function format(Report $report): string
    {
        return json_encode($report->getContents(), JSON_THROW_ON_ERROR);
    }

    public function deserialize(string $str): Report
    {
        $contents = json_decode($str, true, 512, JSON_THROW_ON_ERROR);

        $data = explode(',', $contents['data']);

        return new Report($contents['date'], $contents['title'], $data);
    }
}
