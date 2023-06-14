<?php

namespace App\Http\Controllers;

use PDF;
use Excel;
use App\User;
use App\Faculty;
use Illuminate\Http\Request;
use App\Exports\ExportSuppliers;
use App\Imports\SuppliersImport;
use Yajra\DataTables\DataTables;
use Validator;


class UserController extends Controller {
	public function __construct() {
		$this->middleware('role:admin,staff');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$users = User::all();
		
		$faculty = Faculty::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
		return view('user.index',compact('faculty'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|unique:users',
		]);
		$data=$request->all();
		$data['password']=bcrypt($request->password);	
		User::create($data);

		return response()->json([
			'success' => true,
			'message' => 'User Created',
		]);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$users = User::find($id);
		return $users;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required|string|min:2',
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
			'phone' => 'required|string|max:255|unique:users,phone,'.$id,
			'password'   => 'sometimes|confirmed',
		]);

		$user = User::findOrFail($id);
		$data=$request->all();
		
		if(!$request->password){
         $data=$request->except('password','password_confirmation');
		}else{
		$data['password']=bcrypt($request->password);	
		}
		
		$user->update($data);

		return response()->json([
			'success' => true,
			'message' => 'user Updated',
		]);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user= User::find($id);
	
		if($user->role == 'staff'){

			User::destroy($id);
			return response()->json([
				'success' => true,
				'message' => 'User Delete',
			]);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'Admin can not delete',
			]);
		}

		
	}
	public function editprofile() {
		$user=auth()->user();
		if($user->role == 'admin'){
			$faculty = Faculty::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
		}else{
			$faculty = Faculty::where('id',auth()->user()->id)->orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
		}
		
		return view('user.profile',compact('faculty','user'));
	}
	public function update_profile(Request $request) {
		// dd($request->all());
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|min:2',
			'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->id,
			'phone' => 'required|string|max:18|unique:users,phone,'.auth()->user()->id,
			'password'   => 'sometimes|confirmed',
		]);

		if ($validator->fails()) {
            return    back()
                        ->withErrors($validator)
                        ->withInput();
        }
		$users = auth()->user();
		$data=$request->all();
		if(!$request->password){
         $data=$request->except('password','password_confirmation');
		}else{
		$data['password']=bcrypt($request->password);	
		}
		$users->update($data);

		return back()->with('message', 'Profile Updated');
	}

	

	public function apiUsers() {
		$users = User::all();

		return Datatables::of($users)
			->addColumn('faculty_name', function ($users) {
				return $users->faculty->name ?? '';
			})
			->addColumn('action', function ($users) {
				if($users->role == 'admin'){
					return '<a onclick="editForm(' . $users->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' ;
				}
				return '<a onclick="editForm(' . $users->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
				'<a onclick="deleteData(' . $users->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			})
			->rawColumns(['action'])->make(true);
	}

	public function ImportExcel(Request $request) {
		//Validasi
		$this->validate($request, [
			'file' => 'required|mimes:xls,xlsx',
		]);

		if ($request->hasFile('file')) {
			//UPLOAD FILE
			$file = $request->file('file'); //GET FILE
			Excel::import(new SuppliersImport, $file); //IMPORT FILE
			return redirect()->back()->with(['success' => 'Upload file data suppliers !']);
		}

		return redirect()->back()->with(['error' => 'Please choose file before!']);
	}

	public function exportSuppliersAll() {
		$suppliers = Supplier::all();
		$pdf = PDF::loadView('suppliers.SuppliersAllPDF', compact('suppliers'));
		return $pdf->download('suppliers.pdf');
	}

	public function exportExcel() {
		return (new ExportSuppliers)->download('suppliers.xlsx');
	}

	
}
