@can('hr_access')
    <li
        class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leave-credits'])) {{ 'bg-accent-100' }} @endif">
        <a href="{{ route('leave-credits.index') }}"
            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leave-credits'])) {{ 'hover:text-slate-200' }} @endif">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave Credits</span>
            </div>
        </a>
    </li>
    <li
        class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leave-credits'])) {{ 'bg-accent-100' }} @endif">
        <a href="{{ route('leave-credits.report') }}"
            class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leave-credits'])) {{ 'hover:text-slate-200' }} @endif">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M20 18h2v-8h-2v8zm0 4h2v-4h-2v4zM2 6h2v12H2zm4 6h16v2H6v-2zm16-4H6v2h16v-2zm-4-6H6v2h12V6zM6 2v2h12V2H6z" />
                </svg>
                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Credits Report</span>
            </div>
        </a>
    </li>
@endcan
