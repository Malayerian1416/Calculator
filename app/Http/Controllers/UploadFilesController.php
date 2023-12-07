<?php

namespace App\Http\Controllers;

use App\Imports\ImportDevelopmentTable;
use App\Imports\ImportIdfTable;
use Illuminate\Http\Request;
use Throwable;

class UploadFilesController extends Controller
{
    public function Excel(Request $request): array|string
    {
        try {
            $request->validate(
                ["file" => "required|mimes:xlsx,xls"],
                ["file.required" => "No file has been uploaded","file.mimes" => "The uploaded file format is not correct"]
            );
            $response = [];
            switch ($request->type){
                case "DevelopmentTable":{
                    $import = new ImportDevelopmentTable;
                    $import->import($request->file("file"));
                    if (count($import->failures()->toArray()) > 0){
                        foreach ($import->failures() as $failure){
                            foreach ($failure->errors() as $error)
                                $response["importErrors"][] = ["row" => $failure->row(),"message" => $error,"national_code" => $failure->values()[1]];
                        }
                    }
                    $response["data"] = $import->getResult();
                    break;
                }
                case "IdfTable":{
                    $import = new ImportIdfTable;
                    $import->import($request->file("file"));
                    if (count($import->failures()->toArray()) > 0){
                        foreach ($import->failures() as $failure){
                            foreach ($failure->errors() as $error)
                                $response["importErrors"][] = ["row" => $failure->row(),"message" => $error,"national_code" => $failure->values()[1]];
                        }
                    }
                    $response["data"] = $import->getResult();
                    break;
                }
            }
            $response["result"] = "success";
            $response["message"] = "Excel file information has been received successfully";
            return $response;
        }
        catch (Throwable $error){
            $response["result"] = "fails";
            $response["message"] = $error->getMessage();
            return $response;
        }
    }
}
