document.addEventListener('DOMContentLoaded', function() {
    const employeeSelect = document.getElementById('employee_id');
    const overtimeHoursInput = document.getElementById('overtime_hours');
    const payPeriodStart = document.getElementById('pay_period_start');
    const payPeriodEnd = document.getElementById('pay_period_end');

    // Function to update overtime hours
    function updateOvertimeHours() {
        const employeeId = employeeSelect.value;
        const startDate = payPeriodStart.value;
        const endDate = payPeriodEnd.value;

        if (!employeeId || !startDate || !endDate) {
            overtimeHoursInput.value = '';
            return;
        }

        // Make AJAX request to get overtime hours
        fetch(`/payslips/get-overtime-hours?employee_id=${employeeId}&start_date=${startDate}&end_date=${endDate}`)
            .then(response => response.json())
            .then(data => {
                overtimeHoursInput.value = data.total_hours;
            })
            .catch(error => {
                console.error('Error fetching overtime hours:', error);
                overtimeHoursInput.value = '';
            });
    }

    // Add event listeners
    employeeSelect.addEventListener('change', updateOvertimeHours);
    payPeriodStart.addEventListener('change', updateOvertimeHours);
    payPeriodEnd.addEventListener('change', updateOvertimeHours);
});
