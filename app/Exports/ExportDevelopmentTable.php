<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportDevelopmentTable implements FromView,WithStyles,WithTitle
{
    public mixed $data;
    public mixed $kind;
    public function __construct($data, $kind)
    {
        $this->kind = $kind;
        $this->data = $data;
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A:D');
        $sheet->getStyle('A:D')->getFont()->setSize(12);
        $sheet->getStyle('A1:D1')->getFont()->setSize(12);
        $sheet->getStyle('A:D')->getAlignment()->setVertical('center');
        $sheet->getStyle('A:D')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
    }

    public function view(): View
    {
        $data = [];
        switch ($this->kind){
            case "Pre": $data = json_decode($this->data,true)["PreDevelopment"];break;
            case "Post": $data = json_decode($this->data,true)["PostDevelopment"];break;
        }
        return view('layouts.excel.DevelopmentTable',["data" => $data]);
    }

    public function title(): string
    {
        return "DevelopmentTable";
    }
}
