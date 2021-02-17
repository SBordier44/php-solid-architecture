<?php

declare(strict_types=1);

namespace App\Reporting;

class StringReport extends Report
{
    public function getStringContents(): string
    {
        return "title:{$this->title};date:{$this->date};data:" . implode(',', $this->data);
    }
}
