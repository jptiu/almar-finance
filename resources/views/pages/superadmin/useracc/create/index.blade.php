<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">Create Account</h1>
        </div>

        <form action="/" method="POST">
            @csrf
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-12">
                        <div>
                            <h1 class="text-xl md:text-xl text-slate-600 dark:text-slate-100 font-bold mb-2">Create Account</h1>
                            <span>Fill up the inputs to create account.</span>
                        </div>

                        <div class="lg:col-span-2">
                        </div>
                    </div>
                </div>

                <x-section-border />

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-6">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Account Details</p>
                        </div>
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="firstname">Full Name</label>
                                    <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="" placeholder="" />
                                </div>
                            </div>
                        </div>
                        
                </div>

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-6">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="user">Username</label>
                                    <input type="text" name="user" id="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="" placeholder="" />
                                </div>
                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="email">Email Address</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-6">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                <div class="md:col-span-1">
                                    <label class="text-black font-medium" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                

            

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-6 mt-12">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Role</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                <div class="md:col-span-2">
                                    <label class="text-black font-medium" for="status"></label>
                                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                            <option value="TBD">Superadmin</option>
                                            <option value="Approved">Admin</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3 mb-8 mt-12">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Signature</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2 mb-6">
                                    <div class="md:col-span-1">
                                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Drag & Drop</span> or click to upload</p>
                                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                            </div>
                                            <input id="dropzone-file" type="file" class="hidden" name="file">
                                        </label>
                                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Upload</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                <div>
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg"></p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">                    
                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                    <a href="{{ route('useracc.index') }}" class="btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-4">Cancel</a>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Account</button>
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
