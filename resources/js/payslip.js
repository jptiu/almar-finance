document.addEventListener('DOMContentLoaded', function() {
    const basicSalary = document.getElementById('basic_salary');
    const overtimePay = document.getElementById('overtime_pay');
    const allowances = document.getElementById('allowances');
    const sssContribution = document.getElementById('sss_contribution');
    const philhealthContribution = document.getElementById('philhealth_contribution');
    const pagibigContribution = document.getElementById('pagibig_contribution');
    const taxDeduction = document.getElementById('tax_deduction');
    const cashAdvance = document.getElementById('cash_advance');
    const otherDeductions = document.getElementById('other_deductions');
    const netPay = document.getElementById('net_pay');

    function calculateNetPay() {
        const totalEarnings = parseFloat(basicSalary.value || 0) + 
                            parseFloat(overtimePay.value || 0) + 
                            parseFloat(allowances.value || 0);

        const totalDeductions = parseFloat(sssContribution.value || 0) +
                              parseFloat(philhealthContribution.value || 0) +
                              parseFloat(pagibigContribution.value || 0) +
                              parseFloat(taxDeduction.value || 0) +
                              parseFloat(cashAdvance.value || 0) +
                              parseFloat(otherDeductions.value || 0);

        const calculatedNetPay = totalEarnings - totalDeductions;
        netPay.value = calculatedNetPay.toFixed(2);
    }

    // Add event listeners to all input fields
    [basicSalary, overtimePay, allowances, sssContribution, 
     philhealthContribution, pagibigContribution, taxDeduction, 
     cashAdvance, otherDeductions].forEach(input => {
        input.addEventListener('input', calculateNetPay);
    });
});
