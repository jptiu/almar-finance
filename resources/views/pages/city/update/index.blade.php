<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
    <div class="relative">
            
            <div class="mb-8">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Setup Cities / Towns</h1>
                <ol class="inline-flex items-center space-x-2">
                    <!-- Home -->
                    <li>
                        <a href="/" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#A9A9A9"><path d="M264-216h96v-240h240v240h96v-348L480-726 264-564v348Zm-72 72v-456l288-216 288 216v456H528v-240h-96v240H192Zm288-327Z"/></svg>
                        </a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Page -->
                    <li>
                        <a href="#" class="text-sm text-gray-500">Setup Cities / Towns</a>
                    </li>
                    <!-- Separator -->
                    <li>
                        <span class="text-gray-500">/</span>
                    </li>
                    <!-- Current Page -->
                    <li>
                        <span class="text-sm text-black font-medium">Update</span>
                    </li>
                </ol>
            </div>
        </div>

        <form action="{{ route('city.update', $city->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div>
                            <h1 class="text-xl md:text-xl text-slate-600 dark:text-slate-100 font-bold mb-2">Add City/Town</h1>
                            <span>Fill up the inputs to add City.</span>
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
                                    <input type="text" name="code" id="code" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $city->code }}" placeholder="" />
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
                                    <label for="city_town">City/Town</label>
                                    <input type="text" name="city_town" id="city_town" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $city->city_town }}" placeholder="" />
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
                                    <select name="user_id" id="user_id" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                                        @foreach($collectors as $collector)
                                        <option value="{{$collector->user_id}}">{{$collector->name}}</option>
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
                                    <a href="{{ route('city.index') }}" class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-4">Cancel</a>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Confirm Submission</button>
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