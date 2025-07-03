<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">
    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    <div>
        <h5 class="h5_text_size">
            Editors</h5>
    </div>

    <div class="d-flex justify-content-between" style="margin: 0px 10px; padding-bottom: 2rem">
        <div>
            <input type="text" placeholder="Search" class="input_table">
        </div>
        <div>
            <button class="box_button" wire:click="createEditorModalVisibility(true)">
                Create Editor
            </button>
        </div>
    </div>


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

            @foreach($editors as $editor)

                <tr wire:key="{{ $editor->id }}">
                    <td>{{ $editor->name }}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                        <i class="fas fa-trash-alt"></i>
                        <i class="fas fa-pen right-padding"></i>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination" id="pagination"></div>


    <script src="{{ asset('modified/table.js') }}"></script>


    {{--    ------------------------------------------- Create Editor -------------------------------------------  --}}

    @if($create_editor_modal)
        <div class="h-full bg-gray-100">
            <!-- Backdrop overlay with blur -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <!-- Modal box -->
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
                    <!-- Better cross button (more visible) -->
                    <button wire:click="createEditorModalVisibility(false)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4" style="color: black">Create Editor</h2>

                    {{--  ----------------- crate form ----------------- --}}

                    <form wire:submit.prevent="createEditor">

                        <label class="block text-sm mb-2" for="name" style="color: black">Name</label>

                        @error('name')
                        <div style="color: red; font-size: 13px;" class="pb-1">{{ $message }}</div>
                        @enderror

                        <input
                            id="name"
                            type="text"
                            value=""
                            placeholder="Enter Name"
                            class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring focus:border-blue-500"
                            style="color: black"
                            wire:model="name"
                        />


                        <button
                            class="w-full bg-black text-white py-2 rounded hover:bg-gray-800"
                        >
                            Create Editor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
