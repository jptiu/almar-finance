<html lang="en">

<head>
    <title>Cash Bond Loan Agreement</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="px-2 py-1 max-w-5xl mx-auto">

        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="text-gray-600">
                    <img class="h-auto" src="/images/almarlogo.png" alt="almar suites">
                    <div class="text-md font-semibold">Almar Freemile Financing Corporation,</div>
                    <div class="text-md font-semibold">Therese Joy's Arcade, Pusok</div>
                    <div class="text-md font-semibold">Lapu-Lapu City, Cebu, 6015</div>
                </div>
            </div>
            <div class="flex items-center">
                <div class="text-gray-600">
                    <div class="text-md font-bold">October 22, 2024</div>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <div class="text-xl font-semibold py-2 text-center uppercase">Check Request Form</div>

            <div class="text-lg font-normal pt-4 pt-4">
                Date of Request: <span class="text-lg font-medium underline">{{$check->request_date}}</span>
            </div>

            <div class="text-lg font-normal pt-4 pt-4">
                Name of Requestor: <span class="text-lg font-medium underline">{{$check->requestor_name}}</span>
            </div>

            <div class="text-lg font-normal pt-4 pt-4">
                Amount of Check: <span class="text-lg font-medium underline">{{$check->amount}}</span>
            </div>

            <div class="text-lg font-normal pt-4 pt-4">
                Purpose: <span class="text-lg font-medium underline">{{$check->purpose}}</span>
            </div>

            <div class="text-md font-normal pt-4 pt-4 mt-8">
                <p>
                    All receipt(s) MUST be attached to this form if items have already been purchased. If purchase has been approved
                    but not yet made, please submit the receipts to the treasurer or the person incharge as soon as possible.
                </p>
            </div>

        </div>

        <br>
        <br>
            <div class="flex flex-col items-center" style="float: right;">
                <img class="h-auto w-1/4" src="/images/sample signature.png" alt="almar suites">
                <div class="text-center font-medium mt-2">JHON DOE</div>
                <hr class="w-1/2 mt-2" />
                <div class="text-center mt-2">Approver's Signature Over Printed Name</div>
            </div>

            <div class="flex flex-col items-center">
                <img class="h-auto w-1/4" src="/images/sample signature.png" alt="almar suites">
                <div class="text-center font-medium mt-2">{{$check->requestor_name}}</div>
                <hr class="w-1/2 mt-2" />
                <div class="text-center mt-2">Requestor's Signature Over Printed Name</div>
            </div>

    </div>

    <br>

</body>

</html>
