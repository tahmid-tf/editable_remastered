<div>
    <link rel="stylesheet" href="{{ asset('modified/table.css') }}">
    <link rel="stylesheet" href="{{ asset('modified/form.css') }}">

    <div>
        <h5 class="h5_text_size">
            Orders</h5>
    </div>

    <div class="d-flex flex-wrap justify-content-between" style="margin: 0 10px; padding-bottom: 2rem">
        <div>
            <input type="text" placeholder="Order name" class="input_table" wire:model.live="search">
        </div>
        <div>
            <button class="box_button" wire:click.prevent="order_modal_1_visibility_function">
                New Order
            </button>
        </div>
    </div>

    {{-- ------------------------------------------------- Table Code -------------------------------------------------  --}}

    <div class="table-container">
        <table id="myTable">
            <thead>
            <tr>
                <th wire:click="sortBy('id')">#<span class="icon">⇅</span>
                </th>
                <th>
                    Order Name
                </th>

                <th>Date</th>
                <th>Order ID</th>
                <th>My Drive Link</th>
                <th>Preview</th>
                <th>Status</th>
                <th>Price</th>
                <th>Download File</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>


            @foreach($orders as $order)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_name }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>#{{ $order->id }}</td>
                    <td><a href="{{ $order->file_uploaded_by_user }}">File Link</a></td>
                    <td>-</td>
                    <td>{{ $order->order_status }}</td>
                    <td>{{ $order->amount }}$</td>
                    <td>
                        @if($order->file_uploaded_by_admin_after_edit == null)
                            -
                        @else
                            <a href="{{ $order->file_uploaded_by_admin_after_edit }}">Download Link</a>
                        @endif
                    </td>
                    <td>
                        <i class="fas fa-eye" style="cursor: pointer" title="view"
                           wire:click.prevent="payment_info_modal_visibility({{ $order }})"></i>
                        {{--                        <i class="fas fa-pen" style="cursor: pointer; margin-left: 15px" title="update"></i>--}}
                        {{--                        <i class="fas fa-trash-alt" style="cursor: pointer; margin-left: 15px" title="delete"></i>--}}
                    </td>
                </tr>

            @endforeach


            </tbody>
        </table>
    </div>

    <div>
        {{ $orders->links('vendor.pagination.custom') }}
    </div>


    {{--  ---------------------------------------- order details modal ---------------------------------------- --}}

    @if($payment_info_modal)
        <div class="h-full bg-gray-100 flex items-center justify-center">
            <!-- Backdrop overlay with blur -->
            <div
                class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
            >
                <!-- Modal box -->
                <div
                    class="relative bg-white p-8 rounded-lg shadow-xl w-full max-w-md text-center"
                >
                    <!-- Close button -->
                    <button
                        type="button"
                        class="absolute top-4 right-4 text-gray-400 hover:text-black focus:outline-none"
                        aria-label="Close"
                        wire:click.prevent="payment_info_modal_visibility(null)"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                    <!-- Paid icon -->
                    <div
                        class="mx-auto mb-4 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center"
                    >
                        <svg
                            class="w-6 h-6 text-green-600"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </div>

                    <!-- Paid text -->
                    <p class="text-gray-700 mb-1">{{ ucfirst($payment_status) ?? '' }}!</p>
                    <h2 class="text-2xl font-bold mb-1">USD {{ $amount_data }}</h2>
                    <p class="text-xs text-gray-500 mb-6">Order ID: {{ $order_id }}</p>

                    <!-- Basic Charge -->
                    <h3 class="text-sm font-medium text-gray-700 mb-2">
                        Basic Charge (Wedding Category)
                    </h3>
                    <hr class="mb-4"/>

                    <!-- Items breakdown -->
                    <div class="space-y-2 text-left">
                        <div class="flex justify-between text-sm">
                            <span>Culling</span>
                            <span class="font-medium">{{ $culling_data }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Skin Retouching</span>
                            <span class="font-medium">{{ $skin_retouching }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Preview Edits</span>
                            <span class="font-medium">{{ $preview_edit }}</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span>Styles</span>
                            <span class="font-medium">{{ $styles_data }}</span>
                        </div>
                    </div>

                    <hr class="my-4"/>

                    <!-- Amounts -->
                    <div class="space-y-2 text-left">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Amount</span>
                            <span class="font-semibold">USD {{ $amount_data }}</span>
                        </div>
{{--                        <div class="flex justify-between text-sm">--}}
{{--                            <span class="text-gray-600">Express Delivery</span>--}}
{{--                            <span class="font-semibold">USD 1,820</span>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--  ---------------------------------------- order details modal ---------------------------------------- --}}

    {{--  ---------------------------------------- new order - modal 1 ---------------------------------------- --}}

    @if($order_modal_1_visibility)
        <div class="h-full bg-gray-100">
            <!-- Backdrop overlay with blur -->
            <div
                class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
            >
                <!-- Modal box -->
                <div
                    class="relative p-6 rounded-lg w-full max-w-5xl mx-auto overflow-y-auto max-h-full"
                >
                    <!-- Close button -->
                    <button
                        wire:click.prevent="order_modal_1_visibility_function"
                        class="text-gray-500 hover:text-gray-800 text-2xl font-bold"
                        style="position: absolute; top: -10px; right: 20px; color: white !important"
                    >
                        &times;
                    </button>

                    <!-- Cards container -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Card 1 -->
                        <div class="bg-white border rounded-lg shadow p-4 flex flex-col">
                            <img src="{{ asset('img/1.jpg') }}" alt="Standard Delivery" class="rounded mb-4"/>
                            <h3 class="text-lg font-semibold mb-1">Standard Delivery</h3>
                            <p class="text-sm text-gray-600 mb-2">
                                📦 Estimated Delivery within 15 Days
                            </p>
                            <p class="text-sm text-gray-700 flex-grow mb-4">
                                I would like something edited as per Editable style and
                                guidelines. I do not need it to follow my own style. I can
                                choose from their existing presets.
                            </p>
                            <button
                                wire:click="order_modal_2_visibility_function('Standard Delivery')"
                                class="w-full bg-black text-white py-2 rounded hover:bg-gray-800"
                            >
                                Proceed
                            </button>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white border rounded-lg shadow p-4 flex flex-col">
                            <img src="{{ asset('img/2.jpg') }}" alt="Express" class="rounded mb-4"/>
                            <h3 class="text-lg font-semibold mb-1">Express</h3>
                            <p class="text-sm text-gray-600 mb-1">
                                📦 Estimated Delivery within 07 Days
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                💰 30% surplus on Standard Price
                            </p>
                            <p class="text-sm text-gray-700 flex-grow mb-4">
                                I would like something edited as per Editable style and
                                guidelines. I do not need it to follow my own style. I can
                                choose from their existing presets.
                            </p>
                            <button
                                wire:click="order_modal_2_visibility_function('Express Delivery')"
                                class="w-full bg-black text-white py-2 rounded hover:bg-gray-800"
                            >
                                Proceed
                            </button>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-white border rounded-lg shadow p-4 flex flex-col">
                            <img src="{{ asset('img/3.jpg') }}" alt="Custom" class="rounded mb-4"/>
                            <h3 class="text-lg font-semibold mb-1">Custom</h3>
                            <p class="text-sm text-gray-600 mb-2">
                                📦 Delivery time based on editing needs
                            </p>
                            <p class="text-sm text-gray-700 flex-grow mb-4">
                                I am a photographer, or a brand, that has recurring photo
                                editing needs, that I would like completed according to my
                                style.
                            </p>
                            <button
                                class="w-full bg-black text-white py-2 rounded hover:bg-gray-800"
                            >
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--  ---------------------------------------- new order - modal 2 ---------------------------------------- --}}

    @if($order_modal_2_visibility)
        <div class="h-full bg-gray-100">
            <!-- Backdrop overlay with blur -->
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
                <!-- Modal box -->
                <div class="relative bg-white p-6 rounded-lg shadow-xl w-full max-w-sm">
                    <!-- Better cross button (more visible) -->
                    <button
                        wire:click="order_modal_2_visibility_function"
                        type="button"
                        class="absolute top-4 right-4 text-gray-600 hover:text-black focus:outline-none"
                        aria-label="Close"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h2 class="text-lg font-semibold mb-4" style="color: black">{{ $title ?? 'Express Delivery' }}</h2>

                    <form wire:submit.prevent="goToOrderCreationPage">

                        <label class="block text-sm mb-2" for="name" style="color: black">Order Name</label>

                        <input
                            id="delivery_type"
                            type="hidden"
                            value="{{ $title }}"
                            wire:model="order_title"
                        />

                        <input
                            id="name"
                            type="text"
                            value=""
                            placeholder="Enter Name"
                            class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring focus:border-blue-500"
                            style="color: black"
                            wire:model="order_name"
                        />

                        <label class="block text-sm mb-2" for="name" style="color: black">Select Category</label>

                        @error('order_name')
                        <div style="color: red; font-size: 13px;" class="pb-1">{{ $message }}</div>
                        @enderror

                        <select
                            wire:model="selectedCategoryId"
                            class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring focus:border-blue-500 text-black"
                            style="appearance: none; background-color: white; background-image: url('data:image/svg+xml;utf8,<svg fill=\'%23000\' height=\'24\' viewBox=\'0 0 24 24\' width=\'24\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5H7z\'/></svg>'); background-repeat: no-repeat; background-position: right 0.75rem center; background-size: 1rem;"
                        >
                            <option value="" disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name ?? '' }}</option>
                            @endforeach
                        </select>


                        <button class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">Create Editor</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
