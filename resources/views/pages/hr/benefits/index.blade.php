<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <!-- Page header -->
        <div class="mb-8">
            <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-slate-800 dark:text-slate-100 font-bold">Employee Benefits</h1>
            </div>
            <div class="mb-6">
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <select id="benefitTypeFilter" class="form-select w-auto" onchange="filterBenefits()">
                            <option value="">All Benefits</option>
                            <option value="identification">Identification Numbers</option>
                            <option value="other">Other Benefits</option>
                        </select>
                        <a href="{{ route('benefits.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                            <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="hidden xs:block ml-2">Add Benefit</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
            <header class="px-5 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="font-semibold text-slate-800 dark:text-slate-100">Benefits List</h2>
            </header>
            <div class="p-3">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <!-- Table head -->
                        <thead class="text-xs font-semibold uppercase text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-700">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Employee</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Benefit Type</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Number/Amount</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Effective Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Expiration Date</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Status</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Actions</div>
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody class="text-sm divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($benefits as $benefit)
                            <tr class="benefit-row" data-benefit-type="{{ $benefit->benefit_type }}">
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $benefit->employee->name }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                                               {{ in_array($benefit->benefit_type, ['sss', 'philhealth', 'pagibig']) 
                                                      ? 'bg-indigo-100 text-indigo-800' 
                                                      : 'bg-emerald-100 text-emerald-800' }}">
                                            {{ ucfirst($benefit->benefit_type) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        @if(in_array($benefit->benefit_type, ['sss', 'philhealth', 'pagibig']))
                                            <span class="font-mono">{{ $benefit->amount }}</span>
                                        @else
                                            ₱{{ number_format($benefit->amount, 2) }}
                                        @endif
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $benefit->effective_date->format('M d, Y') }}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        {{ $benefit->expiration_date ? $benefit->expiration_date->format('M d, Y') : 'N/A' }}
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                               bg-{{ $benefit->status === 'active' ? 'green' : ($benefit->status === 'expired' ? 'red' : 'yellow') }}-100 
                                               text-{{ $benefit->status === 'active' ? 'green' : ($benefit->status === 'expired' ? 'red' : 'yellow') }}-800">
                                            {{ ucfirst($benefit->status) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('benefits.edit', $benefit) }}" class="text-blue-500 hover:text-blue-600">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('benefits.print', $benefit) }}" class="text-green-500 hover:text-green-600">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                                                    <path d="M2.5 8a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-10ZM3 1a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2H3ZM11 5.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function filterBenefits() {
    const filterValue = document.getElementById('benefitTypeFilter').value;
    const rows = document.querySelectorAll('.benefit-row');
    
    rows.forEach(row => {
        if (filterValue === "identification") {
            const isIdentification = ['sss', 'philhealth', 'pagibig'].includes(row.dataset.benefitType);
            row.style.display = isIdentification ? '' : 'none';
        } else if (filterValue === "other") {
            const isOther = !['sss', 'philhealth', 'pagibig'].includes(row.dataset.benefitType);
            row.style.display = isOther ? '' : 'none';
        } else {
            row.style.display = '';
        }
    });
}

// Add pagination links
const pagination = document.createElement('div');
pagination.className = 'mt-4 flex justify-center';
pagination.innerHTML = `
    <div class="flex items-center space-x-2">
        <a href="{{ $benefits->previousPageUrl() }}" 
           class="btn bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
        </a>
        <span class="text-slate-500 dark:text-slate-400">
            Page {{ $benefits->currentPage() }} of {{ $benefits->lastPage() }}
        </span>
        <a href="{{ $benefits->nextPageUrl() }}" 
           class="btn bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-500 dark:text-slate-400">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </a>
    </div>
`;

document.querySelector('.bg-white').appendChild(pagination);
</script>
