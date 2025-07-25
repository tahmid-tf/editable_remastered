<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">
    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    <div>
        <h5 class="h5_text_size">
            Editors</h5>
    </div>

    <div class="d-flex flex-wrap justify-content-between" style="margin: 0 10px; padding-bottom: 2rem">
        <div>
            <input type="text" placeholder="Search" class="input_table" wire:model.live="search">
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
                <th wire:click="sortBy('name')" wire:click="sortBy('name')">#
                    <span class="icon">⇅</span>
                </th>
                <th>
                    Name
                </th>
                <th wire:click="sortBy('orders_completed')" style="cursor: pointer;">
                    Orders Completed
                    <span class="icon">⇅</span>
                </th>
                <th wire:click="sortBy('orders_pending')" style="cursor: pointer;">
                    Orders Pending
                    <span class="icon">⇅</span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($editors as $editor)
                <tr wire:key="{{ $editor->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $editor->name }}</td>
                    <td>0</td>
                    <td>1</td>
                    <td>
                        <i class="fas fa-pen" style="cursor: pointer"
                           wire:click="updateEditorModalVisibility(true, {{ $editor->id }})"></i>
                        <i class="fas fa-trash-alt" style="cursor: pointer; margin-left: 15px"
                           wire:click="removeEditorModalVisibility(true, {{ $editor->id }})"></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No editors found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


    <div>
        {{ $editors->links('vendor.pagination.custom') }}
    </div>


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


    {{--  ------------------------------ update editor ------------------------------ --}}


    @if($update_editor_modal)
        <div class="h-full bg-gray-100">
            <!-- Backdrop overlay with blur -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <!-- Modal box -->
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
                    <!-- Better cross button (more visible) -->
                    <button wire:click="updateEditorModalVisibility(false, null)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4" style="color: black">Update Editor</h2>

                    {{--  ----------------- update form ----------------- --}}

                    <form wire:submit.prevent="updateEditor">

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

    {{--  ------------------------------ remove editor ------------------------------ --}}

    @if($remove_editor_modal)

        <div class="h-full bg-gray-100">
            <!-- Backdrop overlay with blur -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <!-- Modal box -->
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
                    <!-- Cross button -->
                    <button wire:click.prevent="removeEditorModalVisibility(false,null)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4 text-red-600">Remove Editor</h2>
                    <p class="text-sm text-gray-700 mb-6">
                        Are you sure you want to remove the editor? This action cannot be undone.
                    </p>
                    <button wire:click.prevent="removeEditor"
                            class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
                        Remove Editor
                    </button>
                </div>
            </div>
        </div>

    @endif


</div>
