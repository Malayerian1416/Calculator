<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;

class ImportIdfTable implements ToCollection,WithValidation,SkipsOnFailure,WithStartRow,SkipsEmptyRows
{
    use Importable, SkipsFailures;

    private array $result = ["success" => [],"fail" => []];

    public function rules(): array
    {
        return [
            "1" => "numeric",
            "2" => "numeric",
            "3" => "numeric",
            "4" => "numeric",
            "5" => "numeric",
            "6" => "numeric"
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            "1.numeric" => "The entered value for the '2' column is not numeric",
            "2.numeric" => "The entered value for the '5' column is not numeric",
            "3.numeric" => "The entered value for the '10' column is not numeric",
            "4.numeric" => "The entered value for the '25' column is not numeric",
            "5.numeric" => "The entered value for the '50' column is not numeric",
            "6.numeric" => "The entered value for the '100' column is not numeric",
        ];
    }

    public function prepareForValidation($data)
    {
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] == "" || $data[$i] == null)
                $data[$i] = 0;
        }
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

    public function collection(Collection $collection): void
    {
        $this->result["success"]["A"] = [
            "2" => $collection[0][1],
            "5" => $collection[0][2],
            "10" => $collection[0][3],
            "25" => $collection[0][4],
            "50" => $collection[0][5],
            "100" => $collection[0][6],
        ];
        $this->result["success"]["B"] = [
            "2" => $collection[1][1],
            "5" => $collection[1][2],
            "10" => $collection[1][3],
            "25" => $collection[1][4],
            "50" => $collection[1][5],
            "100" => $collection[1][6],
        ];
        $this->result["success"]["D"] = [
            "2" => $collection[2][1],
            "5" => $collection[2][2],
            "10" => $collection[2][3],
            "25" => $collection[2][4],
            "50" => $collection[2][5],
            "100" => $collection[2][6],
        ];
    }
}
