<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = auth()->user()->branch_id;
        $lists = Chart::where('branch_id', $branch)->paginate(10);
        return view('pages.chart.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.chart.create.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch = auth()->user()->branch_id;
        $chart = new Chart();
        $chart->acc_no = $request->acc_no;
        $chart->acc_class = $request->acc_class;
        $chart->acc_type = $request->acc_type;
        $chart->acc_title = $request->acc_title;
        $chart->acc_description = $request->acc_description;
        $chart->branch_id = $branch;
        $chart->save();

        return redirect(route("chart.index"))->with('success', 'Created Successfully');
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
        $chart = Chart::find($id);

        return view('pages.chart.edit.index', compact('chart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chart = Chart::find($id);
        $chart->acc_no = $request->acc_no;
        $chart->acc_class = $request->acc_class;
        $chart->acc_type = $request->acc_type;
        $chart->acc_title = $request->acc_title;
        $chart->acc_description = $request->acc_description;
        $chart->update();

        return redirect(route("pages.chart.index"))->with('success', 'Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function importCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Validate the uploaded file
        ]);
        $branch = auth()->user()->branch_id;

        $file = $request->file('file');

        // Read the CSV data
        $csvData = file_get_contents($file);
        // dd($csvData);

        // Split CSV data into rows
        $rows = array_map('str_getcsv', explode("\n", $csvData));

        // Remove the header row if it exists
        $header = array_shift($rows);
        // dd($header);

        foreach ($rows as $row) {
            // Create and save your model instance
            Chart::create([
                'acc_no' => $row[0],
                'acc_class' => $row[1],
                'acc_type' => $row[2],
                'acc_title' => $row[3],
                'acc_description' => $row[4],
                'branch_id' => $branch,
            ]);
        }

        return redirect(route("chart.index"))->with('success', 'CSV Data Imported Successfully');
    }
}
