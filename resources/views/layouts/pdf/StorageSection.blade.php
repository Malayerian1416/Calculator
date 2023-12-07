<style>
    body{
        direction: ltr;
        font-size: 14px;
    }
    .container{
        width: 100%;
    }
    .title{
        color: #6c6c6c;
    }
    .design-year{
        padding: 5px;
    }
    table{
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 10px;
    }
    table th{
        padding: 5px;
    }
    table td{
        padding: 5px;
    }
    table tbody tr td{
        border: 1px solid #464646;
    }
    table thead tr th{
        text-align: left!important;
    }
    .bg-secondary{
        background-color: #dcdcdc;
    }
    .text-center{
        text-align: center;
    }
    .text-end{
        text-align: right;
    }
    .idf-parameter td{
        width: 50%;
    }
    .site-parameter td{
        width: 50%;
    }
    .storage-table thead th{
        width: 15%;
    }
    .storage-table thead th:first-child {
        width: 10%;
    }
    .storage-table tfoot tr th{
        border-right: 1px solid #464646;
        border-left: 1px solid #464646;
        border-bottom: 1px solid #464646;
    }
</style>
<body>
<h4 class="title text-center">CALCULATED REQUIRED STORAGE BASED ON MODIFIED RATIONAL METHOD</h4>
<div class="container">
    <h5 class="design-year bg-secondary">Design Return Period (year) = {{$data["Drp"]}}</h5>
    <table class="idf-parameter">
        <thead>
        <tr>
            <th colspan="2">IDF Parameter</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-secondary text-center">A</td>
            <td class="text-center">{{$data["Idf"]["A"][$data["Drp"]]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary text-center">B</td>
            <td class="text-center">{{$data["Idf"]["B"][$data["Drp"]]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary text-center">D</td>
            <td class="text-center">{{$data["Idf"]["D"][$data["Drp"]]}}</td>
        </tr>
        </tbody>
    </table>
    <table class="site-parameter">
        <thead>
        <tr>
            <th colspan="2">Site Parameters</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-secondary">Post development C</td>
            <td class="text-center">{{$data["Pd_c"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Maximum Allowable Q (m<sup>3</sup>/s)</td>
            <td class="text-center">{{$data["Maq"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Area (ha)</td>
            <td class="text-center">{{$data["Area"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Time of concentration, T (min)</td>
            <td class="text-center">{{$data["Toc"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified Intensity ratio, Ix= a*I</td>
            <td class="text-center">{{$data["Mi_r"]}}</td>
        </tr>
        </tbody>
    </table>
    <table class="storage-table text-center">
        <thead>
        <tr>
            <th colspan="7">Storage Calculation</th>
        </tr>
        <tr>
            <th class="text-center bg-secondary">T</th>
            <th class="text-center bg-secondary">I</th>
            <th class="text-center bg-secondary">Ix</th>
            <th class="text-center bg-secondary">Peak Discharge, Q</th>
            <th class="text-center bg-secondary">Trapezoidal Area Volume</th>
            <th class="text-center bg-secondary">Triangular Area Volume</th>
            <th class="text-center bg-secondary">Storage Volume</th>
        </tr>
        <tr>
            <th class="text-center bg-secondary"><small>(min)</small></th>
            <th class="text-center bg-secondary"><small>(mm/hr)</small></th>
            <th class="text-center bg-secondary"><small>(mm/hr)</small></th>
            <th class="text-center bg-secondary"><small>(m<sup>3</sup>/s)</small></th>
            <th class="text-center bg-secondary"><small>(m<sup>3</sup>)</small></th>
            <th class="text-center bg-secondary"><small>(m<sup>3</sup>)</small></th>
            <th class="text-center bg-secondary"><small>(m<sup>3</sup>)</small></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center bg-secondary">10</td>
            <td>{{$data["StorageTable"]['10']["I"]}}</td>
            <td>{{$data["StorageTable"]['10']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['10']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['10']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['10']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['10']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">20</td>
            <td>{{$data["StorageTable"]['20']["I"]}}</td>
            <td>{{$data["StorageTable"]['20']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['20']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['20']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['20']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['20']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">30</td>
            <td>{{$data["StorageTable"]['30']["I"]}}</td>
            <td>{{$data["StorageTable"]['30']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['30']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['30']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['30']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['30']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">40</td>
            <td>{{$data["StorageTable"]['40']["I"]}}</td>
            <td>{{$data["StorageTable"]['40']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['40']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['40']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['40']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['40']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">50</td>
            <td>{{$data["StorageTable"]['50']["I"]}}</td>
            <td>{{$data["StorageTable"]['50']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['50']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['50']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['50']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['50']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">60</td>
            <td>{{$data["StorageTable"]['60']["I"]}}</td>
            <td>{{$data["StorageTable"]['60']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['60']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['60']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['60']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['60']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">70</td>
            <td>{{$data["StorageTable"]['70']["I"]}}</td>
            <td>{{$data["StorageTable"]['70']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['70']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['70']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['70']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['70']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">80</td>
            <td>{{$data["StorageTable"]['80']["I"]}}</td>
            <td>{{$data["StorageTable"]['80']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['80']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['80']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['80']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['80']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">90</td>
            <td>{{$data["StorageTable"]['90']["I"]}}</td>
            <td>{{$data["StorageTable"]['90']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['90']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['90']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['90']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['90']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">100</td>
            <td>{{$data["StorageTable"]['100']["I"]}}</td>
            <td>{{$data["StorageTable"]['100']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['100']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['100']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['100']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['100']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">110</td>
            <td>{{$data["StorageTable"]['110']["I"]}}</td>
            <td>{{$data["StorageTable"]['110']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['110']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['110']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['110']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['110']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">120</td>
            <td>{{$data["StorageTable"]['120']["I"]}}</td>
            <td>{{$data["StorageTable"]['120']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['120']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['120']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['120']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['120']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">130</td>
            <td>{{$data["StorageTable"]['130']["I"]}}</td>
            <td>{{$data["StorageTable"]['130']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['130']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['130']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['130']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['130']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">140</td>
            <td>{{$data["StorageTable"]['140']["I"]}}</td>
            <td>{{$data["StorageTable"]['140']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['140']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['140']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['140']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['140']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">150</td>
            <td>{{$data["StorageTable"]['150']["I"]}}</td>
            <td>{{$data["StorageTable"]['150']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['150']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['150']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['150']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['150']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">160</td>
            <td>{{$data["StorageTable"]['160']["I"]}}</td>
            <td>{{$data["StorageTable"]['160']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['160']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['160']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['160']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['160']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">170</td>
            <td>{{$data["StorageTable"]['170']["I"]}}</td>
            <td>{{$data["StorageTable"]['170']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['170']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['170']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['170']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['170']["Sv"]}}</td>
        </tr>
        <tr>
            <td class="text-center bg-secondary">180</td>
            <td>{{$data["StorageTable"]['180']["I"]}}</td>
            <td>{{$data["StorageTable"]['180']["Ix"]}}</td>
            <td>{{$data["StorageTable"]['180']["Pdq"]}}</td>
            <td>{{$data["StorageTable"]['180']["TraAv"]}}</td>
            <td>{{$data["StorageTable"]['180']["TriAv"]}}</td>
            <td>{{$data["StorageTable"]['180']["Sv"]}}</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th class="text-end bg-secondary" colspan="6">Max. Required Storage <small>(m<sup>3</sup>)</small></th>
            <th class="bg-secondary">{{$data["MaxStorage"]}}</th>
        </tr>
        </tfoot>
    </table>
</div>
</body>
