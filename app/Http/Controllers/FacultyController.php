<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Exports\ExportFaculties;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use PDF;

class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view('faculties.index');
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
    public function store(Request $request)
    {
        // dd('asdasdasd');
        $this->validate($request, [
           'name'   => 'required|string|min:2'
        ]);
        

        Faculty::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'faculties Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Faculty = Faculty::find($id);
        return $Faculty;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required|string|min:2'
        ]);

        $Faculty = Faculty::findOrFail($id);

        $Faculty->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'faculties Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faculty::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'faculties Delete'
        ]);
    }

    public function apiFaculties()
    {
        $faculties = Faculty::all();

        return Datatables::of($faculties)
            ->addColumn('action', function($faculties){
                return '<a onclick="editForm('. $faculties->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $faculties->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportFacultiesAll()
    {
        $faculties = Faculty::all();
        $pdf = PDF::loadView('faculties.facultiesAllPDF',compact('faculties'));
        return $pdf->download('faculties.pdf');
    }

    public function exportExcel()
    {
        return (new ExportFaculties())->download('Faculties.xlsx');
    }
}
