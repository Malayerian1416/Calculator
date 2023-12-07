<table>
    <thead>
    <tr>
        <th style="color: #ffffff;background-color: #343A40">
            Land Use
        </th>
        <th style="color: #ffffff;background-color: #343A40">
            Area (m<sup>2</sup>)
        </th>
        <th style="color: #ffffff;background-color: #343A40">
            Runoff C
        </th>
        <th style="color: #ffffff;background-color: #343A40">
            Impervious
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $row)
        <tr>
            <td>{{$row["land_use"]}}</td>
            <td>{{$row["area"]}}</td>
            <td>{{$row["runoff_c"]}}</td>
            <td>{{$row["impervious"]}}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>
