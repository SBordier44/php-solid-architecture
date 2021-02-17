<?php

declare(strict_types=1);

namespace App\Controller;

use App\Reporting\Format\HtmlFormatter;
use App\Reporting\Format\JsonFormatter;
use App\Reporting\Report;

class ReportCreatorController
{
    public function show(): void
    {
        require_once(TEMPLATES_DIR . 'report-creator/show.html.php');
    }

    public function execute(): void
    {
        $date = $_POST['date'];
        $title = $_POST['title'];
        $data = $_POST['data'];
        $format = $_POST['format'];

        $report = new Report($date, $title, $data);

        if ($format === "html") {
            $formatter = new HtmlFormatter();
            $reportResult = $formatter->format($report);
        } else {
            $formatter = new JsonFormatter();
            $reportResult = $formatter->format($report);
        }

        require_once(TEMPLATES_DIR . 'report-creator/result.html.php');
    }
}
