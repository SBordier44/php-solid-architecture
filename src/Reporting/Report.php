<?php

declare(strict_types=1);

namespace App\Reporting;

use JetBrains\PhpStorm\ArrayShape;

class Report
{
    public function __construct(protected string $date, protected string $title, protected array $data)
    {
    }

    #[ArrayShape(['date' => "string", 'title' => "string", 'data' => "array"])]
    public function getContents(): array
    {
        return [
            'date' => $this->date,
            'title' => $this->title,
            'data' => $this->data
        ];
    }
}
