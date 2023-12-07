<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCsvFormat implements FromView
{
    public array $data;
    public string $section;
    public function __construct($data,$section)
    {
        $this->data = $data;
        $this->section = $section;
    }
    public function view(): View
    {
        return view("layouts.csv.{$this->section}",["data" => $this->data]);
    }
}
