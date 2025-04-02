<?php

use App\Http\Controllers\AuditorController;
use App\Http\Controllers\BMController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BreakdownController;
use App\Http\Controllers\CategoryExpenseController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\CityTownController;
use App\Http\Controllers\CLDController;
use App\Http\Controllers\CLMController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\ComputeCOHController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\EditRequestController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanSummaryController;
use App\Http\Controllers\LOController;
use App\Http\Controllers\RebateController;
use App\Http\Controllers\RenewalRequestController;
use App\Http\Controllers\SocialLoanRequestController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DenominationController;
use App\Http\Controllers\UserController;
use App\Models\Employee;
use App\Models\RenewalRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\BranchInfoController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SavingsController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SupplyRequestController;

Route::get('/storage/{path}', function ($path) {
    $file = Storage::disk('public')->path($path);

    if (!file_exists($file)) {
        abort(404);
    }

    return response()->file($file);
})->where('path', '.*');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Loan Summary Routes
    // require __DIR__ . '/loan-summary.php';
    Route::get('/loan-summary', [LoanSummaryController::class, 'index'])->name('loan-summary.index');
    Route::post('/loan-summary/export', [LoanSummaryController::class, 'export'])->name('loan-summary.export');
    Route::get('/loan-summary/print', [LoanSummaryController::class, 'print'])->name('loan-summary.print');

    // Barangay
    // Route::resource('barangay', App\Http\Controllers\BarangayController::class);
    Route::get('barangay', [BarangayController::class, 'index'])->name('barangay.index');
    Route::get('barangay-add', [BarangayController::class, 'add'])->name('barangay.add');
    Route::post('barangay/store', [BarangayController::class, 'store'])->name('barangay.store');
    Route::post('barangay/update/{id}', [BarangayController::class, 'update'])->name('barangay.update');
    Route::get('barangay/show/{id}', [BarangayController::class, 'show'])->name('barangay.show');
    Route::delete('worksheet-monthly-report/destroy/{id}', [BarangayController::class, 'destroy'])->name('barangay.destroy');
    Route::post('barangay/import', [BarangayController::class, 'importCSV'])->name('barangay.importcsv');

    // Customer
    // Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::get('customer-add', [CustomerController::class, 'add'])->name('customer.add');
    Route::get('customer/print/{id}', [CustomerController::class, 'printCustomer'])->name('printCustomer.index');
    Route::get('customer/show/printsavings/{id}', [CustomerController::class, 'printcustomerSavings'])->name('printcustomerSavings.index');
    Route::get('customer/show/printloan/{id}', [CustomerController::class, 'printcustomerLoan'])->name('printcustomerLoan.index');
    Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::get('customer-daily', [CustomerController::class, 'daily'])->name('customer.daily');
    Route::get('customer-month', [CustomerController::class, 'month'])->name('customer.month');
    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('customer/show/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::delete('customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('import', [CustomerController::class, 'importPage'])->name('customer.import');
    Route::post('importcsv', [CustomerController::class, 'importCSV'])->name('customer.importcsv');

    // Customer Type
    // Route::resource('customer-type', App\Http\Controllers\CustomerTypeController::class);
    Route::get('customer-type', [CustomerTypeController::class, 'index'])->name('customerType.index');
    Route::get('customer-type-add', [CustomerTypeController::class, 'add'])->name('customerType.add');
    Route::post('customer-type/store', [CustomerTypeController::class, 'store'])->name('customerType.store');
    Route::post('customer-type/update/{id}', [CustomerTypeController::class, 'update'])->name('customerType.update');
    Route::get('customer-type/show/{id}', [CustomerTypeController::class, 'show'])->name('customerType.show');
    Route::delete('customer-type/destroy/{id}', [CustomerTypeController::class, 'destroy'])->name('customerType.destroy');
    Route::post('customer-type/import', [CustomerTypeController::class, 'importCSV'])->name('customerType.importcsv');

    // City/ or Town
    // Route::resource('city', App\Http\Controllers\CityTownController::class);
    Route::get('city', [CityTownController::class, 'index'])->name('city.index');
    Route::get('city-add', [CityTownController::class, 'add'])->name('city.add');
    Route::post('city/store', [CityTownController::class, 'store'])->name('city.store');
    Route::post('city/update/{id}', [CityTownController::class, 'update'])->name('city.update');
    Route::get('city/show/{id}', [CityTownController::class, 'show'])->name('city.show');
    Route::delete('city/destroy/{id}', [CityTownController::class, 'destroy'])->name('city.destroy');
    Route::post('city/import', [CityTownController::class, 'importCSV'])->name('city.importcsv');

    // Loan
    Route::get('loan', [LoanController::class, 'index'])->name('loan.index');
    Route::get('loan/create', [LoanController::class, 'create'])->name('loan.create');
    Route::get('loan/show/{id}', [LoanController::class, 'show'])->name('loan.show');
    Route::get('loan/edit/{id}', [LoanController::class, 'edit'])->name('loan.edit');
    Route::post('loan/store', [LoanController::class, 'store'])->name('loan.store');
    Route::post('loan/allow-grace-period', [LoanController::class, 'gracePeriod'])->name('loan.gracePeriod');
    Route::post('loan/update/{id}', [LoanController::class, 'update'])->name('loan.update');
    Route::delete('loan/destroy/{id}', [LoanController::class, 'destroy'])->name('loan.destroy');
    Route::post('loan/import', [LoanController::class, 'importCSV'])->name('loan.importcsv');
    Route::post('loan/import-details', [LoanController::class, 'importCSVDetails'])->name('loan.importcsvdetails');
    Route::post('loan/approve/{id}', [LoanController::class, 'approve'])->name('loan.approve');
    Route::post('loan/decline/{id}', [LoanController::class, 'decline'])->name('loan.decline');
    Route::get('loan/print/{id}', [LoanController::class, 'printGrantLoan'])->name('printGrantLoan.index');
    Route::post('/update-due-date/{detail}', [LoanController::class, 'updateDueDate'])->name('loan.duedateupdate');
    Route::post('loan/request/renew/{id}', [RenewalRequestController::class, 'renew'])->name('loan.request');
    Route::get('request-renewals', [RenewalRequestController::class, 'index'])->name('request-renewals.index');
    Route::get('request-renewals/approve/{id}', [RenewalRequestController::class, 'renewApprove'])->name('request-renewals.approve');
    Route::get('request-renewals/decline/{id}', [RenewalRequestController::class, 'renewDecline'])->name('request-renewals.decline');
    Route::get('/loan/customer-suggestions', [LoanController::class, 'getCustomerSuggestions'])->name('loan.customer.suggestions');

    // Edit Requests
    Route::post('loan/{loanId}/request-edit', [EditRequestController::class, 'store'])->name('loan.request-edit.store');
    Route::get('loan/edit-requests', [EditRequestController::class, 'index'])->name('loan.edit-requests.index');
    Route::post('loan/edit-requests/{id}/approve', [EditRequestController::class, 'approve'])->name('loan.edit-requests.approve');
    Route::post('loan/edit-requests/{id}/decline', [EditRequestController::class, 'decline'])->name('loan.edit-requests.decline');

    // Collection
    Route::get('collection', [CollectionController::class, 'index'])->name('collection.index');
    Route::get('collection/create', [CollectionController::class, 'create'])->name('collection.create');
    Route::get('collection/show/{id}', [CollectionController::class, 'show'])->name('collection.show');
    Route::get('collection/edit/{id}', [CollectionController::class, 'edit'])->name('collection.edit');
    Route::post('collection/store', [CollectionController::class, 'store'])->name('collection.store');
    Route::post('collection/update/{id}', [CollectionController::class, 'update'])->name('collection.update');
    Route::delete('collection/destroy/{id}', [CollectionController::class, 'destroy'])->name('collection.destroy');

    // Rebates
    Route::get('rebates', [RebateController::class, 'index'])->name('rebates.index');
    Route::get('rebates/approve/{id}', [RebateController::class, 'approve'])->name('rebates.approve');
    Route::get('rebates/decline/{id}', [RebateController::class, 'decline'])->name('rebates.decline');

    // Breakdown
    Route::get('breakdown', [BreakdownController::class, 'index'])->name('breakdown.index');
    Route::get('breakdown/create', [BreakdownController::class, 'create'])->name('breakdown.create');

    Route::post('breakdown/store', [BreakdownController::class, 'store'])->name('breakdown.store');
    Route::post('breakdown/update/{id}', [BreakdownController::class, 'update'])->name('breakdown.update');
    Route::delete('breakdown/destroy/{id}', [BreakdownController::class, 'destroy'])->name('breakdown.destroy');
    Route::post('breakdown/import', [BreakdownController::class, 'importCSV'])->name('breakdown.importcsv');
    Route::post('breakdown/cash-bills/import', [BreakdownController::class, 'importCSVCashbills'])->name('breakdown.importcsv2');
    Route::get('breakdowns/{ref}', [BreakdownController::class, 'getBreakdownByRef']);
    Route::post('/breakdowns/cash-bill/store', [BreakdownController::class, 'storeBill'])->name('breakdown.storeBill');

    // Expenses
    Route::get('expenses', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::get('expenses/show/{id}', [ExpensesController::class, 'show'])->name('expenses.show');
    Route::get('expenses/edit/{id}', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::post('expenses/store', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::post('expenses/update/{id}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('expenses/destroy/{id}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');
    Route::get('/get-account-data/{acctNo}', [ExpensesController::class, 'getAccountData']);
    Route::post('expenses/import', [ExpensesController::class, 'importCSV'])->name('expenses.importcsv');

    // Compute Cash on Hand
    Route::get('compute', [ComputeCOHController::class, 'index'])->name('compute.index');
    Route::post('compute/store', [ComputeCOHController::class, 'store'])->name('compute.store');
    Route::get('compute/create', [ComputeCOHController::class, 'create'])->name('compute.create');
    Route::get('compute/show', [ComputeCOHController::class, 'show'])->name('compute.show');
    Route::get('compute/edit/{id}', [ComputeCOHController::class, 'edit'])->name('compute.edit');
    Route::post('compute/update/{id}', [ComputeCOHController::class, 'update'])->name('compute.update');
    Route::get('compute/destroy/{id}', [ComputeCOHController::class, 'destroy'])->name('compute.destroy');

    // Daily
    Route::get('daily', [CLDController::class, 'index'])->name('daily.index');
    Route::get('daily/store', [CLDController::class, 'store'])->name('daily.store');
    Route::get('daily/update/{id}', [CLDController::class, 'update'])->name('daily.update');
    Route::get('daily/destroy/{id}', [CLDController::class, 'destroy'])->name('daily.destroy');

    // Monthly
    Route::get('monthly', [CLMController::class, 'index'])->name('monthly.index');
    Route::get('monthly/store', [CLMController::class, 'store'])->name('monthly.store');
    Route::get('monthly/update/{id}', [CLMController::class, 'update'])->name('monthly.update');
    Route::get('monthly/destroy/{id}', [CLMController::class, 'destroy'])->name('monthly.destroy');
    Route::get('monthly/print/loan', [CLMController::class, 'printLoan'])->name('printLoan.index');
    Route::get('monthly/print/statement/{id}', [CLMController::class, 'printStatement'])->name('printStatement.index');


    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');
    Route::get('/ecommerce/customers', [CustomerController::class, 'index'])->name('customers');

    // HR
    Route::get('hr', [HRController::class, 'index'])->name('hr.index');
    Route::get('loanhistory', [HRController::class, 'cloanHistory'])->name('loanhistory.index');
    Route::get('renewals', [HRController::class, 'loanRenewals'])->name('renewals.index');
    Route::get('audit', [HRController::class, 'auditScheduling'])->name('audit.index');
    Route::get('loan-approvals', [HRController::class, 'pendingLoanApprovals'])->name('loan-approvals.index');
    Route::get('evaluations', [HRController::class, 'employeeEvaluation'])->name('evaluations.index');
    Route::get('monthlyrep', [HRController::class, 'monthlyReport'])->name('monthlyrep.index');
    Route::get('attendance', [HRController::class, 'biometricsAttendance'])->name('attendance.index');
    Route::get('announce', [HRController::class, 'announcementHr'])->name('announce.index');
    Route::get('announce/add', [HRController::class, 'addAnnouncement'])->name('announce.add');
    Route::post('announce/store', [HRController::class, 'storeAnnouncement'])->name('announce.store');
    Route::get('announce/show/{id}', [HRController::class, 'showAnnouncement'])->name('announce.show');
    Route::post('announce/update/{id}', [HRController::class, 'updateAnnouncement'])->name('announce.update');
    Route::delete('announce/destroy/{id}', [HRController::class, 'destroyAnnouncement'])->name('announce.destroy');
    Route::get('dailyWorkRequest', [HRController::class, 'dailyWorkRequest'])->name('dailyWorkRequest.index');
    Route::get('dailyWorkRequest/print/{id}', [HRController::class, 'dailyWorkRequestPrint'])->name('dailyWorkRequestPrint.index');
    Route::get('dailyWorkRequest/approve/{id}', [HRController::class, 'dailyWorkRequestApprove'])->name('dailyWorkRequestApprove.approve');
    Route::get('dailyWorkRequest/reject/{id}', [HRController::class, 'dailyWorkRequestReject'])->name('dailyWorkRequestReject.reject');

    // BranchInfo
    Route::get('branchinfo', [BranchInfoController::class, 'branchinfo'])->name('branchinfo.index');
    Route::get('branchinfo/add', [BranchInfoController::class, 'branchinfoAdd'])->name('branchinfo.add');
    Route::post('branchinfo/store', [BranchInfoController::class, 'branchinfoStore'])->name('branchinfo.store');
    Route::get('announce/show/{id}', [BranchInfoController::class, 'showAnnouncement'])->name('announce.show');
    Route::post('announce/update/{id}', [BranchInfoController::class, 'updateAnnouncement'])->name('announce.update');
    Route::delete('announce/destroy/{id}', [BranchInfoController::class, 'destroyAnnouncement'])->name('announce.destroy');

    // Pending Loan Approval
    Route::get('loanapprovals-approved', [HRController::class, 'approvedLoans'])->name('approved.index');
    Route::get('loanapprovals-rejected', [HRController::class, 'rejectedLoans'])->name('rejected.index');
    Route::get('loanapprovals-pending', [HRController::class, 'pendingLoans'])->name('pending.index');


    // Employee
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee-add', [EmployeeController::class, 'add'])->name('employee.add');
    Route::post('employee/update/{id}', [EmployeeController::class, 'employeeupdate'])->name('employee.update');
    Route::get('employee/show/{id}', [EmployeeController::class, 'employeeshow'])->name('employee.show');
    Route::get('new-hire', [EmployeeController::class, 'newhire'])->name('newhire.index');
    Route::get('new-hire/add', [EmployeeController::class, 'newhireadd'])->name('newhire.add');
    Route::get('bm-probation', [EmployeeController::class, 'bmprobation'])->name('bmprobation.index');
    Route::post('bm-probation/update/{id}', [EmployeeController::class, 'bmp_update'])->name('bmprobation.update');
    Route::get('bm-probation/show/{id}', [EmployeeController::class, 'bmp_show'])->name('bmprobation.show');
    Route::get('resignation', [EmployeeController::class, 'resignation'])->name('resignation.index');
    Route::get('resignation-add', [EmployeeController::class, 'resigadd'])->name('resignation.add');
    Route::post('resignation/store', [EmployeeController::class, 'resigstore'])->name('resignation.store');
    Route::post('resignation/update/{id}', [EmployeeController::class, 'resigupdate'])->name('resignation.update');
    Route::get('resignation/show/{id}', [EmployeeController::class, 'resigshow'])->name('resignation.show');

    // Auditor
    Route::get('auditor', [AuditorController::class, 'index'])->name('auditor.index');
    Route::get('ba-monthly-report', [AuditorController::class, 'baMonth'])->name('bamonth.index');
    Route::get('ba-monthly-report-export', [AuditorController::class, 'baMonthExport'])->name('bamonth.export');
    Route::get('ba-daily-report', [AuditorController::class, 'baDaily'])->name('badaily.index');
    Route::get('ba-daily-report-export', [AuditorController::class, 'baDailyExport'])->name('badaily.export');
    Route::get('ba-collection-report', [AuditorController::class, 'baCollection'])->name('bacollection.index');
    Route::get('ba-collection-report-export', [AuditorController::class, 'baCollectionExport'])->name('bacollection.export');
    Route::get('worksheet-monthly-report', [AuditorController::class, 'worksheetMonth'])->name('worksheet.index');
    Route::post('worksheet-monthly-report-export', [AuditorController::class, 'worksheetExport'])->name('worksheet.export');
    // Branch
    Route::get('branch', [BMController::class, 'index'])->name('branch.index');
    Route::get('csor', [BMController::class, 'csor'])->name('csor.index');
    Route::get('csor/print', [BMController::class, 'csorPrint'])->name('print.index');
    Route::get('performance-record', [BMController::class, 'performanceRecord'])->name('performance.index');

    // Check
    Route::get('requestcheck', [CheckController::class, 'index'])->name('requestcheck.index');
    Route::post('requestcheck/store', [CheckController::class, 'store'])->name('requestcheck.store');
    Route::get('requestcheck/approve/{id}', [CheckController::class, 'approve'])->name('requestcheck.approve');
    Route::get('requestcheck/reject/{id}', [CheckController::class, 'reject'])->name('requestcheck.reject');
    Route::get('requestcheck/print/{id}', [CheckController::class, 'printCheck'])->name('printCheck.index');

    // Collector
    Route::get('collector', [CollectorController::class, 'index'])->name('collector.index');
    Route::get('collector/leave', [CollectorController::class, 'leave'])->name('collector.leave');
    Route::get('collector/cashadvance', [CollectorController::class, 'cashadvance'])->name('collector.cashadvance');
    Route::get('collector/undertime', [CollectorController::class, 'undertime'])->name('collector.undertime');
    Route::get('collector/clearance', [CollectorController::class, 'clearance'])->name('collector.clearance');
    Route::get('collector/id', [CollectorController::class, 'id'])->name('collector.id');
    Route::get('collector/cashbond', [CollectorController::class, 'cashbond'])->name('collector.cashbond');
    Route::get('collector/profile', [CollectorController::class, 'profile'])->name('collector.profile');

    // Loan Officer
    Route::get('loanofficer', [LOController::class, 'index'])->name('loanofficer.index');
    Route::get('addloan', [LOController::class, 'addLoan'])->name('addLoan.index');
    Route::get('loanofficer/autopayment', [LOController::class, 'autoPaymentreq'])->name('autoPaymentreq.index');
    Route::get('loanofficer/dailyworkorder', [LOController::class, 'dailyWorkorder'])->name('dailyWorkorder.index');


    // Employee Evaluation
    Route::get('branch/employee-evaluation', [BMController::class, 'employeeEvaluation'])->name('employeeEvaluation.index');


    // Bad Account
    Route::get('branch/bad-account', [BMController::class, 'badAccount'])->name('badAccount.index');

    // Regular Account
    Route::get('branch/regular-account', [BMController::class, 'regAccount'])->name('regAccount.index');

    // Todays Payer
    Route::get('branch/todays-payer', [BMController::class, 'todaysPayer'])->name('todaysPayer.index');

    // Late Payer
    Route::get('branch/late-payer', [BMController::class, 'latePayer'])->name('latePayer.index');

    // Payment History
    Route::get('branch/payhistory', [BMController::class, 'paymentHistory'])->name('paymentHistory.index');

    //  Attendance
    Route::get('attendancebm', [BMController::class, 'biometricsAttendance'])->name('biometricsAttendance.index');

    // Pending Loan Approval
    Route::get('branch/pending-loan-approval', [BMController::class, 'pendingLoandApproval'])->name('pendingLoandApproval.index');

    // Approved Loans
    Route::get('branch/approved-loan', [BMController::class, 'approvedLoan'])->name('approvedLoan.index');

    // Rejected Loans
    Route::get('branch/rejected-loan', [BMController::class, 'rejectedLoan'])->name('rejectedLoan.index');

    // Loan Renewal
    Route::get('branch/loan-renewal', [BMController::class, 'loanRenewal'])->name('loanRenewal.index');

    //OverdueAccounts
    Route::get('overdueacc', [BMController::class, 'overdueAcc'])->name('overdueacc.index');

    //LoanInformation
    Route::get('loaninfo', [BMController::class, 'loanInformation'])->name('loanInformation.index');

    //RequestForm
    Route::get('requestform/leave', [BMController::class, 'leaveRequest'])->name('leaveRequest.index');
    Route::get('requestform/undertime', [BMController::class, 'undertimeRequest'])->name('undertimeRequest.index');
    Route::get('requestform/id', [BMController::class, 'idRequest'])->name('idRequest.index');
    Route::get('requestform/clearance', [BMController::class, 'clearanceRequest'])->name('clearanceRequest.index');
    Route::get('requestform/cashadvance', [BMController::class, 'cashadvanceRequest'])->name('cashadvanceRequest.index');
    Route::get('requestform/cashbond', [BMController::class, 'cashBond'])->name('cashBond.index');
    Route::get('requestform/cashbond/print', [BMController::class, 'cashBondPrint'])->name('cashBondPrint.index');

    //Daily Work Order Request
    Route::get('requestform/dailyworkorder', [BMController::class, 'dailyWorklist'])->name('dailyworkorder.index');
    Route::get('requestform/dailyworkorder/add', [BMController::class, 'dailyWorkAdd'])->name('dailyworkorder.add');
    Route::post('requestform/dailyworkorder/store', [BMController::class, 'dailyWorkStore'])->name('dailyworkorder.store');

    //Print Statement
    Route::get('branch/print/statement/{id}', [BMController::class, 'printStatement'])->name('printStatementBranch.index');

    //Automated Payment
    Route::get('reminder', [BMController::class, 'reminderPay'])->name('reminderPay.index');

    //Savings
    // Route::get('savings', [SavingsController::class, 'index'])->name('savings.index');
    // Route::get('savings/create', [SavingsController::class, 'create'])->name('savings.create');
    // Route::post('savings/store', [SavingsController::class, 'store'])->name('savings.store');
    // Route::delete('savings/destroy/{id}', [SavingsController::class, 'destroy'])->name('savings.destroy');

    // Deposit
    Route::get('savingscustomer/depositentry', [SavingsController::class, 'indexDeposit'])->name('depositentry.index');
    Route::get('savingscustomer/createDeposit', [SavingsController::class, 'createDeposit'])->name('depositentry.createDeposit');
    Route::post('savingscustomer/deposit/store', [SavingsController::class, 'storeDeposit'])->name('depositentry.storeDeposit');
    Route::get('savingscustomer/depositentry/print/{id}', [SavingsController::class, 'printDeposit'])->name('printDeposit.print');

    //Savings
    Route::get('savingscustomer/withdrawalentry', [SavingsController::class, 'indexWithdrawal'])->name('savingscustomer.index');
    Route::get('savingscustomer/createWithdrawal', [SavingsController::class, 'createWithdrawal'])->name('withdrawalentry.createWithdrawal');
    Route::post('savingscustomer/withdrawal/store', [SavingsController::class, 'storeWithdrawal'])->name('withdrawalentry.storeWithdrawal');
    Route::get('savingscustomer/withdrawalentry/print/{id}', [SavingsController::class, 'printWithdrawal'])->name('printWithdrawal.print');


    // Payroll
    Route::get('payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('payroll-add', [PayrollController::class, 'create'])->name('payroll.add');
    Route::post('payroll/store', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('payroll/payslip', [PayrollController::class, 'payrollPrint'])->name('payroll.print');
    Route::get('payroll/add', [BMController::class, 'payRoll'])->name('paroll.index');
    // Route::post('payroll/update/{id}', [PayrollController::class, 'resigupdate'])->name('payroll.update');
    // Route::get('payroll/show/{id}', [PayrollController::class, 'resigshow'])->name('payroll.show');

    // Superadmin
    Route::get('superadmin/monthlyreport', [SuperAdminController::class, 'monthlyReport'])->name('monthlyReport.index');
    Route::get('superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('useracc', [SuperAdminController::class, 'userAccounts'])->name('useracc.index');
    Route::get('deleted', [SuperAdminController::class, 'deactivateAccounts'])->name('deleted.index');
    Route::get('update', [SuperAdminController::class, 'updateAccounts'])->name('update.index');
    Route::get('create', [SuperAdminController::class, 'createAccounts'])->name('create.index');
    Route::get('customerprof', [SuperAdminController::class, 'customerProf'])->name('customerprof.index');
    Route::get('customerprof-add', [SuperAdminController::class, 'add'])->name('customerprof.add');


    //Chart
    Route::get('chart', [ChartController::class, 'index'])->name('chart.index');
    Route::get('chart/edit/{id}', [ChartController::class, 'edit'])->name('chart.edit');
    Route::post('chart/store', [ChartController::class, 'store'])->name('chart.store');
    Route::get('chart/create', [ChartController::class, 'create'])->name('chart.create');
    Route::post('chart/update/{id}', [ChartController::class, 'update'])->name('chart.update');
    Route::get('chart/show/{id}', [ChartController::class, 'show'])->name('chart.show');
    Route::delete('chart/destroy/{id}', [ChartController::class, 'destroy'])->name('chart.destroy');
    Route::post('chart/import', [ChartController::class, 'importCSV'])->name('chart.importcsv');

    //Denomination
    Route::get('denomination', [DenominationController::class, 'index'])->name('denomination.index');
    Route::post('denomination/store', [DenominationController::class, 'store'])->name('denomination.store');
    Route::get('denomination/create', [DenominationController::class, 'create'])->name('denomination.create');
    Route::post('denomination/update/{id}', [DenominationController::class, 'update'])->name('denomination.update');
    Route::get('denomination/show/{id}', [DenominationController::class, 'show'])->name('denomination.show');
    Route::delete('denomination/destroy/{id}', [DenominationController::class, 'destroy'])->name('denomination.destroy');
    Route::post('denomination/import', [DenominationController::class, 'importCSV'])->name('denomination.importcsv');

    Route::resource('branches', BranchController::class);

    // Assign user to a branch
    Route::post('branches/{branch}/assign-user', [BranchController::class, 'assignUser'])->name('branches.assignUser');

    Route::post('/broadcasting/auth', function () {
        return Broadcast::auth(request());
    });

    Route::post('user/store', [UserController::class, 'store'])->name('user.store');

    //export data to csv
    Route::get('/exportsavings-csv', [SavingsController::class, 'exportsavingsData'])->name('savings.export');
    Route::get('/exportwithdrawal-csv', [SavingsController::class, 'exportwithdrawalData'])->name('withdraw.export');
    Route::get('/exportloanHistory/{id}-csv', [LoanController::class, 'exportloanHistory'])->name('loanhistory.export');

    Route::get('/exportcustomerSavings/{id}-csv', [CustomerController::class, 'exportcustomerSavings'])->name('customersavings.export');

    Route::get('/exportTransaction-csv', [LoanController::class, 'exportTransaction'])->name('loan.export');

    // Supply Request Routes
    Route::get('/supply-request', [SupplyRequestController::class, 'index'])->name('supply-request.index');
    Route::get('/supply-request/create', [SupplyRequestController::class, 'create'])->name('supply-request.create');
    Route::post('/supply-request', [SupplyRequestController::class, 'store'])->name('supply-request.store');
    Route::post('/supply-request/{supplyRequest}/approve', [SupplyRequestController::class, 'approve'])->name('supply-request.approve');
    Route::post('/supply-request/{supplyRequest}/reject', [SupplyRequestController::class, 'reject'])->name('supply-request.reject');


    Route::post('category-expenses/store', [CategoryExpenseController::class, 'store'])->name('category-expenses.store');
    Route::post('category-expenses/update/{id}', [CategoryExpenseController::class, 'update'])->name('category-expenses.update');
    Route::delete('category-expenses/destroy/{id}', [CategoryExpenseController::class, 'destroy'])->name('category-expenses.destroy');

    // Social Loan Requests
    Route::prefix('social-loan-requests')->group(function () {
        Route::get('/', [SocialLoanRequestController::class, 'index'])->name('social_loan_requests.index');
        Route::get('create', [SocialLoanRequestController::class, 'create'])->name('social_loan_requests.create');
        Route::post('/', [SocialLoanRequestController::class, 'store'])->name('social_loan_requests.store');
        Route::post('{socialLoanRequest}/approve', [SocialLoanRequestController::class, 'approve'])->name('social_loan_requests.approve');
        Route::post('{socialLoanRequest}/reject', [SocialLoanRequestController::class, 'reject'])->name('social_loan_requests.reject');
    });
});
