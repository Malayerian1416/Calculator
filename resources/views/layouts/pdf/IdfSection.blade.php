<style>
    body{
        direction: ltr;
        font-size: 14px;
    }
    .container{
        width: 100%;
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
    .idf-table thead tr th{
        border: 1px solid #464646;
    }
    table tbody tr td{
        border: 1px solid #464646;
    }
    .bg-secondary{
        background-color: #dcdcdc;
    }
    .text-center{
        text-align: center;
    }
    .development-table td{
        width: 50%;
    }
    .idf-table td{
        width: 12%;
    }
    .idf-table td:first-child {
        width: 28%;
    }
    @page {
        footer: page-footer;
    }
</style>
<body>
<htmlpagefooter name="page-footer">
    {PAGENO}/{nbpg}
</htmlpagefooter>
<div class="container">
    <h4 style="margin-bottom: 5px">IDF Table</h4>
    <table class="text-center idf-table">
        <thead>
        <tr>
            <th align="center" class="bg-secondary text-center">Return Period (Years)</th>
            <th align="center" class="bg-secondary text-center">2</th>
            <th align="center" class="bg-secondary text-center">5</th>
            <th align="center" class="bg-secondary text-center">10</th>
            <th align="center" class="bg-secondary text-center">25</th>
            <th align="center" class="bg-secondary text-center">50</th>
            <th align="center" class="bg-secondary text-center">100</th>
        </tr>
        </thead>
        <tbody>
        <tbody>
        <tr>
            <td class="bg-secondary">A</td>
            <td>{{$data["Idf"]["A"]["2"]}}</td>
            <td>{{$data["Idf"]["A"]["5"]}}</td>
            <td>{{$data["Idf"]["A"]["10"]}}</td>
            <td>{{$data["Idf"]["A"]["25"]}}</td>
            <td>{{$data["Idf"]["A"]["50"]}}</td>
            <td>{{$data["Idf"]["A"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">B</td>
            <td>{{$data["Idf"]["B"]["2"]}}</td>
            <td>{{$data["Idf"]["B"]["5"]}}</td>
            <td>{{$data["Idf"]["B"]["10"]}}</td>
            <td>{{$data["Idf"]["B"]["25"]}}</td>
            <td>{{$data["Idf"]["B"]["50"]}}</td>
            <td>{{$data["Idf"]["B"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">D</td>
            <td>{{$data["Idf"]["D"]["2"]}}</td>
            <td>{{$data["Idf"]["D"]["5"]}}</td>
            <td>{{$data["Idf"]["D"]["10"]}}</td>
            <td>{{$data["Idf"]["D"]["25"]}}</td>
            <td>{{$data["Idf"]["D"]["50"]}}</td>
            <td>{{$data["Idf"]["D"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">10 min</td>
            <td>{{$data["Idf"]["m10"]["2"]}}</td>
            <td>{{$data["Idf"]["m10"]["5"]}}</td>
            <td>{{$data["Idf"]["m10"]["10"]}}</td>
            <td>{{$data["Idf"]["m10"]["25"]}}</td>
            <td>{{$data["Idf"]["m10"]["50"]}}</td>
            <td>{{$data["Idf"]["m10"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">15 min</td>
            <td>{{$data["Idf"]["m15"]["2"]}}</td>
            <td>{{$data["Idf"]["m15"]["5"]}}</td>
            <td>{{$data["Idf"]["m15"]["10"]}}</td>
            <td>{{$data["Idf"]["m15"]["25"]}}</td>
            <td>{{$data["Idf"]["m15"]["50"]}}</td>
            <td>{{$data["Idf"]["m15"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">30 min</td>
            <td>{{$data["Idf"]["m30"]["2"]}}</td>
            <td>{{$data["Idf"]["m30"]["5"]}}</td>
            <td>{{$data["Idf"]["m30"]["10"]}}</td>
            <td>{{$data["Idf"]["m30"]["25"]}}</td>
            <td>{{$data["Idf"]["m30"]["50"]}}</td>
            <td>{{$data["Idf"]["m30"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">1 hr</td>
            <td>{{$data["Idf"]["h1"]["2"]}}</td>
            <td>{{$data["Idf"]["h1"]["5"]}}</td>
            <td>{{$data["Idf"]["h1"]["10"]}}</td>
            <td>{{$data["Idf"]["h1"]["25"]}}</td>
            <td>{{$data["Idf"]["h1"]["50"]}}</td>
            <td>{{$data["Idf"]["h1"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">2 hr</td>
            <td>{{$data["Idf"]["h2"]["2"]}}</td>
            <td>{{$data["Idf"]["h2"]["5"]}}</td>
            <td>{{$data["Idf"]["h2"]["10"]}}</td>
            <td>{{$data["Idf"]["h2"]["25"]}}</td>
            <td>{{$data["Idf"]["h2"]["50"]}}</td>
            <td>{{$data["Idf"]["h2"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">6 hr</td>
            <td>{{$data["Idf"]["h6"]["2"]}}</td>
            <td>{{$data["Idf"]["h6"]["5"]}}</td>
            <td>{{$data["Idf"]["h6"]["10"]}}</td>
            <td>{{$data["Idf"]["h6"]["25"]}}</td>
            <td>{{$data["Idf"]["h6"]["50"]}}</td>
            <td>{{$data["Idf"]["h6"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">12 hr</td>
            <td>{{$data["Idf"]["h12"]["2"]}}</td>
            <td>{{$data["Idf"]["h12"]["5"]}}</td>
            <td>{{$data["Idf"]["h12"]["10"]}}</td>
            <td>{{$data["Idf"]["h12"]["25"]}}</td>
            <td>{{$data["Idf"]["h12"]["50"]}}</td>
            <td>{{$data["Idf"]["h12"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">24 hr</td>
            <td>{{$data["Idf"]["h24"]["2"]}}</td>
            <td>{{$data["Idf"]["h24"]["5"]}}</td>
            <td>{{$data["Idf"]["h24"]["10"]}}</td>
            <td>{{$data["Idf"]["h24"]["25"]}}</td>
            <td>{{$data["Idf"]["h24"]["50"]}}</td>
            <td>{{$data["Idf"]["h24"]["100"]}}</td>
        </tr>
        </tbody>
    </table>
    <h4 style="margin-bottom: 5px">PRE DEVELOPMENT</h4>
    <table class="development-table text-center">
        <tbody>
        <tr>
            <td class="bg-secondary">Project Area, A (ha)</td>
            <td>{{$data["TotalSiteArea"]["pre"]["area"] / 10000}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Runoff Coefficient, C</td>
            <td>{{$data["TotalSiteArea"]["pre"]["runoff_c"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Time of Concentration, T (min)</td>
            <td>{{$data["TotalSiteArea"]["pre"]["toc"]}}</td>
        </tr>
        </tbody>
    </table>
    <table class="idf-table text-center">
        <thead>
        <tr>
            <th align="center" class="bg-secondary">Return Period (Years)</th>
            <th align="center" class="bg-secondary">2</th>
            <th align="center" class="bg-secondary">5</th>
            <th align="center" class="bg-secondary">10</th>
            <th align="center" class="bg-secondary">25</th>
            <th align="center" class="bg-secondary">50</th>
            <th align="center" class="bg-secondary">100</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-secondary">Modified C ratio, a</td>
            <td>{{$data["Mcr_a"]["pre"]["2"]}}</td>
            <td>{{$data["Mcr_a"]["pre"]["5"]}}</td>
            <td>{{$data["Mcr_a"]["pre"]["10"]}}</td>
            <td>{{$data["Mcr_a"]["pre"]["25"]}}</td>
            <td>{{$data["Mcr_a"]["pre"]["50"]}}</td>
            <td>{{$data["Mcr_a"]["pre"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified C intercept, b</td>
            <td>{{$data["Mci_b"]["pre"]["2"]}}</td>
            <td>{{$data["Mci_b"]["pre"]["5"]}}</td>
            <td>{{$data["Mci_b"]["pre"]["10"]}}</td>
            <td>{{$data["Mci_b"]["pre"]["25"]}}</td>
            <td>{{$data["Mci_b"]["pre"]["50"]}}</td>
            <td>{{$data["Mci_b"]["pre"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified C</td>
            <td>{{$data["Mc"]["pre"]["2"]}}</td>
            <td>{{$data["Mc"]["pre"]["5"]}}</td>
            <td>{{$data["Mc"]["pre"]["10"]}}</td>
            <td>{{$data["Mc"]["pre"]["25"]}}</td>
            <td>{{$data["Mc"]["pre"]["50"]}}</td>
            <td>{{$data["Mc"]["pre"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">I (mm/hr)</td>
            <td>{{$data["I"]["pre"]["2"]}}</td>
            <td>{{$data["I"]["pre"]["5"]}}</td>
            <td>{{$data["I"]["pre"]["10"]}}</td>
            <td>{{$data["I"]["pre"]["25"]}}</td>
            <td>{{$data["I"]["pre"]["50"]}}</td>
            <td>{{$data["I"]["pre"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Q (litres/sec)</td>
            <td>{{$data["Q_l"]["pre"]["2"]}}</td>
            <td>{{$data["Q_l"]["pre"]["5"]}}</td>
            <td>{{$data["Q_l"]["pre"]["10"]}}</td>
            <td>{{$data["Q_l"]["pre"]["25"]}}</td>
            <td>{{$data["Q_l"]["pre"]["50"]}}</td>
            <td>{{$data["Q_l"]["pre"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Q (m<sup>3</sup>/sec)</td>
            <td>{{$data["Q_m"]["pre"]["2"]}}</td>
            <td>{{$data["Q_m"]["pre"]["5"]}}</td>
            <td>{{$data["Q_m"]["pre"]["10"]}}</td>
            <td>{{$data["Q_m"]["pre"]["25"]}}</td>
            <td>{{$data["Q_m"]["pre"]["50"]}}</td>
            <td>{{$data["Q_m"]["pre"]["100"]}}</td>
        </tr>
        </tbody>
    </table>
    <h4 style="margin-bottom: 5px">POST DEVELOPMENT</h4>
    <table class="development-table text-center">
        <tbody>
        <tr>
            <td class="bg-secondary">Project Area, A (ha)</td>
            <td>{{$data["TotalSiteArea"]["post"]["area"] / 10000}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Runoff Coefficient, C</td>
            <td>{{$data["TotalSiteArea"]["post"]["runoff_c"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Time of Concentration, T (min)</td>
            <td>{{$data["TotalSiteArea"]["post"]["toc"]}}</td>
        </tr>
        </tbody>
    </table>
    <table class="text-center idf-table text-center">
        <thead>
        <tr>
            <th align="center" class="bg-secondary">Return Period (Years)</th>
            <th align="center" class="bg-secondary">2</th>
            <th align="center" class="bg-secondary">5</th>
            <th align="center" class="bg-secondary">10</th>
            <th align="center" class="bg-secondary">25</th>
            <th align="center" class="bg-secondary">50</th>
            <th align="center" class="bg-secondary">100</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-secondary">Modified C ratio, a</td>
            <td>{{$data["Mcr_a"]["post"]["2"]}}</td>
            <td>{{$data["Mcr_a"]["post"]["5"]}}</td>
            <td>{{$data["Mcr_a"]["post"]["10"]}}</td>
            <td>{{$data["Mcr_a"]["post"]["25"]}}</td>
            <td>{{$data["Mcr_a"]["post"]["50"]}}</td>
            <td>{{$data["Mcr_a"]["post"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified C intercept, b</td>
            <td>{{$data["Mci_b"]["post"]["2"]}}</td>
            <td>{{$data["Mci_b"]["post"]["5"]}}</td>
            <td>{{$data["Mci_b"]["post"]["10"]}}</td>
            <td>{{$data["Mci_b"]["post"]["25"]}}</td>
            <td>{{$data["Mci_b"]["post"]["50"]}}</td>
            <td>{{$data["Mci_b"]["post"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified C</td>
            <td>{{$data["Mc"]["post"]["2"]}}</td>
            <td>{{$data["Mc"]["post"]["5"]}}</td>
            <td>{{$data["Mc"]["post"]["10"]}}</td>
            <td>{{$data["Mc"]["post"]["25"]}}</td>
            <td>{{$data["Mc"]["post"]["50"]}}</td>
            <td>{{$data["Mc"]["post"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">I (mm/hr)</td>
            <td>{{$data["I"]["post"]["2"]}}</td>
            <td>{{$data["I"]["post"]["5"]}}</td>
            <td>{{$data["I"]["post"]["10"]}}</td>
            <td>{{$data["I"]["post"]["25"]}}</td>
            <td>{{$data["I"]["post"]["50"]}}</td>
            <td>{{$data["I"]["post"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Q (litres/sec)</td>
            <td>{{$data["Q_l"]["post"]["2"]}}</td>
            <td>{{$data["Q_l"]["post"]["5"]}}</td>
            <td>{{$data["Q_l"]["post"]["10"]}}</td>
            <td>{{$data["Q_l"]["post"]["25"]}}</td>
            <td>{{$data["Q_l"]["post"]["50"]}}</td>
            <td>{{$data["Q_l"]["post"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Q (m<sup>3</sup>/sec)</td>
            <td>{{$data["Q_m"]["post"]["2"]}}</td>
            <td>{{$data["Q_m"]["post"]["5"]}}</td>
            <td>{{$data["Q_m"]["post"]["10"]}}</td>
            <td>{{$data["Q_m"]["post"]["25"]}}</td>
            <td>{{$data["Q_m"]["post"]["50"]}}</td>
            <td>{{$data["Q_m"]["post"]["100"]}}</td>
        </tr>
        </tbody>
    </table>
    <h4 style="margin-bottom: 5px">ALLOWED SCENARIO DEVELOPMENT</h4>
    <table class="development-table text-center">
        <tbody>
        <tr>
            <td class="bg-secondary">Project Area, A (ha)</td>
            <td>{{$data["TotalSiteArea"]["allowedScenario"]["area"] / 10000}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Runoff Coefficient, C</td>
            <td>{{$data["TotalSiteArea"]["allowedScenario"]["runoff_c"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Time of Concentration, T (min)</td>
            <td>{{$data["TotalSiteArea"]["allowedScenario"]["toc"]}}</td>
        </tr>
        </tbody>
    </table>
    <table class="text-center idf-table text-center">
        <thead>
        <tr>
            <th align="center" class="bg-secondary">Return Period (Years)</th>
            <th align="center" class="bg-secondary">2</th>
            <th align="center" class="bg-secondary">5</th>
            <th align="center" class="bg-secondary">10</th>
            <th align="center" class="bg-secondary">25</th>
            <th align="center" class="bg-secondary">50</th>
            <th align="center" class="bg-secondary">100</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="bg-secondary">Modified C ratio, a</td>
            <td>{{$data["Mcr_a"]["allowedScenario"]["2"]}}</td>
            <td>{{$data["Mcr_a"]["allowedScenario"]["5"]}}</td>
            <td>{{$data["Mcr_a"]["allowedScenario"]["10"]}}</td>
            <td>{{$data["Mcr_a"]["allowedScenario"]["25"]}}</td>
            <td>{{$data["Mcr_a"]["allowedScenario"]["50"]}}</td>
            <td>{{$data["Mcr_a"]["allowedScenario"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified C intercept, b</td>
            <td>{{$data["Mci_b"]["allowedScenario"]["2"]}}</td>
            <td>{{$data["Mci_b"]["allowedScenario"]["5"]}}</td>
            <td>{{$data["Mci_b"]["allowedScenario"]["10"]}}</td>
            <td>{{$data["Mci_b"]["allowedScenario"]["25"]}}</td>
            <td>{{$data["Mci_b"]["allowedScenario"]["50"]}}</td>
            <td>{{$data["Mci_b"]["allowedScenario"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Modified C</td>
            <td>{{$data["Mc"]["allowedScenario"]["2"]}}</td>
            <td>{{$data["Mc"]["allowedScenario"]["5"]}}</td>
            <td>{{$data["Mc"]["allowedScenario"]["10"]}}</td>
            <td>{{$data["Mc"]["allowedScenario"]["25"]}}</td>
            <td>{{$data["Mc"]["allowedScenario"]["50"]}}</td>
            <td>{{$data["Mc"]["allowedScenario"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">I (mm/hr)</td>
            <td>{{$data["I"]["allowedScenario"]["2"]}}</td>
            <td>{{$data["I"]["allowedScenario"]["5"]}}</td>
            <td>{{$data["I"]["allowedScenario"]["10"]}}</td>
            <td>{{$data["I"]["allowedScenario"]["25"]}}</td>
            <td>{{$data["I"]["allowedScenario"]["50"]}}</td>
            <td>{{$data["I"]["allowedScenario"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Q (litres/sec)</td>
            <td>{{$data["Q_l"]["allowedScenario"]["2"]}}</td>
            <td>{{$data["Q_l"]["allowedScenario"]["5"]}}</td>
            <td>{{$data["Q_l"]["allowedScenario"]["10"]}}</td>
            <td>{{$data["Q_l"]["allowedScenario"]["25"]}}</td>
            <td>{{$data["Q_l"]["allowedScenario"]["50"]}}</td>
            <td>{{$data["Q_l"]["allowedScenario"]["100"]}}</td>
        </tr>
        <tr>
            <td class="bg-secondary">Q (m<sup>3</sup>/sec)</td>
            <td>{{$data["Q_m"]["allowedScenario"]["2"]}}</td>
            <td>{{$data["Q_m"]["allowedScenario"]["5"]}}</td>
            <td>{{$data["Q_m"]["allowedScenario"]["10"]}}</td>
            <td>{{$data["Q_m"]["allowedScenario"]["25"]}}</td>
            <td>{{$data["Q_m"]["allowedScenario"]["50"]}}</td>
            <td>{{$data["Q_m"]["allowedScenario"]["100"]}}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
