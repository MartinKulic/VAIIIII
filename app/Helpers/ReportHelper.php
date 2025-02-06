<?php

namespace App\Helpers;

use App\Models\Image;
use App\Models\Report;

class ReportHelper
{
    protected $report;
    protected $image;

    function __construct(Report $report){

        $this->report = $report;
        $this->image = Image::findOrFail($report->image_id);

        return $this;
    }

    public function getReport(): Report
    {
        return $this->report;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }



}
