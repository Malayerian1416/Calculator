<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportIdfTable implements FromView,WithStyles,WithTitle
{
    public mixed $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A:G');
        $sheet->getStyle('A:G')->getFont()->setSize(12);
        $sheet->getStyle('A1:G1')->getFont()->setSize(12);
        $sheet->getStyle('A:G')->getAlignment()->setVertical('center');
        $sheet->getStyle('A:G')->getAlignment()->setHorizontal('center');
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
    }

    public function view(): View
    {
        return view('layouts.excel.IdfTable',["data" => json_decode($this->data,true)["Idf"]]);
    }

    public function title(): string
    {
        return "IdfTable";
    }
}
