@props(['active' => false])

<!-- Contributions Menu Items -->
<li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['contributions'])) {{ 'bg-accent-100' }} @endif"
    x-data="{ open: {{ in_array(Request::segment(2), ['contributions']) ? 1 : 0 }} }">
    <a href="{{ route('hr.contributions.index') }}"
        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['contributions'])) {{ 'hover:text-slate-200' }} @endif">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M17 4h3v16h-3zM5 14h3v6H5zm6-5h3v11h-3z"/>
                </svg>
                <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Contribution Reports</span>
            </div>
        </div>
    </a>
</li>
