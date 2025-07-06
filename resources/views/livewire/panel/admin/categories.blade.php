<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">
    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    <div>
        <h5 class="h5_text_size">Categories</h5>
    </div>

    <div class="d-flex flex-wrap justify-content-between" style="margin: 0 10px; padding-bottom: 2rem">
        <div>
            <input type="text" placeholder="Search" class="input_table" wire:model.live="search">
        </div>
        <div>
            <button class="box_button" wire:click="createCategoryModalVisibility(true)">
                Create Category
            </button>
        </div>
    </div>

    {{-- ------------------------------------------------- Table Code ------------------------------------------------- --}}

    <div class="table-container">
        <table id="myTable">
            <thead>
            <tr>
                <th wire:click="sortBy('id')" style="cursor: pointer;"># <span class="icon">⇅</span></th>
                <th >Name</th>
                <th>Style Price</th>
                <th>Style Threshold</th>
                <th>Culling Price</th>
                <th >Culling Threshold</th>
                <th >Skin Retouch Price</th>
                <th >Skin Retouch Threshold</th>
                <th >Preview Edit Price</th>
                <th >Preview Edit Threshold</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr wire:key="{{ $category->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->style_price }}</td>
                    <td>{{ $category->style_threshold }}</td>
                    <td>{{ $category->culling_price }}</td>
                    <td>{{ $category->culling_threshold }}</td>
                    <td>{{ $category->skin_retouch_price }}</td>
                    <td>{{ $category->skin_retouch_threshold }}</td>
                    <td>{{ $category->preview_edit_price }}</td>
                    <td>{{ $category->preview_edit_threshold }}</td>
                    <td>
                        <i class="fas fa-pen" style="cursor: pointer"
                           wire:click="updateCategoryModalVisibility(true, {{ $category->id }})"></i>
                        <i class="fas fa-trash-alt" style="cursor: pointer; margin-left: 15px"
                           wire:click="removeCategoryModalVisibility(true, {{ $category->id }})"></i>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">No categories found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $categories->links('vendor.pagination.custom') }}
    </div>


{{--    <script src="{{ asset('modified/table.js') }}"></script>--}}

    {{-- ===========================
    ✅ Full Category Create Snippet
    =========================== --}}

    @if($create_category_modal)
        <div class="h-full bg-gray-100">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm max-h-[90vh] overflow-y-auto">
                    <button wire:click="createCategoryModalVisibility(false)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4" style="color: black">Create Category</h2>

                    {{-- 🔽 Scrollable content --}}
                    <div class="overflow-y-auto max-h-[70vh]">
                        <form wire:submit.prevent="createCategory">

                            {{-- Copy same inputs --}}

                            {{-- Name --}}
                            <label class="block text-sm mb-2" style="color: black">Name</label>
                            @error('name') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Name"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="name" style="color: black"/>

                            {{-- Same for other fields --}}

                            <label class="block text-sm mb-2" style="color: black">Style Price</label>
                            @error('style_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" placeholder="Style Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="style_price" style="color: black"/>

                            <label class="block text-sm mb-2" style="color: black">Style Threshold</label>
                            @error('style_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Style Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="style_threshold" style="color: black"/>

                            {{-- Repeat for Culling, Skin Retouch, Preview Edit --}}

                            <label class="block text-sm mb-2" style="color: black">Culling Price</label>
                            @error('culling_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" placeholder="Culling Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="culling_price" style="color: black"/>

                            <label class="block text-sm mb-2" style="color: black">Culling Threshold</label>
                            @error('culling_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Culling Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="culling_threshold" style="color: black"/>

                            <label class="block text-sm mb-2" style="color: black">Skin Retouch Price</label>
                            @error('skin_retouch_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" placeholder="Skin Retouch Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="skin_retouch_price" style="color: black"/>

                            <label class="block text-sm mb-2" style="color: black">Skin Retouch Threshold</label>
                            @error('skin_retouch_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Skin Retouch Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="skin_retouch_threshold" style="color: black"/>

                            <label class="block text-sm mb-2" style="color: black">Preview Edit Price</label>
                            @error('preview_edit_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" placeholder="Preview Edit Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="preview_edit_price" style="color: black"/>

                            <label class="block text-sm mb-2" style="color: black">Preview Edit Threshold</label>
                            @error('preview_edit_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Preview Edit Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="preview_edit_threshold" style="color: black"/>

                            <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                Create Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- =======================
    ✅ UPDATE MODAL: ALL FIELDS
    ======================= --}}

    @if($update_category_modal)
        <div class="h-full bg-gray-100">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm max-h-[90vh] overflow-y-auto">
                    <button wire:click="updateCategoryModalVisibility(false, null)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4" style="color: black">Update Category</h2>

                    <div class="overflow-y-auto max-h-[70vh]">
                        <form wire:submit.prevent="updateCategory">

                            {{-- ✅ Name --}}
                            <label class="block text-sm mb-2" style="color: black">Name</label>
                            @error('name') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Name"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="name" style="color: black"/>

                            {{-- ✅ Style Price --}}
                            <label class="block text-sm mb-2" style="color: black">Style Price</label>
                            @error('style_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" step="0.01" placeholder="Style Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="style_price" style="color: black"/>

                            {{-- ✅ Style Threshold --}}
                            <label class="block text-sm mb-2" style="color: black">Style Threshold</label>
                            @error('style_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Style Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="style_threshold" style="color: black"/>

                            {{-- ✅ Culling Price --}}
                            <label class="block text-sm mb-2" style="color: black">Culling Price</label>
                            @error('culling_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" step="0.01" placeholder="Culling Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="culling_price" style="color: black"/>

                            {{-- ✅ Culling Threshold --}}
                            <label class="block text-sm mb-2" style="color: black">Culling Threshold</label>
                            @error('culling_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Culling Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="culling_threshold" style="color: black"/>

                            {{-- ✅ Skin Retouch Price --}}
                            <label class="block text-sm mb-2" style="color: black">Skin Retouch Price</label>
                            @error('skin_retouch_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" step="0.01" placeholder="Skin Retouch Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="skin_retouch_price" style="color: black"/>

                            {{-- ✅ Skin Retouch Threshold --}}
                            <label class="block text-sm mb-2" style="color: black">Skin Retouch Threshold</label>
                            @error('skin_retouch_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Skin Retouch Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="skin_retouch_threshold" style="color: black"/>

                            {{-- ✅ Preview Edit Price --}}
                            <label class="block text-sm mb-2" style="color: black">Preview Edit Price</label>
                            @error('preview_edit_price') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="number" step="0.01" placeholder="Preview Edit Price"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="preview_edit_price" style="color: black"/>

                            {{-- ✅ Preview Edit Threshold --}}
                            <label class="block text-sm mb-2" style="color: black">Preview Edit Threshold</label>
                            @error('preview_edit_threshold') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror
                            <input type="text" placeholder="Preview Edit Threshold"
                                   class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                                   wire:model="preview_edit_threshold" style="color: black"/>

                            <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                                Update Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif



    {{-- ------------------------------------------- Remove Category ------------------------------------------- --}}
    @if($remove_category_modal)
        <div class="h-full bg-gray-100">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
                    <button wire:click.prevent="removeCategoryModalVisibility(false, null)"
                            type="button"
                            class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                            aria-label="Close">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4 text-red-600">Remove Category</h2>
                    <p class="text-sm text-gray-700 mb-6">
                        Are you sure you want to remove this category? This action cannot be undone.
                    </p>
                    <button wire:click.prevent="removeCategory"
                            class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
                        Remove Category
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
