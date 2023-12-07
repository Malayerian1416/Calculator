<?php

namespace App\Http\Controllers;

use App\Exports\ExportCsvFormat;
use App\Exports\ExportDevelopmentTable;
use App\Exports\ExportIdfTable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Throwable;

class DownloadFilesController extends Controller
{
    public function Excel(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse|bool|string
    {
        try {
            switch ($request->input("type")){
                case "DevelopmentTable":{
                    return Excel::download(new ExportDevelopmentTable($request->input("data"),$request->input("kind")),"DevelopmentTable.xlsx");
                }
                case "IdfTable":{
                    return Excel::download(new ExportIdfTable($request->input("data")),"IdfTable.xlsx");
                }
                default: {
                    return false;
                }
            }
        }
        catch (Throwable $error){
            return $error->getMessage();
        }
    }
    public function Pdf(Request $request): string|\Symfony\Component\HttpFoundation\Response
    {
        try {
            $pdf = PDF::loadView("layouts.pdf.{$request->section}", [
                "data" => json_decode($request->data,true),
            ], [], [
                'format' => "A4-P",
            ]);
            return $pdf->download("file.pdf");
        }
        catch (Throwable $error){
            return $error->getMessage();
        }
    }
    public function Csv(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse|string
    {
        try {
            return Excel::download(new ExportCsvFormat(json_decode($request->data,true),$request->section),"file.csv",\Maatwebsite\Excel\Excel::CSV);
        }
        catch (Throwable $error){
            return $error->getMessage();
        }
    }
}
