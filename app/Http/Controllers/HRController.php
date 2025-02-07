<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\DailyWorkOrder;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Employee::get();
        $announcements = Announcement::where('status', 1)->get(); // Fetch only active announcements
        $activeCount = $announcements->count(); // Count active announcements
        $currentDate = Carbon::now()->format('F d, Y'); // Get the current date

        $logs = ActivityLog::orderByDesc('id')->paginate(20);

        return view('pages.hr.index', compact('lists', 'announcements', 'activeCount', 'currentDate', 'logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * The function `loanRenewals` returns a view for the HR renewals index page in a PHP application.
     *
     * @return A view named 'index' located in the 'renewals' folder within the 'hr' folder in the
     * 'pages' directory is being returned.
     */
    public function loanRenewals(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $lists = Loan::where('transaction_type', 'RENEW')->paginate(10);
        if ($request->date_from) {
            $lists = Loan::with(['customer'])
                ->whereBetween('updated_at', [$request->date_from, $request->date_to])
                ->where('branch_id', $branch)->paginate(10);
        } 

        return view('pages.hr.renewals.index', compact('lists'));

    }

    public function auditScheduling()
    {
        return view('pages.hr.audit.index');
    }

    public function pendingLoanApprovals()
    {
        return view('pages.hr.loanapprovals.index');
    }

    public function employeeEvaluation()
    {
        return view('pages.hr.evaluations.index');
    }

    public function monthlyReport()
    {
        return view('pages.hr.monthlyrep.index');
    }

    public function payRoll()
    {
        return view('pages.hr.payroll.index');
    }

    public function biometricsAttendance()
    {
        return view('pages.hr.attendance.index');
    }

    public function approvedLoans()
    {
        $loans = Loan::where('principal_amount', '>', '50000')
            ->where('status', '=', 'FULPD')->paginate(10);

        return view('pages.hr.loanapprovals.approved.index', compact('loans'));
    }

    public function approvedLoansAPI()
    {
        $loans = Loan::with('customer')->where('principal_amount', '>', '50000')
            ->where('status', '!=', 'CNCLD')->paginate(10);

        return response()->json($loans, 200);
    }

    public function rejectedLoans()
    {
        $branch = auth()->user()->branch_id;
        $loans = Loan::where('principal_amount', '>', '50000')
            ->where('branch_id', $branch)
            ->where('status', '=', 'CNCLD')->paginate(10);

        return view('pages.hr.loanapprovals.rejected.index', compact('loans'));
    }

    public function rejectedLoansAPI()
    {
        $loans = Loan::with('customer')->where('principal_amount', '>', '50000')
            ->where('status', '=', 'CNCLD')->paginate(10);

        return response()->json($loans, 200);
    }

    public function cloanHistory(Request $request)
    {
        $branch = auth()->user()->branch_id;
        if($request->filter){
            $lists = Loan::with('details')
            ->where('transaction_type', 'LIKE', '%' . $request->filter[0] . '%')
            ->where('branch_id', $branch)->paginate(20);
        }else{
            $lists = Loan::with('details')->where('branch_id', $branch)->paginate(20);
        }
        if ($request->date_from) {
            $lists = Loan::with(['customer'])
                ->whereBetween('updated_at', [$request->date_from, $request->date_to])
                ->where('branch_id', $branch)->paginate(10);
        } 

        return view('pages.hr.loanhistory.index', compact('lists'));
    }

    public function pendingLoans()
    {
        $branch = auth()->user()->branch_id;
        $loans = Loan::where('principal_amount', '>', '50000')
            ->where('branch_id', $branch)
            ->where('status', '=', NULL)
            ->paginate(10);

        return view('pages.hr.loanapprovals.pending.index', compact('loans'));
    }

    public function pendingLoansAPI()
    {
        $loans = Loan::with('customer')->where('principal_amount', '>', '50000')
            ->where('status', '=', NULL)
            ->paginate(10);

        return response()->json($loans, 200);
    }

    public function announcementHr()
    {
        $lists = Announcement::get();

        return view('pages.hr.announce.index', compact('lists'));
    }

    public function addAnnouncement()
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $lists = Announcement::get();

        return view('pages.hr.announce.add.index', compact('lists'));
    }

    public function storeAnnouncement(Request $request)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $request->validate([
            'title' => 'required',
            'subject' => 'nullable|string',
            'content' => 'required',
            'status' => 'required|in:0,1',
        ]);

        Announcement::create($request->all());

        return redirect()->route('announce.index')->with('success', 'Announcement created successfully.');
    }

    public function showAnnouncement($id)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $announcement = Announcement::where('id', $id)->first();

        return view('pages.hr.announce.show.index', compact('announcement'));
    }

    public function updateAnnouncement(Request $request, $id)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $announcement = Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->subject = $request->subject;
        $announcement->content = $request->content;
        $announcement->status = $request->status;
        $announcement->update();

        return redirect(route("announce.index"))->with('success', 'Announcement Updated Successfully');
    }

    public function destroyAnnouncement($id)
    {
        abort_unless(Gate::allows('hr_access'), 404);
        $announcement = Announcement::find($id);
        $announcement->delete();

        return redirect()->back()->with('success', 'Announcement deleted.');
    }

    public function printStatement(Request $request)
    {

        return view('pages.hr.loanapprovals.printStatement.index');
    }

    public function dailyWorkRequest(Request $request)
    {

        $lists = DailyWorkOrder::paginate(20);

        return view('pages.hr.dailyWorkRequest.index', compact('lists'));

    }

    public function dailyWorkRequestPrint($id)
    {

        $branch_address = Branch::find(auth()->user()->branch_id);
        $list = DailyWorkOrder::find($id);

        return view('pages.hr.dailyWorkRequest.print.index', compact('list', 'branch_address'));

    }

    public function dailyWorkRequestApprove($id)
    {
        $check = DailyWorkOrder::find($id);
        $check->status = 'Approved';
        $check->save();

        return redirect()->back()->with('success', 'Request Daily Work Order Approved');
    }

    public function dailyWorkRequestReject($id)
    {
        $check = DailyWorkOrder::find($id);
        $check->status = 'Rejected';
        $check->save();

        return redirect()->back()->with('success', 'Request Daily Work Order Rejected');
    }

}
