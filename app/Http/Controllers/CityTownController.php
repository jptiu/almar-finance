<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityTownCreateRequest;
use App\Http\Requests\CityTownUpdateRequest;
use App\Models\CityTown;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CityTownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        //abort_unless(Gate::allows('loan_access'), 404);
        $branch = auth()->user()->branch_id;
        if (isset($request->search)) {
            $lists = CityTown::where('branch_id', $branch)->with('user')
                ->where('city_town', 'LIKE', '%', $request->search, '%')->orderBy("created_at", "asc")
                ->paginate(10);
        } else {
            $lists = CityTown::where('branch_id', $branch)->with('user')->paginate(10);
        }

        return view('pages.city.index', compact('lists'));
    }

    public function add()
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('admin_access'), 404);
        $branch = auth()->user()->branch_id;
        $collectors = User::where('branch_id', $branch)->where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        return view('pages.city.add.index', compact('collectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityTownCreateRequest $request)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('admin_access'), 404);
        $branch = auth()->user()->branch_id;
        if ($request->validated()) {
            $city = new CityTown();
            $city->code = $request->code;
            $city->city_town = $request->city_town;
            $city->user_id = $request->user_id;
            $city->branch_id = $branch;
            $city->save();

            return redirect(route("city.index"))->with('success', 'Created City/Town Successfully');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('admin_access'), 404);
        $branch = auth()->user()->branch_id;
        $city = CityTown::where('branch_id', $branch)->where('id', $id)->first();
        $collectors = User::where('branch_id', $branch)->where('roles.title', 'Collector')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->get();

        return view('pages.city.update.index', compact('city', 'collectors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityTownUpdateRequest $request, $id)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('admin_access'), 404);
        if ($request->validated()) {
            $city = CityTown::find($id);
            $city->code = $request->code;
            $city->city_town = $request->city_town;
            $city->user_id = $request->user_id;
            $city->update();

            return redirect(route("city.index"))->with('success', 'City/Town Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_unless(Gate::allows('loan_access'), 404);
        $city = CityTown::find($id);
        $city->delete();

        return redirect()->back()->with('success', 'City/Town deleted.');
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
            CityTown::create([
                'city_town' => $row[1],
                'code' => $row[0],
                'user_id' => $row[3],
                'branch_id' => $branch,
            ]);
        }

        return redirect(route("city.index"))->with('success', 'CSV Data Imported Successfully');
    }
}
