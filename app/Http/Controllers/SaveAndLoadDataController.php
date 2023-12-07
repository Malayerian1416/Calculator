<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SaveAndLoadDataController extends Controller
{
    public function Save(Request $request): array
    {
        try {
            $date = date("Y-m-d");
            $time = date("H_i_s");
            $filename = $request->filename."_".$time;
            Storage::disk("saves")->put("{$date}/{$filename}.json",$request->data);
            return ["result" => "success", "filename" => $filename];
        }
        catch (Throwable $error){
            return ["result" => "fails", "error" => $error->getMessage()];
        }
    }
    public function Load(Request $request)
    {
        try {
            $file_data =  Storage::disk("saves")->get("{$request->directory}/{$request->file}");
            return response()->json(["result" => "success", "data" => json_decode($file_data,true)]);
        }
        catch (Throwable $error){
            return ["result" => "fails", "error" => $error->getMessage()];
        }
    }
    public function getFiles(): array
    {
        try {
            $result = [];
            $directories = Storage::disk("saves")->allDirectories();
            foreach ($directories as $directory){
                $files = Storage::disk("saves")->allFiles($directory);
                $temp = ["directory" => $directory, "files" => []];
                foreach ($files as $file)
                    $temp["files"][] = basename($file);
                $result[] = $temp;
            }
            return ["result" => "success", "data" => $result];
        }
        catch (Throwable $error){
            return ["result" => "fails", "error" => $error->getMessage()];
        }
    }
}
