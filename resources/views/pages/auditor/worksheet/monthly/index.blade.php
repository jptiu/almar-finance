<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        @if (session()->has('success'))
            <div class="alert alert-success">
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session()->get('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="relative">
            <div class="flex justify-between items-center mb-12 lg:px-4">
                <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold">Worksheet Report</h1>
                <div class="flex items-center gap-4">
                    <!-- Filter Section -->
                    <div class="flex items-center gap-4">
                        <form id="filterForm" method="GET" action="" class="flex items-center gap-4">
                            <!-- Report Type Filter -->
                            <div class="flex flex-col">
                                <select id="reportType" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 min-w-[150px]">
                                    <option value="monthly">Monthly Report</option>
                                    <option value="daily">Daily Report</option>
                                </select>
                            </div>

                            <!-- Monthly Filter -->
                            <div class="flex flex-col" name="month" id="monthFilterContainer">
                                <select id="monthFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 min-w-[180px]">
                                    @for($i = 0; $i < 12; $i++)
                                        <option value="{{ now()->startOfYear()->addMonths($i)->format('Y-m') }}" 
                                            {{ now()->format('Y-m') == now()->startOfYear()->addMonths($i)->format('Y-m') ? 'selected' : '' }}>
                                            {{ now()->startOfYear()->addMonths($i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Daily Filter -->
                            <div class="flex flex-col hidden" id="dateFilterContainer">
                                <input type="date" name="date" id="dateFilter" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                                    value="{{ now()->format('Y-m-d') }}">
                            </div>

                            <!-- Filter Button -->
                            <button id="filterButton" type="submit" 
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span class="ml-2">Filter</span>
                            </button>
                        </form>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <button id="dropdownButton"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center"
                                type="button">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25" />
                                </svg>
                                <span class="sr-only">Select Columns</span>
                            </button>

                            <div id="dropdownMenu"
                                class="absolute right-0 z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
                                    @foreach($columns as $column)
                                        <li>
                                            <div class="flex items-center">
                                                <input type="checkbox"
                                                    class="column-toggle w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                    value="{{ $column->id }}" checked data-column="{{ $loop->index + 2 }}"
                                                    id="checkbox-{{ $column->id }}">
                                                <label for="checkbox-{{ $column->id }}"
                                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $column->name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <button onclick="exportData()"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span class="sr-only">Export to Excel</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <section class="container px-4 mx-auto">
            <div class="flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <h1 class="mt-4 text-2xl text-center font-bold mb-4" id="reportTitle">WORKSHEET MONTH OF
                                {{ now()->format('F Y') }}
                            </h1>
                            <table class="min-w-full bg-white" id="worksheet-table">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border text-sm">Explanation</th>
                                        <th class="py-2 px-4 border text-sm">Capital</th>
                                        @foreach($columns as $column)
                                            <th class="py-2 px-4 border text-sm column-header">{{ $column->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100">
                                        <td class="py-2 px-4 border text-xs"></td>
                                       
                                        <td class="py-2 px-4 border text-xs">
                                             
                                                   
                                                    @foreach($capital as $cap)
                                                       
                                                            {{ number_format($cap->sum('cash_beginning'), 2) }}
                                                       
                                                    @endforeach
                                                   
                                           
                                         
                                        </td>
                                        @foreach($columns as $column)
                                            <td class="py-2 px-4 border text-xs column-total">
                                              
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach($expenses as $expense)
                                        <tr class="hover:bg-gray-100">
                                            
                                            <td class="py-2 px-4 border text-xs">{{ $expense->acc_title }}</td>
                                            <td class="py-2 px-4 border text-xs">
                                                
                                            </td>
                                            @foreach($columns as $column)
                                                <td class="py-2 px-4 border text-xs column-cell">
                                                    @if($expense->category_expense_id == $column->id)
                                                        {{ number_format($expense->amount, 2) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50">
                                        <td class="py-2 px-4 border text-xs font-bold">Total</td>
                                        <td class="py-2 px-4 border text-xs font-bold">
                                            {{ number_format($capital->sum('cash_beginning'), 2) }}
                                        </td>
                                        @foreach($columns as $column)
                                            <td class="py-2 px-4 border text-xs font-bold column-footer">
                                                {{ number_format($expenses->where('category_expense_id', $column->id)->sum('amount'), 2) }}
                                            </td>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const toggles = document.querySelectorAll('.column-toggle');
            const reportType = document.getElementById('reportType');
            const monthFilterContainer = document.getElementById('monthFilterContainer');
            const dateFilterContainer = document.getElementById('dateFilterContainer');
            const monthFilter = document.getElementById('monthFilter');
            const dateFilter = document.getElementById('dateFilter');
            const reportTitle = document.getElementById('reportTitle');
            const filterButton = document.getElementById('filterButton');

          

            // Toggle report type filters
            reportType.addEventListener('change', function() {
                if (this.value === 'monthly') {
                    monthFilterContainer.classList.remove('hidden');
                    dateFilterContainer.classList.add('hidden');
                    reportTitle.textContent = 'WORKSHEET MONTH OF ' + monthFilter.options[monthFilter.selectedIndex].text;
                } else {
                    monthFilterContainer.classList.add('hidden');
                    dateFilterContainer.classList.remove('hidden');
                    reportTitle.textContent = 'WORKSHEET FOR ' + new Date(dateFilter.value).toLocaleDateString('en-US', {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric'
                    });
                }
            });

            monthFilter.addEventListener('change', function() {
                reportTitle.textContent = 'WORKSHEET MONTH OF ' + this.options[this.selectedIndex].text;
                // Add AJAX call here to fetch monthly data
            });

            dateFilter.addEventListener('change', function() {
                reportTitle.textContent = 'WORKSHEET FOR ' + new Date(this.value).toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });
                // Add AJAX call here to fetch daily data
            });

            // Toggle dropdown visibility
            dropdownButton.addEventListener('click', function () {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });

            toggles.forEach(toggle => {
                toggle.addEventListener('change', function () {
                    const columnIndex = this.dataset.column;
                    const headers = document.querySelectorAll('.column-header');
                    const cells = document.querySelectorAll('.column-cell');
                    const totals = document.querySelectorAll('.column-total');
                    const footers = document.querySelectorAll('.column-footer');

                    // Toggle visibility of header
                    headers[columnIndex - 2].style.display = this.checked ? '' : 'none';

                    // Toggle visibility of cells in that column
                    cells.forEach((cell, index) => {
                        if (index % headers.length === columnIndex - 2) {
                            cell.style.display = this.checked ? '' : 'none';
                        }
                    });

                    // Toggle visibility of total in that column
                    totals[columnIndex - 2].style.display = this.checked ? '' : 'none';
                    
                    // Toggle visibility of footer in that column
                    footers[columnIndex - 2].style.display = this.checked ? '' : 'none';
                });
            });
        });
        

        async function exportData() {
            const columns = [];

            const thead = document.querySelector('thead');
            const headers = thead.querySelectorAll('th');
            headers.forEach(header => {
                if (header.style.display !== 'none') {
                    columns.push(header.textContent);
                }
            });

            

            const data = []
            let rowData = []

            const sheetNameMonthly = "WORKSHEET MONTH OF " + monthFilter.options[monthFilter.selectedIndex].text;
            const sheetNameDaily = "WORKSHEET FOR " + new Date(dateFilter.value).toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });

            const isMonthly = reportType.value === 'monthly';

            const tbody = document.querySelector('tbody');
            const rows = tbody.querySelectorAll('tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                    rowData.push(cell.textContent.trim());
                });
                data.push(rowData);
                rowData = [];
            });

          

            const route = "{{ route('worksheet.export') }}";
            try {
                const response = await fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        columns: columns,
                        data: data,
                        sheet_name: isMonthly ? sheetNameMonthly : sheetNameDaily
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = isMonthly ? sheetNameMonthly+ '.csv' : sheetNameDaily + '.csv';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

            } catch (error) {
                
                console.error('Error:', error);
                alert('Failed to export data');
            }
        }
            
    </script>
</x-app-layout>