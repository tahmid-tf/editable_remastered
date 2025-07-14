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
                <th>Order Status</th>

                <th>Editors</th>
                <th>Payment Status</th>

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
                    <td>
                        <select
                            wire:change="update_order_status($event.target.value, {{ $order->id }})"
                        >
                            <option value="pending" @if($order->order_status == "pending") selected @endif>Pending
                            </option>
                            <option value="completed" @if($order->order_status == "completed") selected @endif>
                                Completed
                            </option>
                            <option value="cancelled" @if($order->order_status == "cancelled") selected @endif>
                                Cancelled
                            </option>
                        </select>

                    </td>


                    <td>
                        <select
                            class="px-3 py-1 rounded-full bg-white border border-orange-500 text-black text-xs font-weight-bold focus:outline-none focus:ring-2 focus:ring-orange-400 transition"
                            wire:change="assign_editor($event.target.value, {{ $order->id }})"
                        >
                            <option value="">Assign Editor</option>
                            @foreach(\App\Models\Editor::all() as $editor)
                                <option
                                    value="{{ $editor->id }}" {{ $order->editors_id == $editor->id ? 'selected' : '' }}>
                                    {{ $editor->name }}
                                </option>
                            @endforeach
                        </select>


                    </td>
                    <td>


                        <select
                            class="px-3 py-1 rounded-full bg-white border border-orange-500 text-black text-xs font-weight-bold focus:outline-none focus:ring-2 focus:ring-orange-400 transition"
                            wire:change="update_payment_status($event.target.value, {{ $order->id }})"

                        >
                            <option value="pending" @if($order->payment_status == "pending") selected @endif>Pending
                            </option>
                            <option value="successful" @if($order->payment_status == "successful") selected @endif>
                                Successful
                            </option>
                            <option value="failed" @if($order->payment_status == "failed") selected @endif>Failed
                            </option>
                        </select>
                    </td>

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

    {{--  ---------------------------------------- order completion form modal ---------------------------------------- --}}


    @if($order_completion_modal)

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
                        wire:click.prevent="order_completion_modal_function"
                        type="button"
                        class="absolute top-4 right-4 text-gray-400 hover:text-black focus:outline-none"
                        aria-label="Close"
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

                    <!-- Upload icon -->
                    <div
                        class="mx-auto mb-4 w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center"
                    >
                        <svg
                            class="w-6 h-6 text-gray-600"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>
                    </div>

                    <!-- Title text -->
                    <p class="text-gray-700 mb-1">
                        Paste the link to the edited images for this order
                    </p>
                    <p class="text-xs text-gray-500 mb-6">Order ID: 23042024PH</p>

                    <!-- Input field -->
                    <div class="text-left mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1"
                            for="drive-link"
                        >
                            Google Drive link with your images
                        </label>
                        <input
                            wire:model="update_drive_link"
                            id="drive-link"
                            type="text"
                            placeholder="Paste your URL here"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500"
                        />
                    </div>

                    <!-- Instructions -->
                    <div class="text-left text-xs text-gray-600 mb-6 space-y-1">
                        <p>
                            1) All the images have finished uploading in the drive before
                            proceeding.
                        </p>
                        <p>2) This is the correct link for this order.</p>
                    </div>

                    <!-- Submit button -->
                    <button
                        wire:click.prevent="complete_order_submission"
                        class="w-full bg-black text-white py-2 rounded hover:bg-gray-800"
                    >
                        Complete Order
                    </button>
                </div>
            </div>
        </div>

    @endif

    {{--  ---------------------------------------- order completion form modal ---------------------------------------- --}}


</div>
