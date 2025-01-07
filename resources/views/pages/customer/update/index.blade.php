<x-app-layout>
    <section class="container px-4 mx-auto py-8">
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-1/4 bg-wshade-100 p-6 rounded-lg">
                <a href="{{ route('customer.index') }}" class="text-gray-600 font-medium block mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </a>
                <h2 class="text-lg font-semibold pt-8">Loan Application Form</h2>
                <p class="text-sm text-gray-500 mb-6">Complete all the steps to proceed</p>
                <ul id="sidebar-steps">
                    <li id="step1-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 bg-indigo-600 text-white flex items-center justify-center rounded-full">
                            <span class="icon">1</span>
                        </div>
                        <span class="text-gray-500 font-medium">Personal Information</span>
                    </li>
                    <li id="step2-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 border-2 border-gray-300 text-gray-500 flex items-center justify-center rounded-full">
                            <span class="icon">2</span>
                        </div>
                        <span class="text-gray-500 font-medium">Spousal Data</span>
                    </li>
                    <li id="step3-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 border-2 border-gray-300 text-gray-500 flex items-center justify-center rounded-full">
                            <span class="icon">3</span>
                        </div>
                        <span class="text-gray-500 font-medium">Company Information</span>
                    </li>
                    <li id="step4-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 border-2 border-gray-300 text-gray-500 flex items-center justify-center rounded-full">
                            <span class="icon">4</span>
                        </div>
                        <span class="text-gray-500 font-medium">Pensioners Only</span>
                    </li>
                    <li id="step5-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 border-2 border-gray-300 text-gray-500 flex items-center justify-center rounded-full">
                            <span class="icon">5</span>
                        </div>
                        <span class="text-gray-500 font-medium">Background Data</span>
                    </li>
                    <li id="step6-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 border-2 border-gray-300 text-gray-500 flex items-center justify-center rounded-full">
                            <span class="icon">6</span>
                        </div>
                        <span class="text-gray-500 font-medium">Bank Account Information</span>
                    </li>
                    <li id="step6-indicator" class="step-indicator flex items-center space-x-4 mb-4">
                        <div
                            class="icon-container w-8 h-8 border-2 border-gray-300 text-gray-500 flex items-center justify-center rounded-full">
                            <span class="icon">6</span>
                        </div>
                        <span class="text-gray-500 font-medium">Review</span>
                    </li>
                </ul>
            </div>

            <!-- Form Content -->
            <div class="w-3/4 bg-white p-8">
                <form id="form" action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    <!-- Step 1 -->

                    <div id="step1" class="form-step">
                        <h2 class="text-xl font-semibold mb-6 pt-8">Personal Information</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">Customer
                                    Type</label>
                                <select name="type" id="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                @foreach ($types as $type)
                                    <option value="{{ $type->code }}"
                                        {{ $customer->customerType->description == $type->description ? 'selected' : '' }}>
                                        {{ $type->description }}</option>
                                @endforeach
                                </select>
                                <span class="text-red-500 text-xs hidden" id="error_applicant_name">This field is
                                    required.</span>
                            </div>
                            <div class="md:col-span-2">

                            </div>
                            <div class="md:col-span-1">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First
                                    Name</label>
                                <input value="{{ $customer->first_name }}" type="text" name="first_name"
                                    id="first_name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_applicant_name">This field is
                                    required.</span>
                            </div>


                            <div class="md:col-span-1">
                                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle
                                    Name</label>
                                <input value="{{ $customer->middle_name }}" type="text" name="middle_name"
                                    id="middle_name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_applicant_name">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last
                                    Name</label>
                                <input value="{{ $customer->last_name }}" type="text" name="last_name" id="last_name"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_applicant_name">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1">
                                <label for="cell_number" class="block text-sm font-medium text-gray-700">Personal
                                    Contact Number</label>
                                <input value="{{ $customer->cell_number }}" type="text" name="cell_number"
                                    id="cell_number" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_cell_number">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-2">
                                <label for="birth_date"
                                    class="block text-sm font-medium text-gray-700">Birthdate</label>
                                <input value="{{ $customer->birth_date }}" type="date" name="birth_date"
                                    id="birth_date" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_birthdate">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-2">
                                <label for="birth_place" class="block text-sm font-medium text-gray-700">Birth
                                    Place</label>
                                <input value="{{ $customer->birth_place }}" type="text" name="birth_place"
                                    id="birth_place" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_birth_place">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1.5">
                                <label for="house" class="block text-sm font-medium text-gray-700">House
                                    Address</label>
                                <input value="{{ $customer->house }}" type="text" name="" id="house"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_house">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1.5">
                                <label for="street" class="block text-sm font-medium text-gray-700">Street
                                    Address</label>
                                <input value="{{ $customer->street }}" type="text" name="" id="street"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_street">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1.5">
                                <label for="barangay" class="block text-sm font-medium text-gray-700">Barangay
                                    Address</label>
                                <select name="barangay" id="barangay"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->id }}"
                                            {{ $customer->barangay == $barangay->id ? 'selected' : '' }}>
                                            {{ $barangay->barangay_name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input value="{{ $customer->barangay_name }}" type="text" name="barangay"
                                    id="barangay" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_barangay">This field is
                                    required.</span> --}}
                            </div>

                            <div class="md:col-span-1.5">
                                <label for="city" class="block text-sm font-medium text-gray-700">City
                                    Address</label>
                                <select name="city" id="city"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ $customer->city == $city->id ? 'selected' : '' }}>
                                            {{ $city->city_town }}</option>
                                    @endforeach
                                </select>
                                {{-- <input value="{{ $customer->city_town }}" type="text" name="city"
                                    id="city" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_city">This field is
                                    required.</span> --}}
                            </div>

                            <div class="md:col-span-1">
                                <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil
                                    Status</label>
                                <input value="{{ $customer->civil_status }}" type="text" name="civil_status"
                                    id="civil_status" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_civil_status">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1">
                                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                <input value="{{ $customer->age }}" type="number" name="age" id="age"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_age">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1">
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <input value="{{ $customer->gender }}" type="text" name="gender" id="gender"
                                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_gender">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-1">
                                <label for="citizenship"
                                    class="block text-sm font-medium text-gray-700">Citizenship</label>
                                <input value="{{ $customer->citizenship }}" type="text" name="citizenship"
                                    id="citizenship" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_citizenship">This field is
                                    required.</span>
                            </div>

                            <div class="md:col-span-2">
                                <label for="facebook_name" class="block text-sm font-medium text-gray-700">Facebook
                                    Name</label>
                                <input value="{{ $customer->facebook_name }}" type="text" name="facebook_name"
                                    id="facebook_name" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm">
                                <span class="text-red-500 text-xs hidden" id="error_facebook_name">This field is
                                    required.</span>
                            </div>

                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div id="step2" class="form-step hidden">
                        <h2 class="text-xl font-semibold mb-6 pt-8">Spousal Data</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="spouse_name">Complete Name of Spouse/ Live in Partner</label>
                                <div>
                                    <input value="{{ $customer->spouse_name }}" name="spouse_name" id="spouse_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="spouse_number">Contact Number</label>
                                <div>
                                    <input value="{{ $customer->spouse_number }}" type="number"
                                        name="spouse_number" id="spouse_number"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="spouse_bdate">Birthdate</label>
                                <input value="{{ $customer->spouse_bdate }}" type="date" name="spouse_bdate"
                                    id="spouse_bdate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="spouse_age">spouse_age</label>
                                <div>
                                    <input value="{{ $customer->spouse_age }}" type="number" name="spouse_age"
                                        id="spouse_age"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="occupation">Occupation</label>
                                <div>
                                    <input value="{{ $customer->occupation }}" name="occupation" id="occupation"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="c_nameadd">Company Name/ Address</label>
                                <div>
                                    <input value="{{ $customer->c_nameadd }}" name="c_nameadd" id="c_nameadd"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="spouse_fb">Facebook Name</label>
                                <div>
                                    <input value="{{ $customer->spouse_fb }}" name="spouse_fb" id="spouse_fb"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div id="step3" class="form-step hidden">
                        <h2 class="text-xl font-semibold mb-6 pt-8">Company Information</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="agency_name">Agency Name</label>
                                <div>
                                    <input value="{{ $customer->agency_name }}" name="agency_name" id="agency_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="add_tel">Address / Tel. no.</label>
                                <div>
                                    <input value="{{ $customer->add_tel }}" name="add_tel" id="add_tel"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="comp_name">Company Name</label>
                                <div>
                                    <input value="{{ $customer->comp_name }}" name="comp_name" id="comp_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="add_telc">Address / Tel. no.</label>
                                <div>
                                    <input value="{{ $customer->add_telc }}" name="add_telc" id="add_telc"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="date_hired">Date Hired</label>
                                <input value="{{ $customer->date_hired }}" type="date" name="date_hired"
                                    id="date_hired"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="" />
                            </div>

                            <div class="md:col-span-2">
                                <label for="day_off">Day Off</label>
                                <div>
                                    <input value="{{ $customer->day_off }}" name="day_off" id="day_off"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-1">
                                <label for="job_position">Position</label>
                                <div>
                                    <input value="{{ $customer->job_position }}" name="job_position"
                                        id="job_position"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-1">
                                <label for="monthly_salary">Monthly Salary</label>
                                <div>
                                    <input value="{{ $customer->monthly_salary }}" name="monthly_salary"
                                        id="monthly_salary"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-1">
                                <label for="salary_sched">Salary Schedule</label>
                                <div>
                                    <input value="{{ $customer->salary_sched }}" name="salary_sched"
                                        id="salary_sched"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div id="step4" class="form-step hidden">
                        <h2 class="text-xl font-semibold mb-6 pt-8">For Pensioners ONLY</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="monthly_pension">Monthly Pension</label>
                                <div>
                                    <input value="{{ $customer->monthly_pension }}" name="monthly_pension"
                                        id="monthly_pension"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="pension_sched">Pension Schedule</label>
                                <div>
                                    <input value="{{ $customer->pension_sched }}" name="pension_sched"
                                        id="pension_sched"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="pension_type">Pension Type</label>
                                <div>
                                    <input value="{{ $customer->pension_type }}" name="pension_type"
                                        id="pension_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div id="step5" class="form-step hidden">
                        <h2 class="text-xl font-semibold mb-6 pt-8">Background Data</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="fathers_name">Father's Name</label>
                                <div>
                                    <input value="{{ $customer->fathers_name }}" name="fathers_name"
                                        id="fathers_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="cell_number">Contact No.</label>
                                <div>
                                    <input value="{{ $customer->cell_number }}" type="number" name="cell_number"
                                        id="cell_number"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="mothers_name">Mother's Name</label>
                                <div>
                                    <input value="{{ $customer->mothers_name }}" name="mothers_name"
                                        id="mothers_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="cell_number">Contact No.</label>
                                <div>
                                    <input value="{{ $customer->cell_number }}" type="number" name="cell_number"
                                        id="cell_number"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div id="step6" class="form-step hidden">
                        <h2 class="text-xl font-semibold mb-6 pt-8">Bank Account Informations</h2>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="branch">Bank / Branch</label>
                                <div>
                                    <input value="{{ $customer->branch }}" name="branch" id="branch"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="card_no">Card No.</label>
                                <div>
                                    <input value="{{ $customer->card_no }}" name="card_no" id="card_no"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="acc_no">Account No.</label>
                                <div>
                                    <input value="{{ $customer->acc_no }}" name="acc_no" id="acc_no"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="pin_no">Pin No.</label>
                                <div>
                                    <input value="{{ $customer->pin_no }}" name="pin_no" id="pin_no"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                </div>
                            </div>

                        </div>
                    </div>


                    <div id="review-step" class="form-step hidden">
                        <!-- Step Review-->

                        <!-- First Section: Personal Information -->
                        <div>

                            <div class="flex justify-between ">
                                <h3 class="text-2xl font-semibold mb-4">Personal Information</h3>
                                <a href="step1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#434343">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Customer Type:</div>
                                    <div class="text-gray-900">{{ $customer->type }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Full Name:</div>
                                    <div class="text-gray-900">{{ $customer->first_name }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Personal Contact Number:</div>
                                    <div class="text-gray-900">{{ $customer->cell_number }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Birthdate:</div>
                                    <div class="text-gray-900">{{ $customer->birth_date }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Birth Place:</div>
                                    <div class="text-gray-900">{{ $customer->birth_place }} </div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Address:</div>
                                    <div class="text-gray-900">{{ $customer->house }}, {{ $customer->street }},
                                        {{ $customer->barangay }}, {{ $customer->city }}
                                    </div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Civil Status:</div>
                                    <div class="text-gray-900">{{ $customer->civil_status }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Age:</div>
                                    <div class="text-gray-900">{{ $customer->age }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Gender:</div>
                                    <div class="text-gray-900">{{ $customer->gender }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Citizenship:</div>
                                    <div class="text-gray-900">{{ $customer->citizenship }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Facebook:</div>
                                    <div class="text-gray-900">{{ $customer->facebook_name }}</div>
                                </li>
                            </div>

                        </div>

                        <!-- Separator Line -->
                        <hr class="my-6 border-gray-300" />

                        <!-- Second Section: Spousal Data -->

                        <div>

                            <div class="flex justify-between ">
                                <h3 class="text-2xl font-semibold mb-4">Spousal Data</h3>
                                <a href="step1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#434343">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Complete Name of Spouse:</div>
                                    <div class="text-gray-900">{{ $customer->spouse_name }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Personal Contact Number:</div>
                                    <div class="text-gray-900">{{ $customer->spouse_number }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Birthdate:</div>
                                    <div class="text-gray-900">{{ $customer->spouse_bdate }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Age:</div>
                                    <div class="text-gray-900">{{ $customer->spouse_age }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Occupation:</div>
                                    <div class="text-gray-900">{{ $customer->occupation }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Company Name/ Address:</div>
                                    <div class="text-gray-900">{{ $customer->c_nameadd }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Facebook:</div>
                                    <div class="text-gray-900">{{ $customer->spouse_fb }}</div>
                                </li>
                            </div>

                        </div>

                        <!-- Separator Line -->
                        <hr class="my-6 border-gray-300" />

                        <!-- Third Section: Company Information -->
                        <div>

                            <div class="flex justify-between ">
                                <h3 class="text-2xl font-semibold mb-4">Company Information</h3>
                                <a href="step1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#434343">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Agency Name:</div>
                                    <div class="text-gray-900">{{ $customer->agency_name }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Address / Tel. no:</div>
                                    <div class="text-gray-900">{{ $customer->add_tel }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Company Name:</div>
                                    <div class="text-gray-900">{{ $customer->comp_name }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Address / Tel. no:</div>
                                    <div class="text-gray-900">{{ $customer->add_telc }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Date Hired:</div>
                                    <div class="text-gray-900">{{ $customer->date_hired }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Day Off:</div>
                                    <div class="text-gray-900">{{ $customer->day_off }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Position:</div>
                                    <div class="text-gray-900">{{ $customer->job_position }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Monthly Salary:</div>
                                    <div class="text-gray-900">{{ $customer->monthly_salary }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Salary Schedule:</div>
                                    <div class="text-gray-900">{{ $customer->salary_sched }}</div>
                                </li>
                            </div>

                        </div>

                        <!-- Separator Line -->
                        <hr class="my-6 border-gray-300" />

                        <!-- Fourth Section: For Pensioners ONLY -->
                        <div>

                            <div class="flex justify-between ">
                                <h3 class="text-2xl font-semibold mb-4">For Pensioners ONLY</h3>
                                <a href="step1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#434343">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Monthly Pension:</div>
                                    <div class="text-gray-900">{{ $customer->monthly_pension }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Pension Schedule:</div>
                                    <div class="text-gray-900">{{ $customer->pension_sched }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Pension Type:</div>
                                    <div class="text-gray-900">{{ $customer->pension_type }}</div>
                                </li>

                            </div>

                        </div>

                        <!-- Separator Line -->
                        <hr class="my-6 border-gray-300" />

                        <!-- Fifth Section: Background Data -->
                        <div>

                            <div class="flex justify-between ">
                                <h3 class="text-2xl font-semibold mb-4">Background Data</h3>
                                <a href="step1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#434343">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Father's Name:</div>
                                    <div class="text-gray-900">{{ $customer->fathers_name }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Contact No.:</div>
                                    <div class="text-gray-900">{{ $customer->fathers_num }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Mother's Name:</div>
                                    <div class="text-gray-900">{{ $customer->mothers_name }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Contact No.:</div>
                                    <div class="text-gray-900">{{ $customer->mothers_num }}</div>
                                </li>
                            </div>

                        </div>

                        <!-- Separator Line -->
                        <hr class="my-6 border-gray-300" />

                        <!-- Last Section: Bank Account Informations -->
                        <div>

                            <div class="flex justify-between ">
                                <h3 class="text-2xl font-semibold mb-4">Bank Account Informationsn</h3>
                                <a href="step1" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#434343">
                                        <path
                                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z" />
                                    </svg>
                                </a>
                            </div>

                            <div>
                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Bank / Branch:</div>
                                    <div class="text-gray-900">{{ $customer->branch }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Card No.:</div>
                                    <div class="text-gray-900">{{ $customer->card_no }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Account No.:</div>
                                    <div class="text-gray-900">{{ $customer->acc_no }}</div>
                                </li>

                                <li class="flex flex-wrap mb-2">
                                    <div class="text-gray-500 w-72">Pin No.:</div>
                                    <div class="text-gray-900">{{ $customer->pin_no }}</div>
                                </li>

                            </div>

                        </div>

                    </div>




                    <!-- Navigation Buttons -->
                    <div class="mt-8 flex justify-between">
                        <a id="prev-btn" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg" disabled>Previous</a>
                        <a id="next-btn" class="bg-indigo-600 text-white px-6 py-2 rounded-lg">Next</a>
                        <button id="submit" type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg"
                            hidden>Submit</button>
                    </div>
                </form>
            </div>
    </section>

</x-app-layout>


<script>
    const steps = document.querySelectorAll('.form-step');
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit');
    const form = document.getElementById('form');
    const stepIndicators = document.querySelectorAll('.step-indicator');

    let currentStep = 0;

    function showStep(index) {
        // Update form steps
        steps.forEach((step, i) => {
            step.classList.toggle('hidden', i !== index);
            step.style.opacity = i === index ? '1' : '0';
            step.style.transition = 'opacity 0.5s ease-in-out';
        });

        // Update sidebar animations
        stepIndicators.forEach((indicator, i) => {
            const stepCircle = indicator.querySelector('div');
            if (i === index) {
                stepCircle.classList.add('bg-indigo-600', 'text-white');
                stepCircle.classList.remove('border-gray-300', 'text-gray-500');
                indicator.classList.add('animate-slide');
            } else {
                stepCircle.classList.remove('bg-indigo-600', 'text-white');
                stepCircle.classList.add('border-gray-300', 'text-gray-500');
                indicator.classList.remove('animate-slide');
            }
        });

        prevBtn.disabled = index === 0;
        nextBtn.textContent = index === steps.length - 1 ? 'Submit' : 'Next';
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
        if (currentStep == 6) {
            nextBtn.classList.add('hidden'); // Hide the Next button
            const submitBtn = document.getElementById('submit');
            submitBtn.removeAttribute('hidden');
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    submitBtn.addEventListener('click', (event) => {
        // Submit the form
        form.submit();
    });

    // Initialize the form to show the first step
    showStep(currentStep);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const formContainer = document.getElementById("form-container");
        const overviewPage = document.getElementById("overview-page");
        const nextBtn = document.getElementById("next-btn");
        const prevBtn = document.getElementById("prev-btn");
        const editBtn = document.getElementById("edit-btn");
        const submitBtn = document.getElementById("submit-btn");

        const steps = document.querySelectorAll(".form-step");
        let currentStep = 0;

        // Store user data
        const formData = {};

        // Show a specific step
        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle("hidden", i !== index);
            });

            prevBtn.classList.toggle("hidden", index === 0);
            nextBtn.innerText = index === steps.length - 1 ? "Review" : "Next";
        }

        // Populate the overview page with collected data
        function populateOverview() {
            document.getElementById("overview-applicant-name").innerText = formData["applicantName"] ||
                "Not provided";
            document.getElementById("overview-contact-number").innerText = formData["contactNumber"] ||
                "Not provided";
            document.getElementById("overview-spouse-name").innerText = formData["spouseName"] ||
                "Not provided";

            // Add more fields dynamically
        }

        // Collect data from the form fields
        function collectFormData() {
            formData["applicantName"] = document.getElementById("applicant-name").value;
            formData["contactNumber"] = document.getElementById("contact-number").value;
            formData["spouseName"] = document.getElementById("spouse-name").value;

            // Add more fields dynamically
        }

        function showStep(stepIndex) {
            // Hide all steps
            steps.forEach((step, index) => {
                step.classList.toggle("hidden", index !== stepIndex);
            });

            // Update buttons visibility
            prevBtn.classList.toggle("hidden", stepIndex === 0);
            nextBtn.innerText = stepIndex === steps.length - 1 ? "Submit" : "Next";

            // Update sidebar indicators
            stepIndicators.forEach((indicator, index) => {
                const iconContainer = indicator.querySelector(".icon-container");
                const icon = indicator.querySelector(".icon");

                if (index < stepIndex) {
                    iconContainer.classList.add("bg-green-500");
                    iconContainer.classList.remove("bg-indigo-600", "border-gray-300");
                    icon.textContent = "✓";
                    icon.classList.add("text-white");
                } else if (index === stepIndex) {
                    iconContainer.classList.add("bg-indigo-600");
                    iconContainer.classList.remove("bg-green-500", "border-gray-300");
                    icon.textContent = index + 1;
                    icon.classList.add("text-white");
                } else {
                    iconContainer.classList.add("border-gray-300");
                    iconContainer.classList.remove("bg-green-500", "bg-indigo-600");
                    icon.textContent = index + 1;
                    icon.classList.remove("text-white");
                }
            });
        }

        // Navigation: Next
        nextBtn.addEventListener("click", function() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            } else {
                // Collect data and show overview
                collectFormData();
                formContainer.classList.add("hidden");
                overviewPage.classList.remove("hidden");
                populateOverview();
            }
        });

        // Navigation: Previous
        prevBtn.addEventListener("click", function() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });

        // Edit Button
        // editBtn.addEventListener("click", function() {
        //     overviewPage.classList.add("hidden");
        //     formContainer.classList.remove("hidden");
        //     showStep(currentStep);
        // });

        // Submit Button
        // submitBtn.addEventListener("click", function() {
        //     alert("Form Submitted Successfully!");
        //     console.log("Submitted Data:", formData);

        //     // You can send the data to your server here via AJAX/Fetch
        // });

        // Initialize the first step
        showStep(currentStep);
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const nextButton = document.getElementById("next-btn");
        // const fields = [
        //     "first_name",
        //     "middle_name",
        //     "last_name",
        //     "cell_number",
        //     "birth_date",
        //     "birth_place",
        //     "permanent_address",
        //     "present_address",
        //     "civil_status",
        //     "age",
        //     "gender",
        //     "citizenship",
        //     "facebook_name",
        // ];

        // Function to check if all fields are filled
        // function checkFields() {
        //     let allFilled = true;

        //     fields.forEach((fieldId) => {
        //         const input = document.getElementById(fieldId);
        //         const value = input.value.trim();

        //         if (value === "") {
        //             allFilled = false;
        //         }
        //     });

        //     // Enable or disable the button based on field values
        //     nextButton.disabled = !allFilled;
        //     if (allFilled) {
        //         nextButton.classList.remove("bg-gray-300", "cursor-not-allowed");
        //         nextButton.classList.add("bg-indigo-600", "hover:bg-indigo-700");
        //     } else {
        //         nextButton.classList.add("bg-gray-300", "cursor-not-allowed");
        //         nextButton.classList.remove("bg-indigo-600", "hover:bg-indigo-700");
        //     }
        // }

        // // Add event listeners to all fields to track input changes
        // // fields.forEach((fieldId) => {
        // //     const input = document.getElementById(fieldId);

        // //     // Check fields on input
        // //     input.addEventListener("input", checkFields);
        // // });

        // // Initial check on page load
        // checkFields();
    });
</script>

<style>
    .hidden {
        display: none;
    }

    .animate-slide {
        position: relative;
        animation: slideIn 0.5s ease-in-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-20px);
            opacity: 0.5;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
