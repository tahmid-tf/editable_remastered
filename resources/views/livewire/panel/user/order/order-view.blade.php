<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">
    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    <div>
        <h5 class="h5_text_size">
            Orders</h5>
    </div>

    <div class="d-flex flex-wrap justify-content-between" style="margin: 0 10px; padding-bottom: 2rem">
        <div>
            <input type="text" placeholder="Search" class="input_table">
        </div>
        <div>
            <button class="box_button">
                New Order
            </button>
        </div>
    </div>


    {{-- ------------------------------------------------- Table Code -------------------------------------------------  --}}

    <div class="table-container">
        <table id="myTable">
            <thead>
            <tr>
                <th>#<span class="icon">⇅</span>
                </th>
                <th>
                    Name
                </th>
                <th style="cursor: pointer;">
                    Orders Completed
                    <span class="icon">⇅</span>
                </th>
                <th>
                    Orders Pending
                    <span class="icon">⇅</span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>1</td>
                <td>1</td>
                <td>0</td>
                <td>1</td>
                <td>
                    <i class="fas fa-pen" style="cursor: pointer"></i>
                    <i class="fas fa-trash-alt" style="cursor: pointer; margin-left: 15px"></i>
                </td>
            </tr>

            </tbody>
        </table>
    </div>


{{--    <div>--}}
{{--        {{ $editors->links('vendor.pagination.custom') }}--}}
{{--    </div>--}}

</div>
