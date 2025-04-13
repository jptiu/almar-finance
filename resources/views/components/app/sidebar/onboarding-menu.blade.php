@props(['active' => false])

<li
    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['onboarding'])) {{ 'bg-accent-100' }} @endif">
    <a href="{{ route('hr.onboarding.index') }}"
        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['onboarding'])) {{ 'hover:text-slate-200' }} @endif">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 2L2 7l1.1 1 8.4 8.4 1.4 1.4L22 8l-10-5z"/>
            </svg>
            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee Onboarding</span>
        </div>
    </a>
</li>
