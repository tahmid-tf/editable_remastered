<div class="h-full bg-gray-100">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm max-h-[90vh] overflow-y-auto">
            <button wire:click="createStyleModalVisibility(false)"
                    type="button"
                    class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                    aria-label="Close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <h2 class="text-lg font-semibold mb-4" style="color: black">Create Style</h2>

            <form wire:submit.prevent="createStyle" class="overflow-y-auto max-h-[70vh]">

                <!-- Name -->

                @error('name') <div class="text-red-600 text-xs pb-1">{{ $message }}</div> @enderror

                <label class="block text-sm mb-2" style="color: black">Name</label>
                <input type="text" wire:model="name"
                       class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                       placeholder="Style Name" style="color: black"/>

                <!-- Description -->
                <label class="block text-sm mb-2" style="color: black">Description</label>
                <textarea wire:model="description" rows="3"
                          class="w-full border border-gray-300 rounded px-3 py-2 mb-4"
                          style="color: black"></textarea>

                <!-- Image -->
                <label class="block text-sm mb-2" style="color: black">Upload Image</label>
                <input type="file" wire:model="image" class="mb-4 w-full" />
                @if($image)
                    <img src="{{ $image->temporaryUrl() }}"
                         class="w-full max-h-48 object-contain mb-4 border rounded" />
                @endif

                <!-- Categories (checkboxes) -->
                <label class="block text-sm mb-2" style="color: black">Categories</label>
                <div class="flex flex-wrap gap-4 mb-4">
                    @foreach($allCategories as $cat)
                        <label class="flex items-center gap-2" style="color: black">
                            <input type="checkbox" wire:model="selectedCategories" value="{{ $cat->name }}" class="accent-black">
                            {{ $cat->name }}
                        </label>
                    @endforeach
                </div>

                <!-- Is Additional -->
                <label class="block text-sm mb-2" style="color: black">Is Additional?</label>
                <div class="flex gap-4 mb-4" style="color: black">
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="is_additional" value="yes" class="accent-black" id="is-additional-yes" name="is_additional">
                        Yes
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model="is_additional" value="no" class="accent-black" id="is-additional-no" name="is_additional">
                        No
                    </label>
                </div>

                <!-- Options -->
                <label class="block text-sm mb-2" style="color: black">Available Options</label>
                <div class="flex flex-wrap gap-4 mb-4" style="color: black">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_culling" class="accent-black"> Culling
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_skin_retouch" class="accent-black"> Skin Retouch
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_preview_edit" class="accent-black"> Preview Edits
                    </label>
                </div>

                <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">
                    Create Style
                </button>
            </form>
        </div>
    </div>
</div>
