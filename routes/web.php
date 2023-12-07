<?php

use App\Http\Controllers\DownloadFilesController;
use App\Http\Controllers\SaveAndLoadDataController;
use App\Http\Controllers\UploadFilesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name("landing");
Route::get('/home', function () {
    return view('home');
})->name("home");
Route::group(['prefix'=>'Download'],function(){
    Route::post("Excel",[DownloadFilesController::class,"Excel"])->name("Download.Excel");
    Route::post("Pdf",[DownloadFilesController::class,"Pdf"])->name("Download.Pdf");
    Route::post("Csv",[DownloadFilesController::class,"Csv"])->name("Download.Csv");
    Route::post("Json",[SaveAndLoadDataController::class,"Json"])->name("Json");
});
Route::post("Upload/Excel",[UploadFilesController::class,"Excel"])->name("Upload.Excel");
Route::post("SaveData",[SaveAndLoadDataController::class,"Save"])->name("Save");
Route::post("LoadData",[SaveAndLoadDataController::class,"Load"])->name("Load");
Route::post("GetFiles",[SaveAndLoadDataController::class,"getFiles"])->name("GetFiles");
