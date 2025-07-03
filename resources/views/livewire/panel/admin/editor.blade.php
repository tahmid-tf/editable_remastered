<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">


    {{-- ------------------------------------------------- Table Code -------------------------------------------------  --}}

    <div class="table-container">
        <table id="myTable">
            <thead>
            <tr>
                <th data-type="string">Name <span class="icon">⇅</span></th>
                <th data-type="number">
                    Orders Completed <span class="icon">⇅</span>
                </th>
                <th data-type="number">
                    Orders Pending <span class="icon">⇅</span>
                </th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <tr>
                <td>John Mist Doe</td>
                <td>100</td>
                <td>10</td>
                <td>
                    <i class="fas fa-trash-alt"></i>
                    <i class="fas fa-pen right-padding"></i>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination" id="pagination"></div>

    <script src="{{ asset('modified/table.js') }}"></script>
</div>
