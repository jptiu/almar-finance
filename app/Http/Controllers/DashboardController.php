<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataFeed;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles[0]->title == 'HR') {
            return redirect(route("hr.index"));
        } else if (Auth::user()->roles[0]->title == 'Branch Manager') {
            return redirect(route("branch.index"));
        } else if (Auth::user()->roles[0]->title == 'Loan Officer') {
            return redirect(route("loanofficer.index"));
        } else if (Auth::user()->roles[0]->title == 'Auditor') {
            return redirect(route("auditor.index"));
        } else if (Auth::user()->roles[0]->title == 'Collector') {
            return redirect(route("collector.index"));
        } else {
            $dataFeed = new DataFeed();

            return view('pages/dashboard/dashboard', compact('dataFeed'));
        }

    }

    /**
     * Displays the analytics screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function analytics()
    {
        return view('pages/dashboard/analytics');
    }

    /**
     * Displays the fintech screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fintech()
    {
        return view('pages/dashboard/fintech');
    }
}
