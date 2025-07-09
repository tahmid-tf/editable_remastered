<div class="container">

    <!-- Pick a style -->
    <h6 class="mb-3" style="font-weight: bold; text-align: left; padding-top: 1rem; font-size: 25px;">Pick a style</h6>
    <div class="row flex-column-reverse flex-lg-row">
        <!-- Cards -->
        <div class="col-lg-8">
            <div class="row g-3 mb-4">

                @foreach($styles as $style)

                    <div class="col-sm-6 col-md-4 mt-2">
                        <div class="card h-100">
                            <div
                                class="p-3"
                                style="background-color: #f8f8f8; border-radius: 12px"
                            >
                                <div>
                                    <input type="radio" name="radio_{{ $style->id }}"
                                           wire:click="selectMain({{ $style->id }})"/>
                                </div>
                                <img
                                    src="{{ asset('storage/'.$style->image) }}"
                                    class="card-img-top"
                                    alt="Classic Film Tones"
                                />
                                <div class="card-body">
                                    <h6 class="card-title font-weight-bold text-black">Classic Film Tones</h6>
                                    <p class="small text-black">Description</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>


        <!-- Price Box -->
        <div class="col-lg-4 mt-2">
            <div class="flex items-center justify-center h-full bg-black-50">
                <div class="max-w-sm w-full bg-white rounded-lg shadow p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <div class="bg-gray-200 rounded-full p-4">
                            <i class="fas fa-shopping-cart fa-2x text-black"></i>
                        </div>
                    </div>
                    <h1 class="text-3xl font-semibold mb-2 text-black">USD {{ $total_price }}</h1>
                    <p class="text-black mb-6">Basic Charge ({{ $category->name }})</p>
                    <div class="space-y-4 text-left text-sm text-black">

                        @if($is_culling)
                            <div class="flex justify-between">
                                <span>Culling ({{ $number_culling_items }} items)</span>
                                <span class="font-medium">${{ $culling_price }}</span>
                            </div>
                        @endif


                        @if($is_skin_retouching)
                            <div class="flex justify-between">
                                <span>Skin Retouching ({{ $number_skin_retouching_items }} items)</span>
                                <span class="font-medium">${{ $skin_retouch_price }}</span>
                            </div>
                        @endif

                        @if($preview_edits)
                            <div class="flex justify-between">
                                <span>Preview Edits</span>
                                <span class="font-medium"></span>
                            </div>
                        @endif
                        <hr/>

                        <div class="flex justify-between font-semibold">
                            <span>Amount</span>
                            <span>USD {{ $total_price }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="delivery" class="accent-black"/>
                                <span>Express Delivery</span>
                            </label>
                            <span class="font-medium">USD 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------------- Additional Color Styles --------------------------- -->
    <h6 class="mt-5 mb-3 text-black">Additional Color Styles</h6>

    <div class="row">
        <!-- Cards -->
        <div class="col-lg-8">
            <div class="row g-3 mb-4">

                @foreach($styles_additional as $style)

                    <!-- Card 1 -->
                    <div class="col-sm-6 col-md-4">
                        <div class="card h-100">
                            <div
                                class="p-3"
                                style="background-color: #f8f8f8; border-radius: 12px"
                            >
                                <div>
                                    <input type="checkbox" name="radio_{{ $style->id }}"
                                           wire:click="toggleAdditional({{ $style->id }})"/>
                                </div>
                                <img
                                    src="{{ asset('storage/'.$style->image) }}"
                                    class="card-img-top"
                                    alt="Classic Film Tones"
                                />
                                <div class="card-body">
                                    <h6 class="card-title font-weight-bold text-black">Classic Film Tones</h6>
                                    <p class="small text-black">Description</p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <!-- Additional Edits -->
    <h6 class="mb-3 text-black">Additional Edits</h6>

    <!-- ---------------------------- Culling Section ------------------------------------ -->

    @if($is_culling)
        <div class="mb-2" style="max-width: 300px">
            <label class="form-label small fw-bold text-black">
                <input type="checkbox" class="accent-black" id="cullingCheckbox" wire:model.live="cullingCheckbox" wire:change="culling_calculation_checkbox_change"/>
                Culling
            </label>


            @if($cullingCheckbox)

                <div id="cullingOptions" style="margin-top: 10px">
                    <label class="form-label small text-black"
                    >How many images are you sending us?</label
                    >
                    <input type="number" class="form-control mb-3" wire:model.live="culling_items" wire:input="culling_images_by_user"/>

                    <label class="form-label small text-black"
                    >How many images should we cull down to?</label
                    >
                    <input type="text" class="form-control mb-3"/>

                    <label class="form-label small text-black"
                    >How would you like us to mark your images?</label
                    >
                    <input type="text" class="form-control mb-3"/>
                </div>

            @endif

        </div>
    @endif

    <!-- ---------------------------- Skin Retouching Section ---------------------------- -->

    @if($is_skin_retouching)

        <div class="mb-2" style="max-width: 300px">
            <label class="form-label small fw-bold text-black">
                <input type="checkbox" class="accent-black" id="retouchingCheckbox" wire:model.live="skin_retouch" wire:change="skin_calculation_checkbox_change"/>
                Skin
                Retouching
            </label>


            @if($skin_retouch)

                <div id="retouchingOptions" style="margin-top: 10px" class="text-black">
                    <label class="form-label small"
                    >How would you like us to select the images for skin
                        retouching?</label
                    >
                    <input type="number" class="form-control mb-3" wire:model.live="skin_retouch_items" wire:input="skin_retouch_images_by_user"/>

                    <label class="form-label small"
                    >How many images should we cull down to?</label
                    >
                    <input type="text" class="form-control mb-3"/>

                    <label class="form-label small"
                    >How would you like us to mark your images?</label
                    >
                    <input type="text" class="form-control mb-3"/>
                </div>

            @endif
        </div>

    @endif


    <!-- ------------------ preview edits ------------------  -->


    @if($preview_edits)

        <div class="mb-2 text-black" style="max-width: 300px">
            <label class="form-label small fw-bold"><input type="checkbox" class="accent-black"/> Preview Edits</label>
        </div>

    @endif

    <!-- Additional Info -->
    <h6 class="mb-2 text-black">Additional Info</h6>
    <textarea
        class="form-control form-control-sm mb-3"
        rows="3"
        placeholder="Drop style link with your images"
        style="max-width: 300px"
    ></textarea>
    <button class="btn btn-dark btn-sm text-uppercase">Place Order</button>


</div>

