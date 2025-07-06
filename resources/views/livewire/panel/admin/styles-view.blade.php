<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">
    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    {{-- Header with title and create button --}}
    <div>
        <h5 class="h5_text_size">Styles</h5>
    </div>

    {{-- Search input + Create button --}}
    <div class="d-flex flex-wrap justify-content-between" style="margin: 0 10px; padding-bottom: 2rem">
        <div>
            <input
                type="text"
                placeholder="Search"
                wire:model.live="search"
                class="input_table"
            />
        </div>
        <div>
            <button
                class="box_button"
                wire:click="createStyleModalVisibility(true)"
            >
                Create Style
            </button>
        </div>
    </div>

    {{-- Table container --}}
    <div class="table-container">
        <table id="myTable">
            <thead>
            <tr>
                <th wire:click="sortBy('id')" style="cursor: pointer;"># <span class="icon">⇅</span></th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Categories</th>
                <th>Is Additional</th>
                <th>Culling</th>
                <th>Skin Retouch</th>
                <th>Preview Edit</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($styles as $style)
                <tr wire:key="{{ $style->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $style->name }}</td>
                    <td>{{ $style->description }}</td>
                    <td>
                        @if($style->image)
                            <img src="{{ asset('storage/'.$style->image) }}" alt="Image"
                                 class="w-16 h-16 object-cover rounded">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ implode(', ', json_decode($style->categories, true) ?? []) }}</td>
                    <td>{{ $style->is_additional }}</td>
                    <td>{{ $style->is_culling ? 'yes' : 'no' }}</td>
                    <td>{{ $style->is_skin_retouch ? 'yes' : 'no' }}</td>
                    <td>{{ $style->is_preview_edit ? 'yes' : 'no' }}</td>
                    <td>
                        <i
                            class="fas fa-pen"
                            style="cursor: pointer"
                            wire:click="updateStyleModalVisibility(true, {{ $style->id }})"
                            title="Edit"

                        ></i>
                        <i
                            class="fas fa-trash-alt"
                            style="cursor: pointer; margin-left: 15px"
                            wire:click="removeStyleModalVisibility(true, {{ $style->id }})"
                            title="Delete"
                        ></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No styles found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $styles->links('vendor.pagination.custom') }}
    </div>

    {{-- Create Modal --}}
    @if($create_style_modal)
        @include('livewire.panel.admin.style_component.styles-create-modal')
    @endif

    {{-- Update Modal --}}
    @if($update_style_modal)
        @include('livewire.panel.admin.style_component.styles-update-modal')
    @endif

    {{-- Remove Modal --}}
    @if($remove_style_modal)
        <div class="h-full bg-gray-100">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
                    <button wire:click.prevent="removeStyleModalVisibility(false, null)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4 text-red-600">Remove Style</h2>
                    <p class="text-sm text-gray-700 mb-6">
                        Are you sure you want to delete this style?
                    </p>
                    <button wire:click.prevent="removeStyle"
                            class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
                        Remove Style
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
