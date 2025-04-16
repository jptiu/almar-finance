<html lang="en">

<head>
    <title>Print Statement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">
        <div class="text-center mb-2 mt-2">
            <div class="text-gray-600">
                <div class="text-base font-bold border-b-2 border-gray-300 pb-2">Customer Profile Report</div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-12">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-base font-semibold">Almar Freemile Financing Corporation,</div>
                    <div class="text-base font-semibold"></div>
                    {{-- <div class="text-md font-semibold">Lapu-Lapu City, Cebu, 6015</div> --}}
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-base font-bold"></div>
                </div>
            </div>
        </div>

        <!-- Date Filed and Customer ID -->
        <!-- <div class="flex justify-between mb-4">
            <p><span class="font-bold">Date Filed:</span> 11/13/24</p>
            <p><span class="font-bold">Date Released:</span> 11/14/24</p>
            <p><span class="font-bold">Customer ID:</span> 10257</p>
        </div> -->

        <!-- Section Template -->
        <!-- <div>
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Loan Details
            </button>
            <div id="loan-details" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Proposed Loan:</span> ₱20,000.00</p>
                    <p><span class="font-bold">Terms:</span> 4 months</p>
                    <p><span class="font-bold">Interest:</span> 4%</p>
                </div>
            </div>
        </div> -->

        <div class="mt-4">
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Personal Information
            </button>
            <div id="personal-info" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Customer Type:</span> {{$customer->type??""}}</p>
                    <p><span class="font-bold">Full Name:</span> {{$customer->first_name??""}} {{$customer->middle_name??""}} {{$customer->last_name??""}}</p>
                    <p><span class="font-bold">Personal Contact Number:</span> {{$customer->cell_number??""}}</p>
                    <p><span class="font-bold">Birthdate:</span> {{$customer->birth_date??""}}</p>
                    <p><span class="font-bold">Birth Place:</span> {{$customer->birth_place??""}}</p>
                    <p><span class="font-bold">Address:</span> {{$customer->house??""}}, {{$customer->street??""}},
                    {{$customer->barangay??""}}, {{$customer->city??""}}</p>
                    <p><span class="font-bold">Civil Status:</span> {{$customer->civil_status??""}}</p>
                    <p><span class="font-bold">Age:</span> {{$customer->age??""}}</p>
                    <p><span class="font-bold">Gender:</span> {{$customer->gender??""}}</p>
                    <p><span class="font-bold">Citizenship:</span> {{$customer->citizenship??""}}</p>
                    <p><span class="font-bold">Email Address:</span> {{$customer->email??""}}</p>
                    <p><span class="font-bold">Facebook:</span> {{$customer->spouse_fb??""}}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Spousal Data
            </button>
            <div id="spousal-data" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Complete Name of Spouse:</span> {{$customer->spouse_name??""}}</p>
                    <p><span class="font-bold">Personal Contact Number:</span> {{$customer->cell_number??""}}</p>
                    <p><span class="font-bold">Birthdate:</span> {{$customer->spouse_bdate??""}}</p>
                    <p><span class="font-bold">Age:</span> {{$customer->spouse_age??""}}</p>
                    <p><span class="font-bold">Occupation:</span> {{$customer->occupation??""}}</p>
                    <p><span class="font-bold">Company Name/ Address:</span> {{$customer->c_nameadd??""}}</p>
                    <p><span class="font-bold">Facebook:</span> {{$customer->spouse_fb??""}}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Company Information
            </button>
            <div id="company-info" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Agency Name:</span> {{$customer->agency_name??""}}</p>
                    <p><span class="font-bold">Address / Tel. no:</span> {{$customer->add_tel??""}}</p>
                    <p><span class="font-bold">Company Name:</span> {{$customer->comp_name??""}}</p>
                    <p><span class="font-bold">Address / Tel. no:</span> {{$customer->add_telc??""}}</p>
                    <p><span class="font-bold">Date of Hire:</span> {{$customer->date_hired??""}}</p>
                    <p><span class="font-bold">Day Off:</span> {{$customer->day_off??""}}</p>
                    <p><span class="font-bold">Position:</span> {{$customer->job_position??""}}</p>
                    <p><span class="font-bold">Monthly Salary:</span> {{$customer->monthly_salary??""}}</p>
                    <p><span class="font-bold">Salary Schedule:</span> {{$customer->salary_sched??""}}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                For Pensioners ONLY
            </button>
            <div id="bank-info" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Monthly Pension:</span> {{$customer->monthly_pension??""}}</p>
                    <p><span class="font-bold">Pension Schedule:</span> {{$customer->pension_sched??""}}</p>
                    <p><span class="font-bold">Pension Type:</span> {{$customer->pension_type??""}}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Background Data
            </button>
            <div id="bank-info" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Bank/Branch:</span> {{$customer->fathers_name??""}}</p>
                    <p><span class="font-bold">Contact No.:</span> {{$customer->fathers_num??""}}</p>
                    <p><span class="font-bold">Mother's Name:</span> {{$customer->mothers_name??""}}</p>
                    <p><span class="font-bold">Contact No.:</span> {{$customer->mothers_num??""}}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button class="w-full text-left font-bold bg-gray-200 px-4 py-2 rounded-md focus:outline-none">
                Bank Information
            </button>
            <div id="bank-info" class="p-4 bg-gray-50 rounded-md ">
                <div class="grid grid-cols-2 gap-4">
                    <p><span class="font-bold">Bank/Branch:</span> {{$customer->branch??""}}</p>
                    <p><span class="font-bold">Card No.:</span> {{$customer->card_no??""}}</p>
                    <p><span class="font-bold">Account No.:</span> {{$customer->acc_no??""}}</p>
                    <p><span class="font-bold">PIN No.:</span> {{$customer->pin_no??""}}</p>
                </div>
            </div>
        </div>   

</body>

</html>
