<html lang="en">

<head>
    <title>Daily Work Order Request</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">

        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-md font-semibold">Almar Freemile Financing Corporation,</div>
                    <div class="text-md font-semibold">{{$branch_address->location}}</div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-bold">{{$list->created_at->format('F d Y')}}</div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <div class="text-xl font-semibold py-2 text-center uppercase">Daily Work Order Request</div>
        </div>

        <div class="mt-4">
            <table class="min-w-full bg-white">
                <tr>
                    <td class="border px-4 py-2 font-bold bg-slate-100" style="width: 30%;">Type of Holiday</td>
                    <td class="border px-4 py-2" style="width: 70%;">{{$list->type_of_holiday}}</td>
                </tr>
                <tr>
                    <td class="border px-4 py-2 font-bold bg-slate-100" style="width: 30%;">Date</td>
                    <td class="border px-4 py-2" style="width: 70%;">{{$list->date->format('F d Y')}}</td>
                </tr>
            </table>
        </div>


        <div class="mt-8">
            <div class="border-2 p-4">
                <p>The employees of <strong>Almar Freemile Financing Corporation - {{$branch_address->location}}</strong>, led by <strong>{{$list->user->name}}</strong>, 
                are willing to work on the upcoming holiday, <strong>{{$list->date->format('F d Y l')}}</strong>, to benefit the company. We cannot collect 
                advance payments because our customers' prefer daily collections. We will strive to improve our collection efforts.</p>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-center font-semibold">At our instance,</div>
            <div class="flex flex-col items-center mt-4 gap-6">
                <div class="text-center">
                    <div class="font-bold border-b-2 border-gray-300">GEMPOLS A. BERI0S0</div>
                    <div>BRANCH MANAGER</div>
                </div>
                <div class="text-center px-4">
                    <div class="font-bold border-b-2 border-gray-300">JHEAN V. SIONG</div>
                    <div>LOAN OFFICER</div>
                </div>
                <div class="text-center px-4">
                    <div class="font-bold border-b-2 border-gray-300">JONNY O. SANGCAON</div>
                    <div>COLLECTOR</div>
                </div>
            </div>
        </div>

    </div>

    <br>

</body>

</html>
