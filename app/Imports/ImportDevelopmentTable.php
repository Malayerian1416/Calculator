<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ImportDevelopmentTable implements OnEachRow,WithValidation,SkipsOnFailure,WithStartRow,SkipsEmptyRows
{
    use Importable, SkipsFailures;

    private array $result = ["success" => [],"fail" => []];

    public function rules(): array
    {
        return [
            "1" => "numeric",
            "2" => "numeric",
            "3" => "numeric",
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            "1.numeric" => "The entered value for the Area column is not numeric",
            "2.numeric" => "The entered value for the RunoffC column is not numeric",
            "3.numeric" => "The entered value for the Impervious column is not numeric",
        ];
    }

    public function prepareForValidation($data)
    {
        if ($data[1] == "" || $data[1] == null)
            $data[1] = 0;
        if ($data[2] == "" || $data[2] == null)
            $data[2] = 0;
        if ($data[3] == "" || $data[3] == null)
            $data[3] = 0;
        return $data;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getResult(): array
    {
        return $this->result["success"];
    }

    public function getFails(): array
    {
        return $this->result["fail"];
    }

    public function onRow(Row $row): void
    {
        $this->result["success"][] = [
            "land_use" => $row[0],
            "area" => $row[1],
            "runoff_c" => $row[2],
            "impervious" => $row[3]
        ];
    }
}
