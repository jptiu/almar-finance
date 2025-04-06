<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Daily Time Record</h1>
                <div class="flex space-x-3">
                    <form action="{{ route('dtr.index') }}" method="GET" class="flex space-x-3">
                        <select name="employee_id" class="rounded-md border-gray-300">
                            <option value="">All Employees</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" @selected(request('employee_id') == $employee->id)>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <input type="month" name="month" value="{{ $month }}" 
                            class="rounded-md border-gray-300">
                            
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                            Filter
                        </button>
                    </form>
                    
                    @if(request('employee_id'))
                        <form action="{{ route('dtr.pdf') }}" method="GET" target="_blank">
                            <input type="hidden" name="month" value="{{ $month }}">
                            <input type="hidden" name="employee_id" value="{{ request('employee_id') }}">
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">
                                Generate PDF
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="mt-8">
                @foreach($records as $employeeId => $employeeRecords)
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $employeeRecords->first()->employee->name }}
                            </h3>
                        </div>
                        
                        <div class="border-t border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Clock In
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Clock Out
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hours
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Late (mins)
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Undertime (mins)
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Deductions
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Net Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($employeeRecords as $record)
                                        <tr class="{{ $record->is_sunday ? 'bg-red-50' : ($record->is_branch_meeting ? 'bg-blue-50' : '') }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $record->attendance_date->format('M d, Y') }}
                                                @if($record->is_sunday)
                                                    <span class="text-red-600 ml-1">(Sunday)</span>
                                                @elseif($record->is_branch_meeting)
                                                    <span class="text-blue-600 ml-1">(Branch Meeting)</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $record->clock_in_formatted }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $record->clock_out_formatted }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ number_format($record->working_hours, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $record->late_minutes }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $record->undertime_minutes }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $record->status === 'present' ? 'bg-green-100 text-green-800' : 
                                                       ($record->status === 'late' ? 'bg-yellow-100 text-yellow-800' : 
                                                       'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($record->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                ₱{{ number_format($record->deductions, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                ₱{{ number_format($record->net_amount, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    <!-- Summary Row -->
                                    <tr class="bg-gray-50 font-medium">
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Total
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $employeeRecords->sum('late_minutes') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $employeeRecords->sum('undertime_minutes') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ₱{{ number_format($employeeRecords->sum('deductions'), 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ₱{{ number_format($employeeRecords->sum('net_amount'), 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
