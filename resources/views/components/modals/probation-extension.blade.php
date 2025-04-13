@props(['onboarding'])

<!-- Probation Extension Modal -->
<div x-data="{
    open: false,
    show() { this.open = true },
    close() { this.open = false }
}"
    x-init="
        window.livewire.on('showProbationExtensionModal', () => show());
        window.livewire.on('closeProbationExtensionModal', () => close());
    "
    class="fixed inset-0 z-50 overflow-y-auto" x-show="open" x-cloak
    style="display: none;">
    <div class="flex items-end justify-center min-h-screen px-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-blue-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Extend Probation Period</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Please provide the new end date and reason for extending the probation period for {{ $onboarding->user->name }}.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('hr.onboarding.extend', $onboarding) }}" method="POST" class="mt-5 sm:mt-4">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="new_end_date" class="block text-sm font-medium text-gray-700">New End Date</label>
                        <input type="date" name="new_end_date" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            min="{{ now()->format('Y-m-d') }}">
                    </div>

                    <div>
                        <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Extension</label>
                        <textarea name="reason" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Please provide a detailed reason for extending the probation period"></textarea>
                    </div>
                </div>

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Extend Probation
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        x-on:click="close()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
