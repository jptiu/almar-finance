<div class="relative">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-accent-100 bg-opacity-30 z-40 transition-opacity duration-200 lg:hidden"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak>
    </div>

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed lg:static z-50 left-0 top-0 h-screen w-72 bg-primary-100 p-4 overflow-auto transition-transform duration-300 ease-in-out transform lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-72'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak>

        <!-- Sidebar Header with Close Button -->
        <div class="flex justify-between items-center bg-primary-100 pt-6 px-4">
            <a href="{{ route('dashboard') }}">
                <img class="h-auto w-auto" src="/images/fcc.png" alt="Company Logo">
            </a>
            <!-- Close Button (Mobile) -->

        </div>

        <!-- Sidebar Navigation -->

        <ul class="mt-4">
            @can('hr_access')
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['hr'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('hr.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#e8eaed">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                        </div>
                    </a>
                </li>
                {{-- <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['employee', 'employee-add', 'bm-probation', 'new-hire', 'resignation'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['employee', 'employee-add', 'bm-probation', 'new-hire', 'resignation']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['employee', 'employee-add', 'bm-probation', 'new-hire', 'resignation'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 2c-4.97 0-9 4.03-9 9 0 4.17 2.84 7.67 6.69 8.69L12 22l2.31-2.31C18.16 18.67 21 15.17 21 11c0-4.97-4.03-9-9-9zm0 2c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.3c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['employee', 'employee-add', 'bm-probation', 'new-hire', 'resignation'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('employee.add')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('employee.add') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Add
                                        Employee</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('bmprobation.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('bmprobation.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Probation</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('newhire.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('newhire.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">New
                                        Hire</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('resignation.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('resignation.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Resignation</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                --}}
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['loanhistory'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('loanhistory.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['loanhistory'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#FFFFFF">
                                <path
                                    d="M480-80q-155 0-269-103T82-440h81q15 121 105.5 200.5T480-160q134 0 227-93t93-227q0-134-93-227t-227-93q-86 0-159.5 42.5T204-640h116v80H88q29-140 139-230t253-90q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm112-232L440-464v-216h80v184l128 128-56 56Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                History</span>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['renewals'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('renewals.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['renewals'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                <rect fill="none" height="24" width="24" />
                                <path
                                    d="M17.66,9.53l-7.07,7.07l-4.24-4.24l1.41-1.41l2.83,2.83l5.66-5.66L17.66,9.53z M4,12c0-2.33,1.02-4.42,2.62-5.88L9,8.5v-6H3 l2.2,2.2C3.24,6.52,2,9.11,2,12c0,5.19,3.95,9.45,9,9.95v-2.02C7.06,19.44,4,16.07,4,12z M22,12c0-5.19-3.95-9.45-9-9.95v2.02 c3.94,0.49,7,3.86,7,7.93c0,2.33-1.02,4.42-2.62,5.88L15,15.5v6h6l-2.2-2.2C20.76,17.48,22,14.89,22,12z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                Renewals</span>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['request-renewals'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('request-renewals.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['request-renewals'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-archive-restore-icon lucide-archive-restore">
                                <rect width="20" height="5" x="2" y="3" rx="1" />
                                <path d="M4 8v11a2 2 0 0 0 2 2h2" />
                                <path d="M20 8v11a2 2 0 0 1-2 2h-2" />
                                <path d="m9 15 3-3 3 3" />
                                <path d="M12 12v9" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                Renewal</span>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['requestcheck'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['requestcheck']) ? 1 : 0 }} }">
                    <a href="{{ route('requestcheck.index') }}" class="block text-slate-200 transition duration-150"
                        :class="open ? 'hover:text-slate-200' : 'hover:text-white'">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#F3F3F3">
                                    <path
                                        d="M440-200h80v-40h40q17 0 28.5-11.5T600-280v-120q0-17-11.5-28.5T560-440H440v-40h160v-80h-80v-40h-80v40h-40q-17 0-28.5 11.5T360-520v120q0 17 11.5 28.5T400-360h120v40H360v80h80v40ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-480H520ZM240-800v160-160 640-640Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Check</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['audit'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('audit.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['audit'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#e8eaed">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M16.53 11.06L15.47 10l-4.88 4.88-2.12-2.12-1.06 1.06L10.59 17l5.94-5.94zM19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Audit
                                Scheduling</span>
                        </div>
                    </a>
                </li>
                <!-- Loan Status -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['loanapprovals-approved', 'loanapprovals-rejected', 'loanapprovals-pending'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['loanapprovals-approved', 'loanapprovals-rejected', 'loanapprovals-pending']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['loanapprovals-approved', 'loanapprovals-rejected', 'loanapprovals-pending'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                        <path
                                            d="M17,12c-2.76,0-5,2.24-5,5s2.24,5,5,5c2.76,0,5-2.24,5-5S19.76,12,17,12z M18.65,19.35l-2.15-2.15V14h1v2.79l1.85,1.85 L18.65,19.35z M18,3h-3.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H6C4.9,3,4,3.9,4,5v15c0,1.1,0.9,2,2,2h6.11 c-0.59-0.57-1.07-1.25-1.42-2H6V5h2v3h8V5h2v5.08c0.71,0.1,1.38,0.31,2,0.6V5C20,3.9,19.1,3,18,3z M12,5c-0.55,0-1-0.45-1-1 c0-0.55,0.45-1,1-1c0.55,0,1,0.45,1,1C13,4.55,12.55,5,12,5z" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                    Status</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['loanapprovals-approved', 'loanapprovals-rejected', 'loanapprovals-pending'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('approved.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('approved.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Approved
                                        Loans</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('pending.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('pending.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pending
                                        Loans</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('rejected.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('rejected.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Rejected
                                        Loans</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['evaluations'])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('evaluations.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['evaluations'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                                <g>
                                                    <rect fill="none" height="24" width="24" />
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M21,8c-1.45,0-2.26,1.44-1.93,2.51l-3.55,3.56c-0.3-0.09-0.74-0.09-1.04,0l-2.55-2.55C12.27,10.45,11.46,9,10,9 c-1.45,0-2.27,1.44-1.93,2.52l-4.56,4.55C2.44,15.74,1,16.55,1,18c0,1.1,0.9,2,2,2c1.45,0,2.26-1.44,1.93-2.51l4.55-4.56 c0.3,0.09,0.74,0.09,1.04,0l2.55,2.55C12.73,16.55,13.54,18,15,18c1.45,0,2.27-1.44,1.93-2.52l3.56-3.55 C21.56,12.26,23,11.45,23,10C23,8.9,22.1,8,21,8z" />
                                                        <polygon
                                                            points="15,9 15.94,6.93 18,6 15.94,5.07 15,3 14.08,5.07 12,6 14.08,6.93" />
                                                        <polygon points="3.5,11 4,9 6,8.5 4,8 3.5,6 3,8 1,8.5 3,9" />
                                                    </g>
                                                </g>
                                            </svg>>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                                Evaluation</span>
                                        </div>
                                    </a>
                                </li> --}}
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['expenses'])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('payroll.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['expenses'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                                fill="#e8eaed">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M19 14V6c0-1.1-.9-2-2-2H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zm-9-1c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm13-6v11c0 1.1-.9 2-2 2H4v-2h17V7h2z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payroll</span>
                                            <span
                                                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">23</span>
                                        </div>
                                    </a>
                                </li> --}}
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('social_loan_requests.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['employeeRequest'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M320-320h200v-200H320v200Zm0-280h480v-200H320v200Zm280 280h200v-200H600v200Zm-280 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                Social Request</span>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['expenses'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('announce.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['expenses'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960"
                                width="26px" fill="#FFFFFF">
                                <path
                                    d="M720-440v-80h160v80H720Zm48 280-128-96 48-64 128 96-48 64Zm-80-480-48-64 128-96 48 64-128 96ZM200-200v-160h-40q-33 0-56.5-23.5T80-440v-80q0-33 23.5-56.5T160-600h160l200-120v480L320-360h-40v160h-80Zm240-182v-196l-98 58H160v80h182l98 58Zm120 36v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Announcement</span>
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">5</span>
                        </div>
                    </a>
                </li>
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('hr.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                width="24px" fill="#F3F3F3">
                                                <path
                                                    d="m612-550 141-142-28-28-113 113-57-57-28 29 85 85ZM120-160v-80h480v80H120Zm520-280q-83 0-141.5-58.5T440-640q0-83 58.5-141.5T640-840q83 0 141.5 58.5T840-640q0 83-58.5 141.5T640-440Zm-520-40v-80h252q7 22 16 42t22 38H120Zm0 160v-80h376q23 14 49 23.5t55 13.5v43H120Z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Initial
                                                Employment Period</span>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- Employee Records -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond']) ? 1 : 0 }} }">
                                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                                    width="24px" fill="#e8eaed">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M17.81 4.47c-.08 0-.16-.02-.23-.06C15.66 3.42 14 3 12.01 3c-1.98 0-3.86.47-5.57 1.41-.24.13-.54.04-.68-.2-.13-.24-.04-.55.2-.68C7.82 2.52 9.86 2 12.01 2c2.13 0 3.99.47 6.03 1.52.25.13.34.43.21.67-.09.18-.26.28-.44.28zM3.5 9.72c-.1 0-.2-.03-.29-.09-.23-.16-.28-.47-.12-.7.99-1.4 2.25-2.5 3.75-3.27C9.98 4.04 14 4.03 17.15 5.65c1.5.77 2.76 1.86 3.75 3.25.16.22.11.54-.12.7-.23.16-.54.11-.7-.12-.9-1.26-2.04-2.25-3.39-2.94-2.87-1.47-6.54-1.47-9.4.01-1.36.7-2.5 1.7-3.4 2.96-.08.14-.23.21-.39.21zm6.25 12.07c-.13 0-.26-.05-.35-.15-.87-.87-1.34-1.43-2.01-2.64-.69-1.23-1.05-2.73-1.05-4.34 0-2.97 2.54-5.39 5.66-5.39s5.66 2.42 5.66 5.39c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-2.42-2.09-4.39-4.66-4.39-2.57 0-4.66 1.97-4.66 4.39 0 1.44.32 2.77.93 3.85.64 1.15 1.08 1.64 1.85 2.42.19.2.19.51 0 .71-.11.1-.24.15-.37.15zm7.17-1.85c-1.19 0-2.24-.3-3.1-.89-1.49-1.01-2.38-2.65-2.38-4.39 0-.28.22-.5.5-.5s.5.22.5.5c0 1.41.72 2.74 1.94 3.56.71.48 1.54.71 2.54.71.24 0 .64-.03 1.04-.1.27-.05.53.13.58.41.05.27-.13.53-.41.58-.57.11-1.07.12-1.21.12zM14.91 22c-.04 0-.09-.01-.13-.02-1.59-.44-2.63-1.03-3.72-2.1-1.4-1.39-2.17-3.24-2.17-5.22 0-1.62 1.38-2.94 3.08-2.94 1.7 0 3.08 1.32 3.08 2.94 0 1.07.93 1.94 2.08 1.94s2.08-.87 2.08-1.94c0-3.77-3.25-6.83-7.25-6.83-2.84 0-5.44 1.58-6.61 4.03-.39.81-.59 1.76-.59 2.8 0 .78.07 2.01.67 3.61.1.26-.03.55-.29.64-.26.1-.55-.04-.64-.29-.49-1.31-.73-2.61-.73-3.96 0-1.2.23-2.29.68-3.24 1.33-2.79 4.28-4.6 7.51-4.6 4.55 0 8.25 3.51 8.25 7.83 0 1.62-1.38 2.94-3.08 2.94s-3.08-1.32-3.08-2.94c0-1.07-.93-1.94-2.08-1.94s-2.08.87-2.08 1.94c0 1.71.66 3.31 1.87 4.51.95.94 1.86 1.46 3.27 1.85.27.07.42.35.35.61-.05.23-.26.38-.47.38z" />
                                                </svg>
                                                <span
                                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                                    Records</span>
                                            </div>
                                            <!-- Icon -->
                                            <div
                                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond'])) {{ 'hidden' }} @endif" :class="open ? '!block' : 'hidden'">
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('attendance.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance
                                                        Records</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('underRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="#">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave
                                                        Records</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="#">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Disciplinary
                                                        Records</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li> --}}
                <!-- Employee Request Forms -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                        'dailyWorkRequest',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond', 'dailyWorkRequest']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                            'dailyWorkRequest',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Form</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                                'dailyWorkRequest',
                                'coe-requests'
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            {{-- <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('leaveRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('undertimeRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('undertimeRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Undertime
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('idRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">ID
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('clearanceRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('clearanceRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Clearance
                                                        Request</span>
                                                    <span
                                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cashadvanceRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('cashadvanceRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                                        Advance</span>
                                                    <span
                                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('dailyWorkRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('dailyWorkRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Daily
                                                        Work Order</span>
                                                </a>
                                            </li> --}}
                            {{-- <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cashBond.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('cashBond.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                        Bond Loan</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li> --}}
                            <!-- Certificate of Employment -->
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('coe-requests.create')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('coe-requests.create') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Certificate
                                        of Employment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Documents -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Documents</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            {{-- <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                                    href="#">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Resume
                                                        Documents</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('underRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="#">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Application
                                                        Documents</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="#">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Separation
                                                        Pay Documents</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="#">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Resignation
                                                        Documents</span>
                                                </a>
                                            </li> --}}
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                    href="#">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">AFC
                                        Booklet</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Reports -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Reports</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('monthlyrep.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Monthly
                                        Report</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('underRequest.index')) {{ '!text-violet-500' }} @endif"
                                    href="#">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">SEC
                                        Annual Report</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('underRequest.index')) {{ '!text-violet-500' }} @endif"
                                    href="#">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Monthly
                                        Remittance</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-book-open-check-icon lucide-book-open-check">
                                    <path d="M12 21V7" />
                                    <path d="m16 12 2 2 4-4" />
                                    <path
                                        d="M22 6V4a1 1 0 0 0-1-1h-5a4 4 0 0 0-4 4 4 4 0 0 0-4-4H3a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h6a3 3 0 0 1 3 3 3 3 0 0 1 3-3h6a1 1 0 0 0 1-1v-1.3" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Leave Credits -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leave-credits'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leave-credits']) ? 1 : 0 }} }">
                    <a href="{{ route('leave-credits.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leave-credits'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M13 16H8" />
                                    <path d="M13 12H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave Credits</span>
                            </div>
                        </div>
                    </a>
                </li>

                <!-- Departments -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['departments'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['departments']) ? 1 : 0 }} }">
                    <a href="{{ route('departments.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['departments'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-building-2-icon lucide-building-2">
                                    <path d="M19 19H5" />
                                    <path d="M19 15H5" />
                                    <path d="M19 11H5" />
                                    <path d="M19 7H5" />
                                    <path d="M19 3H5" />
                                    <path d="M19 21H5" />
                                    <path d="M19 17H5" />
                                    <path d="M19 13H5" />
                                    <path d="M19 9H5" />
                                    <path d="M19 5H5" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Departments</span>
                            </div>
                        </div>
                    </a>
                </li>
                
                <!-- Leave Credits Report -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leave-credits-report'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leave-credits-report']) ? 1 : 0 }} }">
                    <a href="{{ route('leave-credits.report') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leave-credits-report'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M13 16H8" />
                                    <path d="M13 12H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave Credits Report</span>
                            </div>
                        </div>
                    </a>
                </li>

                <!-- Leaves -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leaves'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaves']) ? 1 : 0 }} }">
                    <a href="{{ route('leaves.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leaves'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h5" />
                                    <path d="M17.5 17.5 16 16.3V14" />
                                    <circle cx="16" cy="16" r="6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leaves</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- performance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['performance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['performance']) ? 1 : 0 }} }">
                    <a href="{{ route('performance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['performance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                                    <path d="M12 16v5" />
                                    <path d="M16 14v7" />
                                    <path d="M20 10v11" />
                                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                    <path d="M4 18v3" />
                                    <path d="M8 14v7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- benefits -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['benefits'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['benefits']) ? 1 : 0 }} }">
                    <a href="{{ route('benefits.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['benefits'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-hand-heart-icon lucide-hand-heart">
                                    <path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16" />
                                    <path
                                        d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 15 6 6" />
                                    <path
                                        d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Benefits</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Overtime -->
                {{-- <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['overtime'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['overtime']) ? 1 : 0 }} }">
                    <a href="{{ route('overtime.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['overtime'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overtime</span>
                            </div>
                        </div>
                    </a>
                </li> --}}
                {{-- Employee Concern Letters --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['concern-letters']) ? 1 : 0 }} }">
                    <a href="{{ route('concern-letters.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                    Concern Letters</span>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- DTR --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dtr'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dtr']) ? 1 : 0 }} }">
                    <a href="{{ route('dtr.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dtr'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Daily
                                    Time Record</span>
                            </div>
                        </div>
                    </a>
                </li>

                {{-- Salary Management --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['salaries'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['salaries']) ? 1 : 0 }} }">
                    <a href="{{ route('salaries.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['salaries'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Salary
                                    Management</span>
                            </div>
                        </div>
                    </a>
                </li>

                {{-- Chats --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chats'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['chats']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chats'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/chats">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17 0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chats</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endcan
            @can('loan_access')
                <!-- Dashboard -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Customer Profile -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customer'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['customer']) ? 1 : 0 }} }">
                    <a href="{{ route('customer.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['customer'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                    Profile</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Grant Loan Entry -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['loan'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['loan']) ? 1 : 0 }} }">
                    <a href="{{ route('loan.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['loan'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <path
                                            d="M16.48,10.41c-0.39,0.39-1.04,0.39-1.43,0l-4.47-4.46l-7.05,7.04l-0.66-0.63c-1.17-1.17-1.17-3.07,0-4.24l4.24-4.24 c1.17-1.17,3.07-1.17,4.24,0L16.48,9C16.87,9.39,16.87,10.02,16.48,10.41z M17.18,8.29c0.78,0.78,0.78,2.05,0,2.83 c-1.27,1.27-2.61,0.22-2.83,0l-3.76-3.76l-5.57,5.57c-0.39,0.39-0.39,1.02,0,1.41c0.39,0.39,1.02,0.39,1.42,0l4.62-4.62l0.71,0.71 l-4.62,4.62c-0.39,0.39-0.39,1.02,0,1.41c0.39,0.39,1.02,0.39,1.42,0l4.62-4.62l0.71,0.71l-4.62,4.62c-0.39,0.39-0.39,1.02,0,1.41 c0.39,0.39,1.02,0.39,1.41,0l4.62-4.62l0.71,0.71l-4.62,4.62c-0.39,0.39-0.39,1.02,0,1.41c0.39,0.39,1.02,0.39,1.41,0l8.32-8.34 c1.17-1.17,1.17-3.07,0-4.24l-4.24-4.24c-1.15-1.15-3.01-1.17-4.18-0.06L17.18,8.29z" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Grant
                                    Loan Entry</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['loan-summary'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('loan-summary.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['loan-summary'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                Summary</span>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['request-renewals'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('request-renewals.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['request-renewals'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                <rect fill="none" height="24" width="24" />
                                <path
                                    d="M17.66,9.53l-7.07,7.07l-4.24-4.24l1.41-1.41l2.83,2.83l5.66-5.66L17.66,9.53z M4,12c0-2.33,1.02-4.42,2.62-5.88L9,8.5v-6H3 l2.2,2.2C3.24,6.52,2,9.11,2,12c0,5.19,3.95,9.45,9,9.95v-2.02C7.06,19.44,4,16.07,4,12z M22,12c0-5.19-3.95-9.45-9-9.95v2.02 c3.94,0.49,7,3.86,7,7.93c0,2.33-1.02,4.42-2.62,5.88L15,15.5v6h6l-2.2-2.2C20.76,17.48,22,14.89,22,12z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                Renewal</span>
                        </div>
                    </a>
                </li>
                <!-- Collection Data Entry -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['collection'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['collection']) ? 1 : 0 }} }">
                    <a href="{{ route('collection.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['collection'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-2 14l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Collection
                                    Data Entry</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['rebates'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a href="{{ route('rebates.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['rebates'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-philippine-peso-icon lucide-philippine-peso">
                                    <path d="M20 11H4" />
                                    <path d="M20 7H4" />
                                    <path d="M7 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 0 12H7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Rebates</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Breakdown of Cash Bills -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['breakdown'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['breakdown']) ? 1 : 0 }} }">
                    <a href="{{ route('breakdown.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['breakdown'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <path
                                            d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.48,10-10S17.52,2,12,2z M12.88,17.76V19h-1.75v-1.29 c-0.74-0.18-2.39-0.77-3.02-2.96l1.65-0.67c0.06,0.22,0.58,2.09,2.4,2.09c0.93,0,1.98-0.48,1.98-1.61c0-0.96-0.7-1.46-2.28-2.03 c-1.1-0.39-3.35-1.03-3.35-3.31c0-0.1,0.01-2.4,2.62-2.96V5h1.75v1.24c1.84,0.32,2.51,1.79,2.66,2.23l-1.58,0.67 c-0.11-0.35-0.59-1.34-1.9-1.34c-0.7,0-1.81,0.37-1.81,1.39c0,0.95,0.86,1.31,2.64,1.9c2.4,0.83,3.01,2.05,3.01,3.45 C15.9,17.17,13.4,17.67,12.88,17.76z" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Breakdown
                                    of Cash Bills</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Expenses Data Entry -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['expenses'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('expenses.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['expenses'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-banknote-arrow-down-icon lucide-banknote-arrow-down">
                                <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5" />
                                <path d="m16 19 3 3 3-3" />
                                <path d="M18 12h.01" />
                                <path d="M19 16v6" />
                                <path d="M6 12h.01" />
                                <circle cx="12" cy="12" r="2" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Expenses
                                Data Entry</span>
                        </div>
                    </a>
                </li>
                <!-- Compute Cash On Hand -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['compute'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('compute.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['compute'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 26 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_2062_17774)">
                                    <path
                                        d="M3.25 0C2.35117 0 1.625 0.726172 1.625 1.625V4.875C1.625 5.77383 2.35117 6.5 3.25 6.5H7.3125V8.125H4.41797C2.81328 8.125 1.44727 9.29805 1.20352 10.8875L0.0558594 18.4895C0.0203125 18.7281 0 18.9719 0 19.2156V22.75C0 24.5426 1.45742 26 3.25 26H22.75C24.5426 26 26 24.5426 26 22.75V19.2156C26 18.9719 25.9797 18.7281 25.9441 18.4844L24.7914 10.8875C24.5527 9.29805 23.1867 8.125 21.582 8.125H10.5625V6.5H14.625C15.5238 6.5 16.25 5.77383 16.25 4.875V1.625C16.25 0.726172 15.5238 0 14.625 0H3.25ZM4.875 2.4375H13C13.4469 2.4375 13.8125 2.80312 13.8125 3.25C13.8125 3.69688 13.4469 4.0625 13 4.0625H4.875C4.42812 4.0625 4.0625 3.69688 4.0625 3.25C4.0625 2.80312 4.42812 2.4375 4.875 2.4375ZM3.25 21.9375C3.25 21.4906 3.61562 21.125 4.0625 21.125H21.9375C22.3844 21.125 22.75 21.4906 22.75 21.9375C22.75 22.3844 22.3844 22.75 21.9375 22.75H4.0625C3.61562 22.75 3.25 22.3844 3.25 21.9375ZM5.6875 13.4062C5.36427 13.4062 5.05427 13.2778 4.82571 13.0493C4.59715 12.8207 4.46875 12.5107 4.46875 12.1875C4.46875 11.8643 4.59715 11.5543 4.82571 11.3257C5.05427 11.0972 5.36427 10.9688 5.6875 10.9688C6.01073 10.9688 6.32073 11.0972 6.54929 11.3257C6.77785 11.5543 6.90625 11.8643 6.90625 12.1875C6.90625 12.5107 6.77785 12.8207 6.54929 13.0493C6.32073 13.2778 6.01073 13.4062 5.6875 13.4062ZM11.7812 12.1875C11.7812 12.5107 11.6528 12.8207 11.4243 13.0493C11.1957 13.2778 10.8857 13.4062 10.5625 13.4062C10.2393 13.4062 9.92927 13.2778 9.70071 13.0493C9.47215 12.8207 9.34375 12.5107 9.34375 12.1875C9.34375 11.8643 9.47215 11.5543 9.70071 11.3257C9.92927 11.0972 10.2393 10.9688 10.5625 10.9688C10.8857 10.9688 11.1957 11.0972 11.4243 11.3257C11.6528 11.5543 11.7812 11.8643 11.7812 12.1875ZM8.125 17.4688C7.80177 17.4688 7.49177 17.3403 7.26321 17.1118C7.03465 16.8832 6.90625 16.5732 6.90625 16.25C6.90625 15.9268 7.03465 15.6168 7.26321 15.3882C7.49177 15.1597 7.80177 15.0312 8.125 15.0312C8.44823 15.0312 8.75823 15.1597 8.98679 15.3882C9.21535 15.6168 9.34375 15.9268 9.34375 16.25C9.34375 16.5732 9.21535 16.8832 8.98679 17.1118C8.75823 17.3403 8.44823 17.4688 8.125 17.4688ZM16.6562 12.1875C16.6562 12.5107 16.5278 12.8207 16.2993 13.0493C16.0707 13.2778 15.7607 13.4062 15.4375 13.4062C15.1143 13.4062 14.8043 13.2778 14.5757 13.0493C14.3472 12.8207 14.2188 12.5107 14.2188 12.1875C14.2188 11.8643 14.3472 11.5543 14.5757 11.3257C14.8043 11.0972 15.1143 10.9688 15.4375 10.9688C15.7607 10.9688 16.0707 11.0972 16.2993 11.3257C16.5278 11.5543 16.6562 11.8643 16.6562 12.1875ZM13 17.4688C12.6768 17.4688 12.3668 17.3403 12.1382 17.1118C11.9097 16.8832 11.7813 16.5732 11.7812 16.25C11.7812 15.9268 11.9097 15.6168 12.1382 15.3882C12.3668 15.1597 12.6768 15.0312 13 15.0312C13.3232 15.0312 13.6332 15.1597 13.8618 15.3882C14.0903 15.6168 14.2188 15.9268 14.2188 16.25C14.2188 16.5732 14.0903 16.8832 13.8618 17.1118C13.6332 17.3403 13.3232 17.4688 13 17.4688ZM21.5312 12.1875C21.5313 12.3475 21.4997 12.506 21.4385 12.6539C21.3772 12.8018 21.2875 12.9361 21.1743 13.0493C21.0611 13.1625 20.9268 13.2522 20.7789 13.3135C20.631 13.3747 20.4725 13.4063 20.3125 13.4062C20.1525 13.4063 19.994 13.3747 19.8461 13.3135C19.6982 13.2522 19.5639 13.1625 19.4507 13.0493C19.3375 12.9361 19.2478 12.8018 19.1865 12.6539C19.1253 12.506 19.0937 12.3475 19.0938 12.1875C19.0937 12.0275 19.1253 11.869 19.1865 11.7211C19.2478 11.5732 19.3375 11.4389 19.4507 11.3257C19.5639 11.2125 19.6982 11.1228 19.8461 11.0615C19.994 11.0003 20.1525 10.9688 20.3125 10.9688C20.4725 10.9687 20.631 11.0003 20.7789 11.0615C20.9268 11.1228 21.0611 11.2125 21.1743 11.3257C21.2875 11.4389 21.3772 11.5732 21.4385 11.7211C21.4997 11.869 21.5313 12.0275 21.5312 12.1875ZM17.875 17.4688C17.5518 17.4688 17.2418 17.3403 17.0132 17.1118C16.7847 16.8832 16.6562 16.5732 16.6562 16.25C16.6562 15.9268 16.7847 15.6168 17.0132 15.3882C17.2418 15.1597 17.5518 15.0312 17.875 15.0312C18.1982 15.0312 18.5082 15.1597 18.7368 15.3882C18.9653 15.6168 19.0938 15.9268 19.0938 16.25C19.0938 16.5732 18.9653 16.8832 18.7368 17.1118C18.5082 17.3403 18.1982 17.4688 17.875 17.4688Z"
                                        fill="#E8EAED" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_2062_17774">
                                        <rect width="26" height="26" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Compute
                                Cash On Hand</span>
                        </div>
                    </a>
                </li>
                <!-- Customer Ledger - Daily -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['daily'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('daily.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['daily'])) {{ 'hover:text-slate-200' }} @endif"
                        href="#0">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                <rect fill="none" height="24" width="24" />
                                <path
                                    d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z M12,10c1.1,0,2,0.9,2,2c0,1.1-0.9,2-2,2s-2-0.9-2-2 C10,10.9,10.9,10,12,10z M16,18H8v-0.57c0-0.81,0.48-1.53,1.22-1.85C10.07,15.21,11.01,15,12,15c0.99,0,1.93,0.21,2.78,0.58 C15.52,15.9,16,16.62,16,17.43V18z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                Ledger - Daily</span>
                        </div>
                    </a>
                </li>
                <!-- Customer Ledger - ATM -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['monthly'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('monthly.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['monthly'])) {{ 'hover:text-slate-200' }} @endif"
                        href="#0">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                <g>
                                    <path d="M0,0h24v24H0V0z" fill="none" />
                                </g>
                                <g>
                                    <path
                                        d="M20,4H4C2.89,4,2.01,4.89,2.01,6L2,18c0,1.11,0.89,2,2,2h5v-2H4v-6h18V6C22,4.89,21.11,4,20,4z M20,8H4V6h16V8z M14.93,19.17l-2.83-2.83l-1.41,1.41L14.93,22L22,14.93l-1.41-1.41L14.93,19.17z" />
                                </g>
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                Ledger - ATM</span>
                        </div>
                    </a>
                </li>
                <!-- Supply Request -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['supply-request'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['supply-request']) ? 1 : 0 }} }">
                    <a href="{{ route('supply-request.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['supply-request'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-container-icon lucide-container">
                                    <path
                                        d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z" />
                                    <path d="M10 21.9V14L2.1 9.1" />
                                    <path d="m10 14 11.9-6.9" />
                                    <path d="M14 19.8v-8.1" />
                                    <path d="M18 17.5V9.4" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Supply
                                    Request</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Loan Accounts -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['regAccount', 'badAccount'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['regAccount', 'badAccount']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['regAccount', 'badAccount'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                    Accounts</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['regAccount', 'badAccount', 'overdueacc'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('regAccount.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('regAccount.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Regular
                                        Accounts</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('badAccount.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('badAccount.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bad
                                        Accounts</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('csor.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M320-320h200v-200H320v200Zm0-280h480v-200H320v200Zm280 280h200v-200H600v200Zm-280 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">CSOR</span>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('social_loan_requests.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['employeeRequest'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M320-320h200v-200H320v200Zm0-280h480v-200H320v200Zm280 280h200v-200H600v200Zm-280 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                Social Request</span>
                        </div>
                    </a>
                </li>
                <!-- Employee Request Forms -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                        'dailyworkorder',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond', 'dailyworkorder']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                            'dailyworkorder',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Form</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                                'dailyworkorder',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('collector.cashbond')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.cashbond') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                        Bond Loan</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Saving Customer -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M640-520q17 0 28.5-11.5T680-560q0-17-11.5-28.5T640-600q-17 0-28.5 11.5T600-560q0 17 11.5 28.5T640-520Zm-320-80h200v-80H320v80ZM180-120q-34-114-67-227.5T80-580q0-92 64-156t156-64h200q29-38 70.5-59t89.5-21q25 0 42.5 17.5T720-820q0 6-1.5 12t-3.5 11q-4 11-7.5 22.5T702-751l91 91h87v279l-113 37-67 224H480v-80h-80v80H180Zm60-80h80v-80h240v80h80l62-206 98-33v-141h-40L620-720q0-20 2.5-38.5T630-796q-29 8-51 27.5T547-720H300q-58 0-99 41t-41 99q0 98 27 191.5T240-200Zm240-298Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Savings
                                    Customer</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('depositentry.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('depositentry.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Deposit
                                        Entry</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('savingscustomer.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('savingscustomer.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Withdrawal
                                        Entry</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['concern-letters']) ? 1 : 0 }} }">
                    <a href="{{ route('concern-letters.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                    Concern Letters</span>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- DTR --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dtr'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dtr']) ? 1 : 0 }} }">
                    <a href="{{ route('dtr.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dtr'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Daily
                                    Time Record</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>

                <!-- Overtime -->
                {{-- <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['overtime'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['overtime']) ? 1 : 0 }} }">
                    <a href="{{ route('overtime.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['overtime'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock-icon lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Overtime</span>
                            </div>
                        </div>
                    </a>
                </li> --}}

                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.employee', Auth::user()->id) }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chats'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['chats']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chats'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/chats">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17 0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chats</span>
                            </div>
                        </div>
                    </a>
                </li>
                <br>
            @endcan

            @can('auditor_access')
                <!-- Dashboard -->
                <!-- Customer Profile -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customer'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['customer']) ? 1 : 0 }} }">
                    <a href="{{ route('customer.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['customer'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                    List</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Grant Loan Entry -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['loan'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['loan']) ? 1 : 0 }} }">
                    <a href="{{ route('loan.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['loan'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                    viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <path
                                            d="M16.48,10.41c-0.39,0.39-1.04,0.39-1.43,0l-4.47-4.46l-7.05,7.04l-0.66-0.63c-1.17-1.17-1.17-3.07,0-4.24l4.24-4.24 c1.17-1.17,3.07-1.17,4.24,0L16.48,9C16.87,9.39,16.87,10.02,16.48,10.41z M17.18,8.29c0.78,0.78,0.78,2.05,0,2.83 c-1.27,1.27-2.61,0.22-2.83,0l-3.76-3.76l-5.57,5.57c-0.39,0.39-0.39,1.02,0,1.41c0.39,0.39,1.02,0.39,1.42,0l4.62-4.62l0.71,0.71 l-4.62,4.62c-0.39,0.39-0.39,1.02,0,1.41c0.39,0.39,1.02,0.39,1.42,0l4.62-4.62l0.71,0.71l-4.62,4.62c-0.39,0.39-0.39,1.02,0,1.41 c0.39,0.39,1.02,0.39,1.41,0l4.62-4.62l0.71,0.71l-4.62,4.62c-0.39,0.39-0.39,1.02,0,1.41c0.39,0.39,1.02,0.39,1.41,0l8.32-8.34 c1.17-1.17,1.17-3.07,0-4.24l-4.24-4.24c-1.15-1.15-3.01-1.17-4.18-0.06L17.18,8.29z" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    Loans</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('csor.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M320-320h200v-200H320v200Zm0-280h480v-200H320v200Zm280 280h200v-200H600v200Zm-280 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">CSOR</span>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('branches.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M80-120v-720h400v160h400v560H80Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h320v-400H480v80h80v80h-80v80h80v80h-80v80Zm160-240v-80h80v80h-80Zm0 160v-80h80v80h-80Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Branch
                                List</span>
                        </div>
                    </a>
                </li>
                <!-- Expenses Data Entry -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['expenses'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('expenses.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['expenses'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-banknote-arrow-down-icon lucide-banknote-arrow-down">
                                <path d="M12 18H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5" />
                                <path d="m16 19 3 3 3-3" />
                                <path d="M18 12h.01" />
                                <path d="M19 16v6" />
                                <path d="M6 12h.01" />
                                <circle cx="12" cy="12" r="2" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Expenses
                                Data Entry</span>
                        </div>
                    </a>
                </li>
                <!-- Chart of Account ID -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chart'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['chart']) ? 1 : 0 }} }">
                    <a href="{{ route('chart.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chart'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm80-160h80v-280h-80v280Zm160 0h80v-400h-80v400Zm160 0h80v-160h-80v160Zm80-320v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80ZM480-480Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chart
                                    Account</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['worksheet-monthly-report'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('worksheet.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['worksheet'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#e8eaed">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Worksheet</span>
                        </div>
                    </a>
                </li>
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.employee', Auth::user()->id) }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Leaves -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leaves'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaves']) ? 1 : 0 }} }">
                    <a href="{{ route('leaves.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leaves'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h5" />
                                    <path d="M17.5 17.5 16 16.3V14" />
                                    <circle cx="16" cy="16" r="6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leaves</span>
                            </div>
                        </div>
                    </a>
                </li>
                {{-- Employee Concern Letters --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['concern-letters']) ? 1 : 0 }} }">
                    <a href="{{ route('concern-letters.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                    Concern Letters</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('social_loan_requests.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['employeeRequest'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M320-320h200v-200H320v200Zm0-280h480v-200H320v200Zm280 280h200v-200H600v200Zm-280 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                Social Request</span>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['regAccount', 'badAccount', 'overdueacc'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['worksheet-monthly-report']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['regAccount', 'badAccount', 'overdueacc'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-clipboard-minus-icon lucide-clipboard-minus">
                                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                    <path d="M9 14h6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">BA
                                    Reports</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['ba-monthly-report'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('bamonth.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('bamonth.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">BA
                                        Monthly</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('badaily.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('badaily.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">BA
                                        Daily</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('bacollection.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('bacollection.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">BA
                                        Collection</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('collector_access')
                <!-- Dashboard -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Leaves -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leaves'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaves']) ? 1 : 0 }} }">
                    <a href="{{ route('leaves.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leaves'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h5" />
                                    <path d="M17.5 17.5 16 16.3V14" />
                                    <circle cx="16" cy="16" r="6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leaves</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- performance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['performance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['performance']) ? 1 : 0 }} }">
                    <a href="{{ route('performance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['performance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                                    <path d="M12 16v5" />
                                    <path d="M16 14v7" />
                                    <path d="M20 10v11" />
                                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                    <path d="M4 18v3" />
                                    <path d="M8 14v7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- benefits -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['benefits'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['benefits']) ? 1 : 0 }} }">
                    <a href="{{ route('benefits.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['benefits'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-hand-heart-icon lucide-hand-heart">
                                    <path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16" />
                                    <path
                                        d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 15 6 6" />
                                    <path
                                        d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Benefits</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- My Profile -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['profile'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['profile']) ? 1 : 0 }} }">
                    <a href="{{ route('collector.profile') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['profile'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                    </g>
                                    <g>
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C16.43 19.18 14.03 20 12 20z" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">My
                                    Profile</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Employee Request Forms -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Form</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.leave') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave
                                        Request</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('collector.undertime')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.undertime') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Undertime
                                        Request</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('collector.id')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.id') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">ID
                                        Request</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('collector.clearance')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.clearance') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Clearance
                                        Request</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('collector.cashadvance')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.cashadvance') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                        Advance</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('collector.cashbond')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('collector.cashbond') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                        Bond Loan</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
            @can('super_access')
                <!-- Dashboard -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-slate-200' }} @endif"
                        href="{{ route('superadmin.index') }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- User Accounts -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['employee'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('useracc.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['employee'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">User
                                Accounts</span>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['employee'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('create.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('create.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Create
                                        User</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('deleted.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('deleted.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Deleted
                                        Account</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('update.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('update.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Update
                                        Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Monthly Report -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customer'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['customer']) ? 1 : 0 }} }">
                    <a href="{{ route('monthlyReport.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['customer'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Monthly
                                    Report</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Customer Profile -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customer'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['customer']) ? 1 : 0 }} }">
                    <a href="{{ route('customerprof.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['customer'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                    Profile</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['concern-letters']) ? 1 : 0 }} }">
                    <a href="{{ route('concern-letters.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['concern-letters'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                    Concern Letters</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-book-open-check-icon lucide-book-open-check">
                                    <path d="M12 21V7" />
                                    <path d="m16 12 2 2 4-4" />
                                    <path
                                        d="M22 6V4a1 1 0 0 0-1-1h-5a4 4 0 0 0-4 4 4 4 0 0 0-4-4H3a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h6a3 3 0 0 1 3 3 3 3 0 0 1 3-3h6a1 1 0 0 0 1-1v-1.3" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Leaves -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leaves'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaves']) ? 1 : 0 }} }">
                    <a href="{{ route('leaves.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leaves'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h5" />
                                    <path d="M17.5 17.5 16 16.3V14" />
                                    <circle cx="16" cy="16" r="6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leaves</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- performance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['performance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['performance']) ? 1 : 0 }} }">
                    <a href="{{ route('performance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['performance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                                    <path d="M12 16v5" />
                                    <path d="M16 14v7" />
                                    <path d="M20 10v11" />
                                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                    <path d="M4 18v3" />
                                    <path d="M8 14v7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- benefits -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['benefits'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['benefits']) ? 1 : 0 }} }">
                    <a href="{{ route('benefits.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['benefits'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-hand-heart-icon lucide-hand-heart">
                                    <path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16" />
                                    <path
                                        d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 15 6 6" />
                                    <path
                                        d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Benefits</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chats'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['chats']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chats'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/chats">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17 0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chats</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endcan
            @can('admin_access')
                <!-- Dashboard -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition @if (in_array(Request::segment(1), ['dashboard'])) bg-accent-100 @else hover:bg-hoverbg-100 @endif rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Edit Requests -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['edit-requests'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['edit-requests']) ? 1 : 0 }} }">
                    <a href="{{ route('loan.edit-requests.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['edit-requests'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-user-pen-icon lucide-user-pen">
                                    <path d="M11.5 15H7a4 4 0 0 0-4 4v2" />
                                    <path
                                        d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                                    <circle cx="10" cy="7" r="4" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Edit
                                    Requests</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Supply Request -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['supply-request'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['supply-request']) ? 1 : 0 }} }">
                    <a href="{{ route('supply-request.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['supply-request'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-container-icon lucide-container">
                                    <path
                                        d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z" />
                                    <path d="M10 21.9V14L2.1 9.1" />
                                    <path d="m10 14 11.9-6.9" />
                                    <path d="M14 19.8v-8.1" />
                                    <path d="M18 17.5V9.4" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Supply
                                    Request</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Rebates -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['rebates'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a href="{{ route('rebates.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['rebates'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-philippine-peso-icon lucide-philippine-peso">
                                    <path d="M20 11H4" />
                                    <path d="M20 7H4" />
                                    <path d="M7 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 0 12H7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Rebates</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Monthly Report -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0
                    @if (in_array(Request::segment(1), ['monthlyReport'])) bg-accent-100 @else hover:bg-hoverbg-100 @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['monthlyReport']) ? 1 : 0 }} }">
                    <a href="{{ route('monthlyReport.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    Monthly Report
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Customer Profile Sidebar Item -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customer'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a href="{{ route('customer.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M16.5 12c1.38 0 2.49-1.12 2.49-2.5S17.88 7 16.5 7C15.12 7 14 8.12 14 9.5s1.12 2.5 2.5 2.5zM9 11c1.66 0 2.99-1.34 2.99-3S10.66 5 9 5C7.34 5 6 6.34 6 8s1.34 3 3 3zm7.5 3c-1.83 0-5.5.92-5.5 2.75V19h11v-2.25c0-1.83-3.67-2.75-5.5-2.75zM9 13c-2.33 0-7 1.17-7 3.5V19h7v-2.25c0-.85.33-2.34 2.37-3.47C10.5 13.1 9.66 13 9 13z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    Customer Profile
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Employee Request Forms -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition @if (in_array(Request::segment(1), ['employee'])) bg-accent-100 @else hover:bg-hoverbg-100 @endif rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Form</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            {{-- <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('leaveRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('undertimeRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('undertimeRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Undertime
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('idRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">ID
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('clearanceRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('clearanceRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Clearance
                                                        Request</span>
                                                    <span
                                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cashadvanceRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('cashadvanceRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                                        Advance</span>
                                                    <span
                                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                                </a>
                                            </li> --}}
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cashBond.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('cashBond.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                        Bond Loan</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Branch --}}
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['branches'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a href="{{ route('branches.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['branches'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M80-120v-720h400v160h400v560H80Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h320v-400H480v80h80v80h-80v80h80v80h-80v80Zm160-240v-80h80v80h-80Zm0 160v-80h80v80h-80Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Branches</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Denomination -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['denomination'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a href="{{ route('denomination.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['denomination'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M200-280v-280h80v280h-80Zm240 0v-280h80v280h-80ZM80-120v-80h800v80H80Zm600-160v-280h80v280h-80ZM80-640v-80l400-200 400 200v80H80Zm178-80h444-444Zm0 0h444L480-830 258-720Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Denomination</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Chart of Account ID -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chart'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a href="{{ route('chart.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chart'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm80-160h80v-280h-80v280Zm160 0h80v-400h-80v400Zm160 0h80v-160h-80v160Zm80-320v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80ZM480-480Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chart
                                    Account</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Setup Cities/Towns -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['city'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['city']) ? 1 : 0 }} }">
                    <a href="{{ route('city.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M15 11V5l-3-3-3 3v2H3v14h18V11h-6zm-8 8H5v-2h2v2zm0-4H5v-2h2v2zm0-4H5V9h2v2zm6 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm0-4h-2V5h2v2zm6 12h-2v-2h2v2zm0-4h-2v-2h2v2z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Setup
                                    Cities/Towns</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Setup Barangays -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['barangay'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['barangay']) ? 1 : 0 }} }">
                    <a href="{{ route('barangay.index') }}" class="block text-slate-200 transition duration-150"
                        :class="open ? 'hover:text-slate-200' : 'hover:text-white'">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Setup
                                    Barangays</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Setup Customer Type -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['customer-type'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['customer-type']) ? 1 : 0 }} }">
                    <a href="{{ route('customerType.index') }}" class="block text-slate-200 transition duration-150"
                        :class="open ? 'hover:text-slate-200' : 'hover:text-white'">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M20 0H4v2h16V0zM4 24h16v-2H4v2zM20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-8 2.75c1.24 0 2.25 1.01 2.25 2.25s-1.01 2.25-2.25 2.25S9.75 10.24 9.75 9 10.76 6.75 12 6.75zM17 17H7v-1.5c0-1.67 3.33-2.5 5-2.5s5 .83 5 2.5V17z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Setup
                                    Customer Type</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-book-open-check-icon lucide-book-open-check">
                                    <path d="M12 21V7" />
                                    <path d="m16 12 2 2 4-4" />
                                    <path
                                        d="M22 6V4a1 1 0 0 0-1-1h-5a4 4 0 0 0-4 4 4 4 0 0 0-4-4H3a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h6a3 3 0 0 1 3 3 3 3 0 0 1 3-3h6a1 1 0 0 0 1-1v-1.3" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Leaves -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leaves'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaves']) ? 1 : 0 }} }">
                    <a href="{{ route('leaves.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leaves'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h5" />
                                    <path d="M17.5 17.5 16 16.3V14" />
                                    <circle cx="16" cy="16" r="6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leaves</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- performance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['performance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['performance']) ? 1 : 0 }} }">
                    <a href="{{ route('performance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['performance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                                    <path d="M12 16v5" />
                                    <path d="M16 14v7" />
                                    <path d="M20 10v11" />
                                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                    <path d="M4 18v3" />
                                    <path d="M8 14v7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- benefits -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['benefits'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['benefits']) ? 1 : 0 }} }">
                    <a href="{{ route('benefits.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['benefits'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-hand-heart-icon lucide-hand-heart">
                                    <path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16" />
                                    <path
                                        d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 15 6 6" />
                                    <path
                                        d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Benefits</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chats'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['rebates']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chats'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/chats">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17 0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chats</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endcan
            @can('branch_access')
                <!-- Branch Manager -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['dashboard']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/branch">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Loan Renewal -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['renewals'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('renewals.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['renewals'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                <rect fill="none" height="24" width="24" />
                                <path
                                    d="M17.66,9.53l-7.07,7.07l-4.24-4.24l1.41-1.41l2.83,2.83l5.66-5.66L17.66,9.53z M4,12c0-2.33,1.02-4.42,2.62-5.88L9,8.5v-6H3 l2.2,2.2C3.24,6.52,2,9.11,2,12c0,5.19,3.95,9.45,9,9.95v-2.02C7.06,19.44,4,16.07,4,12z M22,12c0-5.19-3.95-9.45-9-9.95v2.02 c3.94,0.49,7,3.86,7,7.93c0,2.33-1.02,4.42-2.62,5.88L15,15.5v6h6l-2.2-2.2C20.76,17.48,22,14.89,22,12z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                Renewals</span>
                        </div>
                    </a>
                </li>
                <!-- Customer Payments -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['todaysPayer', 'latePayer', 'paymentHistory'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['todaysPayer', 'latePayer', 'paymentHistory']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['todaysPayer', 'latePayer', 'paymentHistory'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <path d="M0,0h24v24H0V0z" fill="none" />
                                    <g>
                                        <path
                                            d="M19.5,3.5L18,2l-1.5,1.5L15,2l-1.5,1.5L12,2l-1.5,1.5L9,2L7.5,3.5L6,2v14H3v3c0,1.66,1.34,3,3,3h12c1.66,0,3-1.34,3-3V2 L19.5,3.5z M19,19c0,0.55-0.45,1-1,1s-1-0.45-1-1v-3H8V5h11V19z" />
                                        <rect height="2" width="6" x="9" y="7" />
                                        <rect height="2" width="2" x="16" y="7" />
                                        <rect height="2" width="6" x="9" y="10" />
                                        <rect height="2" width="2" x="16" y="10" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                    Payments</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['todaysPayer', 'latePayer', 'paymentHistory'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('todaysPayer.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('todaysPayer.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Todays
                                        Payer</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('latePayer.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('latePayer.index') }}"">
                                    <span
                                        class=" text-sm font-medium lg:opacity-0
                                                    lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Late
                                        Payer</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('paymentHistory.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('paymentHistory.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payment
                                        History</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Loan Status -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['approvedLoan', 'pendingLoandApproval', 'rejectedLoan'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['approvedLoan', 'pendingLoandApproval', 'rejectedLoan']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['approvedLoan', 'pendingLoandApproval', 'rejectedLoan'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <rect fill="none" height="24" width="24" />
                                        <path
                                            d="M17,12c-2.76,0-5,2.24-5,5s2.24,5,5,5c2.76,0,5-2.24,5-5S19.76,12,17,12z M18.65,19.35l-2.15-2.15V14h1v2.79l1.85,1.85 L18.65,19.35z M18,3h-3.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H6C4.9,3,4,3.9,4,5v15c0,1.1,0.9,2,2,2h6.11 c-0.59-0.57-1.07-1.25-1.42-2H6V5h2v3h8V5h2v5.08c0.71,0.1,1.38,0.31,2,0.6V5C20,3.9,19.1,3,18,3z M12,5c-0.55,0-1-0.45-1-1 c0-0.55,0.45-1,1-1c0.55,0,1,0.45,1,1C13,4.55,12.55,5,12,5z" />
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                    Status</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['approvedLoan', 'pendingLoandApproval', 'rejectedLoan'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('approvedLoan.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('approvedLoan.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Approved
                                        Loans</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('pendingLoandApproval.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('pendingLoandApproval.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pending
                                        Loans</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('rejectedLoan.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('rejectedLoan.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Rejected
                                        Loans</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['performance-record'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('performance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['performance-record'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                                <path d="M12 16v5" />
                                <path d="M16 14v7" />
                                <path d="M20 10v11" />
                                <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                <path d="M4 18v3" />
                                <path d="M8 14v7" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance
                                Record</span>
                        </div>
                    </a>
                </li>
                <!-- Customer Loan History -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['loanhistory'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('loanhistory.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['loanhistory'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="M480-80q-155 0-269-103T82-440h81q15 121 105.5 200.5T480-160q134 0 227-93t93-227q0-134-93-227t-227-93q-86 0-159.5 42.5T204-640h116v80H88q29-140 139-230t253-90q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm112-232L440-464v-216h80v184l128 128-56 56Z" />
                            </svg>
                            <span
                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Customer
                                Loan History</span>
                        </div>
                    </a>
                </li>
                <!-- Loan Information -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['loaninfo'])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('loanInformation.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['loaninfo'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px"
                                                viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M17.66,9.53l-7.07,7.07l-4.24-4.24l1.41-1.41l2.83,2.83l5.66-5.66L17.66,9.53z M4,12c0-2.33,1.02-4.42,2.62-5.88L9,8.5v-6H3 l2.2,2.2C3.24,6.52,2,9.11,2,12c0,5.19,3.95,9.45,9,9.95v-2.02C7.06,19.44,4,16.07,4,12z M22,12c0-5.19-3.95-9.45-9-9.95v2.02 c3.94,0.49,7,3.86,7,7.93c0,2.33-1.02,4.42-2.62,5.88L15,15.5v6h6l-2.2-2.2C20.76,17.48,22,14.89,22,12z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                                Information</span>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- CSOR -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('csor.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                width="24px" fill="#FFFFFF">
                                                <path
                                                    d="M320-320h200v-200H320v200Zm0-280h480v-200H320v200Zm280 280h200v-200H600v200Zm-280 80q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">CSOR</span>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- Automated Payment Reminders -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('reminderPay.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                                width="24px" fill="#F3F3F3">
                                                <path
                                                    d="M600-80v-80h160v-400H200v160h-80v-320q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H600ZM320 0l-56-56 103-104H40v-80h327L264-344l56-56 200 200L320 0ZM200-640h560v-80H200v80Zm0 0v-80 80Z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Automated
                                                Payment</span>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- Loan Accounts -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['regAccount', 'badAccount'])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['regAccount', 'badAccount']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (!in_array(Request::segment(1), ['regAccount', 'badAccount'])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                    width="24px" fill="#e8eaed">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Loan
                                    Accounts</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (!in_array(Request::segment(1), ['regAccount', 'badAccount', 'overdueacc'])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('regAccount.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('regAccount.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Regular
                                        Accounts</span>
                                </a>
                            </li>
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('badAccount.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('badAccount.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Bad
                                        Accounts</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Employee Request Forms -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), [
                        'leaveRequest',
                        'underRequest',
                        'idRequest',
                        'clearance',
                        'cashReqForm',
                        'cashBond',
                        'dailyworkorder',
                    ])) {{ 'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaveRequest', 'underRequest', 'idRequest', 'clearance', 'cashReqForm', 'cashBond', 'dailyworkorder']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (
                        !in_array(Request::segment(1), [
                            'leaveRequest',
                            'underRequest',
                            'idRequest',
                            'clearance',
                            'cashReqForm',
                            'cashBond',
                            'dailyworkorder',
                        ])) {{ 'hover:text-gray-900 dark:hover:text-white' }} @endif"
                        href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                    <g>
                                        <path d="M0,0h24v24H0V0z" fill="none" />
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M8,17c-0.55,0-1-0.45-1-1s0.45-1,1-1 s1,0.45,1,1S8.55,17,8,17z M8,13c-0.55,0-1-0.45-1-1s0.45-1,1-1s1,0.45,1,1S8.55,13,8,13z M8,9C7.45,9,7,8.55,7,8s0.45-1,1-1 s1,0.45,1,1S8.55,9,8,9z M14,10V4.5l5.5,5.5H14z" />
                                        </g>
                                    </g>
                                </svg>
                                <span
                                    class="text-sm font-medium ml-4 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Form</span>
                            </div>
                            <!-- Icon -->
                            <div
                                class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['employee'])) {{ 'rotate-180' }} @endif"
                                    :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                        <ul class="pl-10 mt-1 @if (
                            !in_array(Request::segment(1), [
                                'leaveRequest',
                                'underRequest',
                                'idRequest',
                                'clearance',
                                'cashReqForm',
                                'cashBond',
                                'dailyworkorder',
                            ])) {{ 'hidden' }} @endif"
                            :class="open ? '!block' : 'hidden'">
                            {{-- <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('leaveRequest.add')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('leaveRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leave
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('undertimeRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('undertimeRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Undertime
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('idRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('idRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">ID
                                                        Request</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('clearanceRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('clearanceRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Clearance
                                                        Request</span>
                                                    <span
                                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('dailyworkorder.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('dailyworkorder.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Daily
                                                        Work Order</span>
                                                </a>
                                            </li>
                                            <li class="mb-1 last:mb-0">
                                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cashadvanceRequest.index')) {{ '!text-violet-500' }} @endif"
                                                    href="{{ route('cashadvanceRequest.index') }}">
                                                    <span
                                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                                        Advance</span>
                                                    <span
                                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                                </a>
                                            </li> --}}
                            <li class="mb-1 last:mb-0">
                                <a class="block text-white hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cashBond.index')) {{ '!text-violet-500' }} @endif"
                                    href="{{ route('cashBond.index') }}">
                                    <span
                                        class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Cash
                                        Bond Loan</span>
                                    <span
                                        class="inline-flex items-center justify-center w-3 h-3 p-3 ms-6 text-sm font-semibold text-red-700 bg-red-200 rounded-full">2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- Request Check -->
                <li
                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['requestcheck'])) {{ 'bg-accent-100' }} @endif">
                    <a href="{{ route('requestcheck.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['requestcheck'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#F3F3F3">
                                    <path
                                        d="M440-200h80v-40h40q17 0 28.5-11.5T600-280v-120q0-17-11.5-28.5T560-440H440v-40h160v-80h-80v-40h-80v40h-40q-17 0-28.5 11.5T360-520v120q0 17 11.5 28.5T400-360h120v40H360v80h80v40ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-480H520ZM240-800v160-160 640-640Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Request
                                    Check</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Employee Evaluation -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['employeeEvaluation'])) {{ 'bg-accent-100' }} @endif"
                                    x-data="{ open: {{ in_array(Request::segment(1), ['employee-evaluation']) ? 1 : 0 }} }">
                                    <a href="{{ route('employeeEvaluation.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['employeeEvaluation'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                                    height="24px" viewBox="0 0 24 24" width="24px" fill="#e8eaed">
                                                    <g>
                                                        <rect fill="none" height="24" width="24" />
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <path
                                                                d="M21,8c-1.45,0-2.26,1.44-1.93,2.51l-3.55,3.56c-0.3-0.09-0.74-0.09-1.04,0l-2.55-2.55C12.27,10.45,11.46,9,10,9 c-1.45,0-2.27,1.44-1.93,2.52l-4.56,4.55C2.44,15.74,1,16.55,1,18c0,1.1,0.9,2,2,2c1.45,0,2.26-1.44,1.93-2.51l4.55-4.56 c0.3,0.09,0.74,0.09,1.04,0l2.55,2.55C12.73,16.55,13.54,18,15,18c1.45,0,2.27-1.44,1.93-2.52l3.56-3.55 C21.56,12.26,23,11.45,23,10C23,8.9,22.1,8,21,8z" />
                                                            <polygon
                                                                points="15,9 15.94,6.93 18,6 15.94,5.07 15,3 14.08,5.07 12,6 14.08,6.93" />
                                                            <polygon points="3.5,11 4,9 6,8.5 4,8 3.5,6 3,8 1,8.5 3,9" />
                                                        </g>
                                                    </g>
                                                </svg>
                                                <span
                                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Employee
                                                    Evaluation</span>
                                            </div>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- Payslip & Payroll -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), [''])) {{ 'bg-accent-100' }} @endif">
                                    <a href="{{ route('paroll.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['hr'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                                fill="#e8eaed">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M19 14V6c0-1.1-.9-2-2-2H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zm-9-1c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm13-6v11c0 1.1-.9 2-2 2H4v-2h17V7h2z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslip
                                                & Payroll</span>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- Attendance -->
                {{-- <li
                                    class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leave'])) {{ 'bg-accent-100' }} @endif"
                                    x-data="{ open: {{ in_array(Request::segment(1), ['leave']) ? 1 : 0 }} }">
                                    <a href="{{ route('biometricsAttendance.index') }}"
                                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leave'])) {{ 'hover:text-slate-200' }} @endif">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24"
                                                    width="24px" fill="#e8eaed">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M17.81 4.47c-.08 0-.16-.02-.23-.06C15.66 3.42 14 3 12.01 3c-1.98 0-3.86.47-5.57 1.41-.24.13-.54.04-.68-.2-.13-.24-.04-.55.2-.68C7.82 2.52 9.86 2 12.01 2c2.13 0 3.99.47 6.03 1.52.25.13.34.43.21.67-.09.18-.26.28-.44.28zM3.5 9.72c-.1 0-.2-.03-.29-.09-.23-.16-.28-.47-.12-.7.99-1.4 2.25-2.5 3.75-3.27C9.98 4.04 14 4.03 17.15 5.65c1.5.77 2.76 1.86 3.75 3.25.16.22.11.54-.12.7-.23.16-.54.11-.7-.12-.9-1.26-2.04-2.25-3.39-2.94-2.87-1.47-6.54-1.47-9.4.01-1.36.7-2.5 1.7-3.4 2.96-.08.14-.23.21-.39.21zm6.25 12.07c-.13 0-.26-.05-.35-.15-.87-.87-1.34-1.43-2.01-2.64-.69-1.23-1.05-2.73-1.05-4.34 0-2.97 2.54-5.39 5.66-5.39s5.66 2.42 5.66 5.39c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-2.42-2.09-4.39-4.66-4.39-2.57 0-4.66 1.97-4.66 4.39 0 1.44.32 2.77.93 3.85.64 1.15 1.08 1.64 1.85 2.42.19.2.19.51 0 .71-.11.1-.24.15-.37.15zm7.17-1.85c-1.19 0-2.24-.3-3.1-.89-1.49-1.01-2.38-2.65-2.38-4.39 0-.28.22-.5.5-.5s.5.22.5.5c0 1.41.72 2.74 1.94 3.56.71.48 1.54.71 2.54.71.24 0 .64-.03 1.04-.1.27-.05.53.13.58.41.05.27-.13.53-.41.58-.57.11-1.07.12-1.21.12zM14.91 22c-.04 0-.09-.01-.13-.02-1.59-.44-2.63-1.03-3.72-2.1-1.4-1.39-2.17-3.24-2.17-5.22 0-1.62 1.38-2.94 3.08-2.94 1.7 0 3.08 1.32 3.08 2.94 0 1.07.93 1.94 2.08 1.94s2.08-.87 2.08-1.94c0-3.77-3.25-6.83-7.25-6.83-2.84 0-5.44 1.58-6.61 4.03-.39.81-.59 1.76-.59 2.8 0 .78.07 2.01.67 3.61.1.26-.03.55-.29.64-.26.1-.55-.04-.64-.29-.49-1.31-.73-2.61-.73-3.96 0-1.2.23-2.29.68-3.24 1.33-2.79 4.28-4.6 7.51-4.6 4.55 0 8.25 3.51 8.25 7.83 0 1.62-1.38 2.94-3.08 2.94s-3.08-1.32-3.08-2.94c0-1.07-.93-1.94-2.08-1.94s-2.08.87-2.08 1.94c0 1.71.66 3.31 1.87 4.51.95.94 1.86 1.46 3.27 1.85.27.07.42.35.35.61-.05.23-.26.38-.47.38z" />
                                                </svg>
                                                <span
                                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                                            </div>
                                        </div>
                                    </a>
                                </li> --}}
                <!-- Attendance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['attendance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['attendance']) ? 1 : 0 }} }">
                    <a href="{{ route('attendance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['attendance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-book-open-check-icon lucide-book-open-check">
                                    <path d="M12 21V7" />
                                    <path d="m16 12 2 2 4-4" />
                                    <path
                                        d="M22 6V4a1 1 0 0 0-1-1h-5a4 4 0 0 0-4 4 4 4 0 0 0-4-4H3a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h6a3 3 0 0 1 3 3 3 3 0 0 1 3-3h6a1 1 0 0 0 1-1v-1.3" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Attendance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Payslips -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['payslips'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['payslips']) ? 1 : 0 }} }">
                    <a href="{{ route('payslips.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['payslips'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-receipt-text-icon lucide-receipt-text">
                                    <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                    <path d="M14 8H8" />
                                    <path d="M16 12H8" />
                                    <path d="M13 16H8" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Payslips</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- Leaves -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['leaves'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['leaves']) ? 1 : 0 }} }">
                    <a href="{{ route('leaves.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['leaves'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-clock-icon lucide-calendar-clock">
                                    <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />
                                    <path d="M16 2v4" />
                                    <path d="M8 2v4" />
                                    <path d="M3 10h5" />
                                    <path d="M17.5 17.5 16 16.3V14" />
                                    <circle cx="16" cy="16" r="6" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Leaves</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- performance -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['performance'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['performance']) ? 1 : 0 }} }">
                    <a href="{{ route('performance.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['performance'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined">
                                    <path d="M12 16v5" />
                                    <path d="M16 14v7" />
                                    <path d="M20 10v11" />
                                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15" />
                                    <path d="M4 18v3" />
                                    <path d="M8 14v7" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Performance</span>
                            </div>
                        </div>
                    </a>
                </li>
                <!-- benefits -->
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['benefits'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['benefits']) ? 1 : 0 }} }">
                    <a href="{{ route('benefits.index') }}"
                        class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['benefits'])) {{ 'hover:text-slate-200' }} @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-hand-heart-icon lucide-hand-heart">
                                    <path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16" />
                                    <path
                                        d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                                    <path d="m2 15 6 6" />
                                    <path
                                        d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Benefits</span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="px-3 py-3 hover:bg-accent-100 rounded-lg transition rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['chats'])) {{ 'bg-accent-100' }} @endif"
                    x-data="{ open: {{ in_array(Request::segment(1), ['chats']) ? 1 : 0 }} }">
                    <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(1), ['chats'])) {{ 'hover:text-slate-200' }} @endif"
                        href="/chats">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17 0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Z" />
                                </svg>
                                <span
                                    class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Chats</span>
                            </div>
                        </div>
                    </a>
                </li>
            @endcan
        </ul>
    </div>

    <!-- Toggle Button (Mobile) -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="fixed bottom-4 left-4 z-50 lg:hidden bg-primary-100 text-white p-2 rounded-full shadow-lg focus:outline-none focus:ring">
        <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>
