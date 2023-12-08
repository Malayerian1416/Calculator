<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SWM Calculator</title>
    <link rel="icon" href="{{asset("favicon.ico")}}">
    @routes()
    @vite(['resources/sass/app.scss','resources/css/app.css'])
</head>
<body class="antialiased">
<div id="app" class="main pb-5 bg-dark position-relative">
    <div v-if="loading" class="position-absolute d-flex align-items-center justify-content-center h-100 w-100 bg-dark bg-opacity-50 top-0" style="left: 0;z-index: 5000">
        <i class="fa fa-spinner fa-spin fa-2x text-white"></i>
    </div>
    <input type="file" hidden id="FileBrowser" accept=".xls,.xlsx" v-on:change="UploadExcelFile">
    <a id="DownloadResult" hidden :href="download.file" :download="download.name"></a>
    <div class="container pt-2">
        <nav class="navbar navbar-expand-lg sticky-top bg-light rounded-2 mb-md-3">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" role="button" onclick="window.scrollTo(0, 0);">
                                <b>SWM Calculator</b>
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center justify-content-center gap-1 me-2">
                        <button class="btn btn-sm btn-outline-dark border-0" data-bs-toggle="modal" data-bs-target="#save">
                            <i class="fa fa-save fa-1-4x"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-dark border-0" data-bs-toggle="modal" data-bs-target="#load" @click="GetFiles">
                            <i class="far fa-folder-open fa-1-4x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="inputs-tab" data-bs-toggle="tab" data-bs-target="#inputs-tab-pane" type="button" role="tab" aria-controls="inputs-tab-pane" aria-selected="true">INPUTS</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="output-1-tab" data-bs-toggle="tab" data-bs-target="#output-1-tab-pane" type="button" role="tab" aria-controls="output-1-tab-pane" aria-selected="false">OUTPUT(IDF and Flow Calculator)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="output-2-tab" data-bs-toggle="tab" data-bs-target="#output-2-tab-pane" type="button" role="tab" aria-controls="output-2-tab-pane" aria-selected="false">OUTPUT(Storage Calculator)</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active py-3 px-2" id="inputs-tab-pane" role="tabpanel" aria-labelledby="inputs-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered align-middle text-center development">
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="5">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <b>PRE DEVELOPMENT</b>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-success border-0" data-object="PreDevelopment" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="green-tooltip"
                                                            data-bs-title="Add a new row(shift+x)" @click="addRow">
                                                        <i class="fa fa-plus fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger border-0" data-object="PreDevelopment" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="red-tooltip"
                                                            data-bs-title="Remove last row(shift+d)" @click="removeRow">
                                                        <i class="fa fa-times fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button @click="DownloadExcel('DevelopmentTable','Pre')" class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                                       data-bs-custom-class="blue-tooltip"
                                                       data-bs-title="Download Excel file format">
                                                        <i class="fa fa-cloud-arrow-down fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="blue-tooltip"
                                                            data-bs-title="Upload the Excel file" data-type="DevelopmentTable" data-table="PreDevelopment" v-on:click="OpenFileBrowser">
                                                        <i class="fa fa-cloud-arrow-up fa-1-1x align-middle"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Land Use</th>
                                        <th>Area (m<sup>2</sup>)</th>
                                        <th>Runoff C</th>
                                        <th>Impervious</th>
                                        <th><i class="fa fa-eraser pointer" data-object="PreDevelopment" @click="EraseTable"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(row,index) in TablesData.PreDevelopment" :key="index">
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" type="text" v-model="row.land_use"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="row.area"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="row.runoff_c"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="row.impervious"></td>
                                        <td><i class="fa-solid fa-times text-danger pointer" @click="TablesData.PreDevelopment.splice(index,1)"></i></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-start">Total Site Area</th>
                                        <th class="text-center" v-text="TablesData.TotalSiteArea.pre.area"></th>
                                        <th class="text-center" v-text="TablesData.TotalSiteArea.pre.runoff_c"></th>
                                        <th class="text-center" v-text="TablesData.TotalSiteArea.pre.impervious"></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered text-center align-middle development">
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="5">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <b>POST DEVELOPMENT</b>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-success border-0" data-object="PostDevelopment" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="green-tooltip"
                                                            data-bs-title="Add a new row(shift+x)" @click="addRow">
                                                        <i class="fa fa-plus fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger border-0" data-object="PostDevelopment" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="red-tooltip"
                                                            data-bs-title="Remove last row(shift+d)" @click="removeRow">
                                                        <i class="fa fa-times fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button @click="DownloadExcel('DevelopmentTable','Post')" class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="blue-tooltip"
                                                            data-bs-title="Download Excel file format">
                                                        <i class="fa fa-cloud-arrow-down fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="blue-tooltip"
                                                            data-bs-title="Upload the Excel file" data-type="DevelopmentTable" data-table="PostDevelopment" v-on:click="OpenFileBrowser">
                                                        <i class="fa fa-cloud-arrow-up fa-1-1x align-middle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Land Use</th>
                                        <th>Area (m<sup>2</sup>)</th>
                                        <th>Runoff C</th>
                                        <th>impervious</th>
                                        <th><i class="fa fa-eraser pointer" data-object="PostDevelopment" @click="EraseTable"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(row,index) in TablesData.PostDevelopment" :key="index">
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" v-model="row.land_use"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="row.area"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="row.runoff_c"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="row.impervious"></td>
                                        <td><i class="fa-solid fa-times text-danger pointer" @click="TablesData.PostDevelopment.splice(index,1)"></i></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Total Site Area</th>
                                        <th class="text-center" v-text="TablesData.TotalSiteArea.post.area"></th>
                                        <th class="text-center" v-text="TablesData.TotalSiteArea.post.runoff_c"></th>
                                        <th class="text-center" v-text="TablesData.TotalSiteArea.post.impervious"></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered align-middle pre-development text-center idf-input">
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="7">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <div class="d-flex align-items-center justify-content-start gap-4">
                                                    <b>INTENSITY-DURATION-FREQUENCY (IDF) CALCULATOR: I = A/(T+B)^D</b>
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <div>
                                                            <input class="form-check-input" v-model="TablesData.timeUnit" type="radio" value="60" name="flexRadioDefault" id="hour" checked>
                                                            <label class="form-check-label ms-1" for="hour">
                                                                Hour
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <input class="form-check-input" v-model="TablesData.timeUnit" type="radio" value="1" name="flexRadioDefault" id="minute">
                                                            <label class="form-check-label ms-1" for="minute">
                                                                Minute
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button @click="DownloadExcel('IdfTable')" class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="blue-tooltip"
                                                            data-bs-title="Download Excel file format">
                                                        <i class="fa fa-cloud-arrow-down fa-1-1x align-middle"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                                            data-bs-custom-class="blue-tooltip"
                                                            data-bs-title="Upload the Excel file" data-type="IdfTable" data-table="Idf" v-on:click="OpenFileBrowser">
                                                        <i class="fa fa-cloud-arrow-up fa-1-1x align-middle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Return Period (Years)</th>
                                        <th>2</th>
                                        <th>5</th>
                                        <th>10</th>
                                        <th>25</th>
                                        <th>50</th>
                                        <th>100</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">A</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.A['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.A['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.A['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.A['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.A['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.A['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">B</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.B['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.B['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.B['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.B['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.B['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.B['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">D</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.D['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.D['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.D['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.D['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.D['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Idf.D['100']"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade py-3 px-2" id="output-1-tab-pane" role="tabpanel" aria-labelledby="output-1-tab" tabindex="0">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                <div></div>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                            data-bs-custom-class="blue-tooltip"
                                            data-bs-title="Download result in PDF format" data-section="IdfSection" data-type="Pdf" v-on:click="DownloadResult">
                                        <i class="fa fa-file-pdf fa-2x align-middle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                            data-bs-custom-class="blue-tooltip"
                                            data-bs-title="Download result in CSV format" data-section="IdfSection" data-type="Csv" v-on:click="DownloadResult">
                                        <i class="fa fa-file-csv fa-2x align-middle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered align-middle pre-development text-center idf-table">
                                    <caption>
                                        CALCULATED FLOW BASED ON RATIONAL METHOD: Q (M3/S) = 2.78*C*I*A
                                        <br/>
                                        Modified C, C* = a*C + b
                                    </caption>
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="8">
                                            <b>IDF TABLE</b>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Return Period (Years)</th>
                                        <th>2</th>
                                        <th>5</th>
                                        <th>10</th>
                                        <th>25</th>
                                        <th>50</th>
                                        <th>100</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">A</td>
                                        <td v-text="TablesData.Idf.A['2']"></td>
                                        <td v-text="TablesData.Idf.A['5']"></td>
                                        <td v-text="TablesData.Idf.A['10']"></td>
                                        <td v-text="TablesData.Idf.A['25']"></td>
                                        <td v-text="TablesData.Idf.A['50']"></td>
                                        <td v-text="TablesData.Idf.A['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">B</td>
                                        <td v-text="TablesData.Idf.B['2']"></td>
                                        <td v-text="TablesData.Idf.B['5']"></td>
                                        <td v-text="TablesData.Idf.B['10']"></td>
                                        <td v-text="TablesData.Idf.B['25']"></td>
                                        <td v-text="TablesData.Idf.B['50']"></td>
                                        <td v-text="TablesData.Idf.B['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">D</td>
                                        <td v-text="TablesData.Idf.D['2']"></td>
                                        <td v-text="TablesData.Idf.D['5']"></td>
                                        <td v-text="TablesData.Idf.D['10']"></td>
                                        <td v-text="TablesData.Idf.D['25']"></td>
                                        <td v-text="TablesData.Idf.D['50']"></td>
                                        <td v-text="TablesData.Idf.D['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">10 min</td>
                                        <td v-text="TablesData.Idf.m10['2']"></td>
                                        <td v-text="TablesData.Idf.m10['5']"></td>
                                        <td v-text="TablesData.Idf.m10['10']"></td>
                                        <td v-text="TablesData.Idf.m10['25']"></td>
                                        <td v-text="TablesData.Idf.m10['50']"></td>
                                        <td v-text="TablesData.Idf.m10['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">15 min</td>
                                        <td v-text="TablesData.Idf.m15['2']"></td>
                                        <td v-text="TablesData.Idf.m15['5']"></td>
                                        <td v-text="TablesData.Idf.m15['10']"></td>
                                        <td v-text="TablesData.Idf.m15['25']"></td>
                                        <td v-text="TablesData.Idf.m15['50']"></td>
                                        <td v-text="TablesData.Idf.m15['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">30 min</td>
                                        <td v-text="TablesData.Idf.m30['2']"></td>
                                        <td v-text="TablesData.Idf.m30['5']"></td>
                                        <td v-text="TablesData.Idf.m30['10']"></td>
                                        <td v-text="TablesData.Idf.m30['25']"></td>
                                        <td v-text="TablesData.Idf.m30['50']"></td>
                                        <td v-text="TablesData.Idf.m30['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">1 hr</td>
                                        <td v-text="TablesData.Idf.h1['2']"></td>
                                        <td v-text="TablesData.Idf.h1['5']"></td>
                                        <td v-text="TablesData.Idf.h1['10']"></td>
                                        <td v-text="TablesData.Idf.h1['25']"></td>
                                        <td v-text="TablesData.Idf.h1['50']"></td>
                                        <td v-text="TablesData.Idf.h1['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">2 hr</td>
                                        <td v-text="TablesData.Idf.h2['2']"></td>
                                        <td v-text="TablesData.Idf.h2['5']"></td>
                                        <td v-text="TablesData.Idf.h2['10']"></td>
                                        <td v-text="TablesData.Idf.h2['25']"></td>
                                        <td v-text="TablesData.Idf.h2['50']"></td>
                                        <td v-text="TablesData.Idf.h2['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">6 hr</td>
                                        <td v-text="TablesData.Idf.h6['2']"></td>
                                        <td v-text="TablesData.Idf.h6['5']"></td>
                                        <td v-text="TablesData.Idf.h6['10']"></td>
                                        <td v-text="TablesData.Idf.h6['25']"></td>
                                        <td v-text="TablesData.Idf.h6['50']"></td>
                                        <td v-text="TablesData.Idf.h6['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">12 hr</td>
                                        <td v-text="TablesData.Idf.h12['2']"></td>
                                        <td v-text="TablesData.Idf.h12['5']"></td>
                                        <td v-text="TablesData.Idf.h12['10']"></td>
                                        <td v-text="TablesData.Idf.h12['25']"></td>
                                        <td v-text="TablesData.Idf.h12['50']"></td>
                                        <td v-text="TablesData.Idf.h12['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">24 hr</td>
                                        <td v-text="TablesData.Idf.h24['2']"></td>
                                        <td v-text="TablesData.Idf.h24['5']"></td>
                                        <td v-text="TablesData.Idf.h24['10']"></td>
                                        <td v-text="TablesData.Idf.h24['25']"></td>
                                        <td v-text="TablesData.Idf.h24['50']"></td>
                                        <td v-text="TablesData.Idf.h24['100']"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 align-self-stretch">
                                <table class="table table-bordered align-middle development h-100">
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="5">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <b>PRE DEVELOPMENT</b>
                                                <div>
                                                </div>
                                            </div>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">Project Area, A (ha)</td>
                                        <td class="text-center" v-text="TablesData.TotalSiteArea.pre.area / 10000"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Runoff Coefficient, C</td>
                                        <td class="text-center" v-text="TablesData.TotalSiteArea.pre.runoff_c"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Time of Concentration, T (min)</td>
                                        <td class="text-center">
                                            <input class="form-control number-input text-center w-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.TotalSiteArea.pre.toc">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8 align-self-stretch">
                                <table class="table table-bordered align-middle pre-development text-center idf-input h-100">
                                    <thead>
                                    <tr>
                                        <th>Return Period (Years)</th>
                                        <th>2</th>
                                        <th>5</th>
                                        <th>10</th>
                                        <th>25</th>
                                        <th>50</th>
                                        <th>100</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C ratio, a</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.pre['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.pre['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.pre['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.pre['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.pre['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.pre['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C intercept, b</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.pre['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.pre['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.pre['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.pre['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.pre['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.pre['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C</td>
                                        <td v-text="TablesData.Mc.pre['2']"></td>
                                        <td v-text="TablesData.Mc.pre['5']"></td>
                                        <td v-text="TablesData.Mc.pre['10']"></td>
                                        <td v-text="TablesData.Mc.pre['25']"></td>
                                        <td v-text="TablesData.Mc.pre['50']"></td>
                                        <td v-text="TablesData.Mc.pre['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">I (mm/hr)</td>
                                        <td v-text="TablesData.I.pre['2']"></td>
                                        <td v-text="TablesData.I.pre['5']"></td>
                                        <td v-text="TablesData.I.pre['10']"></td>
                                        <td v-text="TablesData.I.pre['25']"></td>
                                        <td v-text="TablesData.I.pre['50']"></td>
                                        <td v-text="TablesData.I.pre['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Q (litres/sec)</td>
                                        <td v-text="TablesData.Q_l.pre['2']"></td>
                                        <td v-text="TablesData.Q_l.pre['5']"></td>
                                        <td v-text="TablesData.Q_l.pre['10']"></td>
                                        <td v-text="TablesData.Q_l.pre['25']"></td>
                                        <td v-text="TablesData.Q_l.pre['50']"></td>
                                        <td v-text="TablesData.Q_l.pre['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Q (m<sup>3</sup>/sec)</td>
                                        <td v-text="TablesData.Q_m.pre['2']"></td>
                                        <td v-text="TablesData.Q_m.pre['5']"></td>
                                        <td v-text="TablesData.Q_m.pre['10']"></td>
                                        <td v-text="TablesData.Q_m.pre['25']"></td>
                                        <td v-text="TablesData.Q_m.pre['50']"></td>
                                        <td v-text="TablesData.Q_m.pre['100']"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="my-2"></div>
                            <div class="col-md-4 align-self-stretch">
                                <table class="table table-bordered align-middle development h-100">
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="5">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <b>POST DEVELOPMENT</b>
                                                <div>
                                                </div>
                                            </div>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">Project Area, A (ha)</td>
                                        <td class="text-center" v-text="TablesData.TotalSiteArea.post.area / 10000"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Runoff Coefficient, C</td>
                                        <td class="text-center" v-text="TablesData.TotalSiteArea.post.runoff_c"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Time of Concentration, T (min)</td>
                                        <td class="text-center">
                                            <input class="form-control number-input text-center w-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.TotalSiteArea.post.toc">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8 align-self-stretch">
                                <table class="table table-bordered align-middle pre-development text-center idf-input h-100">
                                    <thead>
                                    <tr>
                                        <th>Return Period (Years)</th>
                                        <th>2</th>
                                        <th>5</th>
                                        <th>10</th>
                                        <th>25</th>
                                        <th>50</th>
                                        <th>100</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C ratio, a</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.post['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.post['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.post['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.post['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.post['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.post['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C intercept, b</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.post['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.post['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.post['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.post['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.post['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.post['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C</td>
                                        <td v-text="TablesData.Mc.post['2']"></td>
                                        <td v-text="TablesData.Mc.post['5']"></td>
                                        <td v-text="TablesData.Mc.post['10']"></td>
                                        <td v-text="TablesData.Mc.post['25']"></td>
                                        <td v-text="TablesData.Mc.post['50']"></td>
                                        <td v-text="TablesData.Mc.post['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">I (mm/hr)</td>
                                        <td v-text="TablesData.I.post['2']"></td>
                                        <td v-text="TablesData.I.post['5']"></td>
                                        <td v-text="TablesData.I.post['10']"></td>
                                        <td v-text="TablesData.I.post['25']"></td>
                                        <td v-text="TablesData.I.post['50']"></td>
                                        <td v-text="TablesData.I.post['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Q (litres/sec)</td>
                                        <td v-text="TablesData.Q_l.post['2']"></td>
                                        <td v-text="TablesData.Q_l.post['5']"></td>
                                        <td v-text="TablesData.Q_l.post['10']"></td>
                                        <td v-text="TablesData.Q_l.post['25']"></td>
                                        <td v-text="TablesData.Q_l.post['50']"></td>
                                        <td v-text="TablesData.Q_l.post['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Q (m<sup>3</sup>/sec)</td>
                                        <td v-text="TablesData.Q_m.post['2']"></td>
                                        <td v-text="TablesData.Q_m.post['5']"></td>
                                        <td v-text="TablesData.Q_m.post['10']"></td>
                                        <td v-text="TablesData.Q_m.post['25']"></td>
                                        <td v-text="TablesData.Q_m.post['50']"></td>
                                        <td v-text="TablesData.Q_m.post['100']"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="my-2"></div>
                            <div class="col-md-4 align-self-stretch">
                                <table class="table table-bordered align-middle development h-100">
                                    <thead>
                                    <tr>
                                        <th class="text-start bg-transparent" colspan="5">
                                            <div class="d-flex align-items-center justify-content-between gap-2">
                                                <b>ALLOWED SCENARIO</b>
                                                <div>
                                                </div>
                                            </div>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">Project Area, A (ha)</td>
                                        <td class="text-center">
                                            <input class="form-control number-input text-center w-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.TotalSiteArea.allowedScenario.area">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Runoff Coefficient, C</td>
                                        <td class="text-center">
                                            <input class="form-control number-input text-center w-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.TotalSiteArea.allowedScenario.runoff_c">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Time of Concentration, T (min)</td>
                                        <td class="text-center">
                                            <input class="form-control number-input text-center w-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.TotalSiteArea.allowedScenario.toc">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8 align-self-stretch">
                                <table class="table table-bordered align-middle pre-development text-center idf-input h-100">
                                    <thead>
                                    <tr>
                                        <th>Return Period (Years)</th>
                                        <th>2</th>
                                        <th>5</th>
                                        <th>10</th>
                                        <th>25</th>
                                        <th>50</th>
                                        <th>100</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C ratio, a</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.allowedScenario['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.allowedScenario['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.allowedScenario['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.allowedScenario['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.allowedScenario['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mcr_a.allowedScenario['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C intercept, b</td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.allowedScenario['2']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.allowedScenario['5']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.allowedScenario['10']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.allowedScenario['25']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.allowedScenario['50']"></td>
                                        <td><input class="form-control number-input text-center w-100 h-100 border-primary text-primary" @input="filterNonNumeric" v-model="TablesData.Mci_b.allowedScenario['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Modified C</td>
                                        <td v-text="TablesData.Mc.allowedScenario['2']"></td>
                                        <td v-text="TablesData.Mc.allowedScenario['5']"></td>
                                        <td v-text="TablesData.Mc.allowedScenario['10']"></td>
                                        <td v-text="TablesData.Mc.allowedScenario['25']"></td>
                                        <td v-text="TablesData.Mc.allowedScenario['50']"></td>
                                        <td v-text="TablesData.Mc.allowedScenario['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">I (mm/hr)</td>
                                        <td v-text="TablesData.I.allowedScenario['2']"></td>
                                        <td v-text="TablesData.I.allowedScenario['5']"></td>
                                        <td v-text="TablesData.I.allowedScenario['10']"></td>
                                        <td v-text="TablesData.I.allowedScenario['25']"></td>
                                        <td v-text="TablesData.I.allowedScenario['50']"></td>
                                        <td v-text="TablesData.I.allowedScenario['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Q (litres/sec)</td>
                                        <td v-text="TablesData.Q_l.allowedScenario['2']"></td>
                                        <td v-text="TablesData.Q_l.allowedScenario['5']"></td>
                                        <td v-text="TablesData.Q_l.allowedScenario['10']"></td>
                                        <td v-text="TablesData.Q_l.allowedScenario['25']"></td>
                                        <td v-text="TablesData.Q_l.allowedScenario['50']"></td>
                                        <td v-text="TablesData.Q_l.allowedScenario['100']"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white">Q (m<sup>3</sup>/sec)</td>
                                        <td v-text="TablesData.Q_m.allowedScenario['2']"></td>
                                        <td v-text="TablesData.Q_m.allowedScenario['5']"></td>
                                        <td v-text="TablesData.Q_m.allowedScenario['10']"></td>
                                        <td v-text="TablesData.Q_m.allowedScenario['25']"></td>
                                        <td v-text="TablesData.Q_m.allowedScenario['50']"></td>
                                        <td v-text="TablesData.Q_m.allowedScenario['100']"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade py-3 px-2" id="output-2-tab-pane" role="tabpanel" aria-labelledby="output-2-tab" tabindex="0">
                        <div class="row">
                            <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                                <b>CALCULATED REQUIRED STORAGE BASED ON MODIFIED RATIONAL METHOD</b>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                            data-bs-custom-class="blue-tooltip"
                                            data-bs-title="Download result in PDF format" data-section="StorageSection" data-type="Pdf" v-on:click="DownloadResult">
                                        <i class="fa fa-file-pdf fa-2x align-middle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="tooltip" data-bs-placement="left"
                                            data-bs-custom-class="blue-tooltip"
                                            data-bs-title="Download result in CSV format" data-section="StorageSection" data-type="Csv" v-on:click="DownloadResult">
                                        <i class="fa fa-file-csv fa-2x align-middle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered align-middle mb-3">
                                    <tbody>
                                    <tr>
                                        <th class="w-50" colspan="2">Design Return Period (year)</th>
                                        <th class="w-50">
                                            <select class="form-control text-center w-100 h-100 border-primary text-primary" v-model="TablesData.Drp">
                                                <option selected value="2">2</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered text-center align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th colspan="2">IDF Parameter</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="bg-secondary text-white w-50">A</td>
                                        <td v-text="TablesData.Idf.A[TablesData.Drp]"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white w-50">B</td>
                                        <td v-text="TablesData.Idf.B[TablesData.Drp]"></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-secondary text-white w-50">D</td>
                                        <td v-text="TablesData.Idf.D[TablesData.Drp]"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered align-middle">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Site Parameters</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Post development C</td>
                                        <td><input class="form-control text-center w-100 h-100 border-primary text-primary" v-model="TablesData.Pd_c"></td>
                                    </tr>
                                    <tr>
                                        <td>Maximum Allowable Q (m<sup>3</sup>/s)</td>
                                        <td><input class="form-control text-center w-100 h-100 border-primary text-primary" v-model="TablesData.Maq"></td>
                                    </tr>
                                    <tr>
                                        <td>Area (ha)</td>
                                        <td><input class="form-control text-center w-100 h-100 border-primary text-primary" v-model="TablesData.Area"></td>
                                    </tr>
                                    <tr>
                                        <td>Time of concentration, T (min)</td>
                                        <td><input class="form-control text-center w-100 h-100 border-primary text-primary" v-model="TablesData.Toc"></td>
                                    </tr>
                                    <tr>
                                        <td>Modified Intensity ratio, Ix= a*I</td>
                                        <td><input class="form-control text-center w-100 h-100 border-primary text-primary" v-model="TablesData.Mi_r"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered text-center align-middle storage-table">
                                    <thead>
                                    <tr>
                                        <th>T <small>(min)</small></th>
                                        <th>I <small>(mm/hr)</small></th>
                                        <th>Ix <small>(mm/hr)</small></th>
                                        <th>Peak Discharge, Q <small>(m<sup>3</sup>/s)</small></th>
                                        <th>Trapezoidal Area Volume <small>(m<sup>3</sup>)</small></th>
                                        <th>Triangular Area Volume <small>(m<sup>3</sup>)</small></th>
                                        <th>Storage Volume <small>(m<sup>3</sup>)</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>10</td>
                                        <td v-text="TablesData.StorageTable['10'].I"></td>
                                        <td v-text="TablesData.StorageTable['10'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['10'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['10'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['10'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['10'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td v-text="TablesData.StorageTable['20'].I"></td>
                                        <td v-text="TablesData.StorageTable['20'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['20'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['20'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['20'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['20'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>30</td>
                                        <td v-text="TablesData.StorageTable['30'].I"></td>
                                        <td v-text="TablesData.StorageTable['30'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['30'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['30'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['30'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['30'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>40</td>
                                        <td v-text="TablesData.StorageTable['40'].I"></td>
                                        <td v-text="TablesData.StorageTable['40'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['40'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['40'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['40'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['40'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>50</td>
                                        <td v-text="TablesData.StorageTable['50'].I"></td>
                                        <td v-text="TablesData.StorageTable['50'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['50'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['50'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['50'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['50'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>60</td>
                                        <td v-text="TablesData.StorageTable['60'].I"></td>
                                        <td v-text="TablesData.StorageTable['60'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['60'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['60'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['60'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['60'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>70</td>
                                        <td v-text="TablesData.StorageTable['70'].I"></td>
                                        <td v-text="TablesData.StorageTable['70'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['70'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['70'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['70'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['70'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td v-text="TablesData.StorageTable['80'].I"></td>
                                        <td v-text="TablesData.StorageTable['80'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['80'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['80'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['80'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['80'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>90</td>
                                        <td v-text="TablesData.StorageTable['90'].I"></td>
                                        <td v-text="TablesData.StorageTable['90'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['90'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['90'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['90'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['90'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>100</td>
                                        <td v-text="TablesData.StorageTable['100'].I"></td>
                                        <td v-text="TablesData.StorageTable['100'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['100'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['100'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['100'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['100'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>110</td>
                                        <td v-text="TablesData.StorageTable['110'].I"></td>
                                        <td v-text="TablesData.StorageTable['110'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['110'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['110'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['110'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['110'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>120</td>
                                        <td v-text="TablesData.StorageTable['120'].I"></td>
                                        <td v-text="TablesData.StorageTable['120'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['120'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['120'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['120'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['120'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>130</td>
                                        <td v-text="TablesData.StorageTable['130'].I"></td>
                                        <td v-text="TablesData.StorageTable['130'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['130'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['130'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['130'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['130'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>140</td>
                                        <td v-text="TablesData.StorageTable['140'].I"></td>
                                        <td v-text="TablesData.StorageTable['140'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['140'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['140'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['140'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['140'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>150</td>
                                        <td v-text="TablesData.StorageTable['150'].I"></td>
                                        <td v-text="TablesData.StorageTable['150'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['150'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['150'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['150'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['150'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>160</td>
                                        <td v-text="TablesData.StorageTable['160'].I"></td>
                                        <td v-text="TablesData.StorageTable['160'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['160'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['160'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['160'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['160'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>170</td>
                                        <td v-text="TablesData.StorageTable['170'].I"></td>
                                        <td v-text="TablesData.StorageTable['170'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['170'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['170'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['170'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['170'].Sv"></td>
                                    </tr>
                                    <tr>
                                        <td>180</td>
                                        <td v-text="TablesData.StorageTable['180'].I"></td>
                                        <td v-text="TablesData.StorageTable['180'].Ix"></td>
                                        <td v-text="TablesData.StorageTable['180'].Pdq"></td>
                                        <td v-text="TablesData.StorageTable['180'].TraAv"></td>
                                        <td v-text="TablesData.StorageTable['180'].TriAv"></td>
                                        <td v-text="TablesData.StorageTable['180'].Sv"></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-end" colspan="6">Max. Required Storage <small>(m<sup>3</sup>)</small></th>
                                        <th v-text="TablesData.MaxStorage"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="save" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="save" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Save current data</h1>
                </div>
                <div class="modal-body">
                    <div v-if="loading" class="position-absolute d-flex align-items-center justify-content-center h-100 w-100 bg-white top-0" style="left: 0">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                    </div>
                    <label class="form-label">Write a name for storage file</label>
                    <input type="text" class="form-control text-center" v-model="filename">
                </div>
                <div class="modal-footer">
                    <button v-if="filename" type="button" class="btn btn-primary" data-type="cloud" @click="SaveData">Save on the cloud</button>
                    <button v-if="filename" type="button" class="btn btn-outline-primary" data-type="personal" @click="SaveData">Save on your system</button>
                    <button id="CloseSaveModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="load" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="load" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Load saved data</h1>
                </div>
                <div class="modal-body position-relative">
                    <div v-if="loading" class="position-absolute d-flex align-items-center justify-content-center h-100 w-100 bg-white top-0" style="left: 0">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                    </div>
                    <button v-if="FileViewType === 'file'" class="btn btn-sm btn-outline-info border-0 mb-3" @click="FileViewType = 'folder';AllFiles = []">
                        <i class="fa fa-arrow-left fa-1-1x align-middle"></i>
                    </button>
                    <div v-if="SavedFiles.length > 0" class="d-flex align-items-start justify-content-start flex-row flex-wrap gap-3 p-2">
                        <div v-if="FileViewType === 'folder'" v-for="(item,index) in SavedFiles" :key="index" class="d-flex align-items-center justify-content-center flex-column gap-2 file-pointer file-box" :data-directory="item.directory" @click="OpenDirectory">
                            <i class="fa fa-folder fa-2x text-info"></i>
                            <span class="text-wrap text-center" v-text="item.directory"></span>
                        </div>
                        <div v-for="(item,fileIndex) in AllFiles" :key="fileIndex" class="position-relative d-flex align-items-center justify-content-center flex-column gap-2 file-pointer file-box" :data-file_index="fileIndex" @click="LoadData">
                            <i class="fa fa-file fa-2x text-info"></i>
                            <p class="text-wrap text-center m-0" style="word-break: break-word" v-text="item.file.replace('.json','')"></p>
                        </div>
                    </div>
                    <div v-else class="d-flex align-items-start justify-content-center flex-row p-2">
                        Disk is Empty!
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="file" hidden="hidden" id="localFile" accept="application/json" v-on:change="LoadLocalFile">
                    <button type="button" class="btn btn-primary" v-on:click="browseFiles">
                        <i class="fa fa-search me-2"></i>
                        <span>Browse local files</span>
                    </button>
                    <button id="CloseLoadModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
