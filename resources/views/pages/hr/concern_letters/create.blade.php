<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-2">
                <div class="p-2 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-semibold text-gray-900">Submit Concern</h1>
            </div>
            <a href="{{ route('concern-letters.index') }}" class="btn btn-secondary flex items-center space-x-2">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                    <path d="M15.5 13.5L8 5.5 2.5 13.5a.5.5 0 0 0 0 .707l1.414-1.414L8 7.414l5.099 5.099a.5.5 0 0 0 .707 0z"/>
                </svg>
                <span>Back to List</span>
            </a>
        </div>

        <div class="max-w-2xl mx-auto">
            <form action="{{ route('concern-letters.store') }}" method="POST" class="bg-white shadow-md rounded-xl p-8">
                @csrf

                <div class="space-y-6">
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="p-2 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-700">Employee Information</p>
                                <p class="text-sm text-gray-600">This is your personal information</p>
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $user->department }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Concern Subject</label>
                            <input type="text" name="subject" id="subject" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 {{ $errors->has('subject') ? 'border-red-500' : '' }}"
                                   placeholder="Enter the subject of your concern..."
                                   value="{{ old('subject') }}" required>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Detailed Description</label>
                            <textarea name="description" id="description" rows="6"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 {{ $errors->has('description') ? 'border-red-500' : '' }}"
                                      placeholder="Please provide a detailed description of your concern..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Submit Concern
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
