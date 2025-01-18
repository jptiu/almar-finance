<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-4">Setup Barangays</h1>
        </div>

        <form action="{{ route('barangay.update', $brgy->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div>
                            <h1 class="text-xl md:text-xl text-slate-600 dark:text-slate-100 font-bold mb-2">Edit
                                Barangay Info</h1>
                            <span>Fill up the inputs to add Barangay.</span>
                        </div>

                        <div class="lg:col-span-2">
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Area Code</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                <div class="md:col-span-1">
                                    <label for="code">Area Code</label>
                                    <input type="text" name="code" id="code"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        value="{{ $brgy->code }}" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">City/Town</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                <div class="md:col-span-1">
                                    <label for="city">City/Town</label>
                                    <input type="text" name="city" id="city"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        value="{{ $brgy->city }}" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Barangay</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                <div class="md:col-span-1">
                                    <label for="barangay_name">Barangay Name</label>
                                    <input type="text" name="barangay_name" id="barangay_name"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        value="{{ $brgy->barangay_name }}" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Collector</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                <div class="md:col-span-1">
                                    <select name="user_id" id="user_id"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                    @foreach ($collectors as $collector)
                                        <option value="{{ $collector->user_id }}" {{ $collector->user_id == $brgy->user_id ? 'selected' : '' }}>{{ $collector->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <a href="{{ route('barangay.index') }}"
                                            class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-4">Cancel</a>
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Confirm
                                            Submission</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
