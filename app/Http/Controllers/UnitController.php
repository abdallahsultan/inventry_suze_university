<?php

namespace App\Http\Controllers;

use PDF;
use App\Unit;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Exports\ExportCategories;

class UnitController extends Controller
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
    public function index(Request $request)
    {
        $units = Unit::all();
        if($request->ajax()){
            return response()->json([
                
                'units'    => $units
             ]);
        }
        return view('units.index');
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
        $this->validate($request, [
           'name'   => 'required|string|min:2'
        ]);

        Unit::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'untis Created'
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
        $Unit = Unit::find($id);
        return $Unit;
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

        $Unit = Unit::findOrFail($id);

        $Unit->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Unit Update'
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
        Unit::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Unit Delete'
        ]);
    }

    public function apiUnits()
    {
        $units = Unit::all();

        return Datatables::of($units)
            ->addColumn('action', function($units){
                return '<a onclick="editForm('. $units->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $units->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function exportUnitsAll()
    {
        $units = Unit::all();
        $pdf = PDF::loadView('untis.CategoriesAllPDF',compact('untis'));
        return $pdf->download('untis.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCategories())->download('untis.xlsx');
    }
}
