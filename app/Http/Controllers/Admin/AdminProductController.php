<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use App\Faculty;
use App\Product;
use App\Category;
use App\ProductQuntity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       
        $user=auth()->user();
        $categories = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        // $products = Product::with(['ProductQuntities'])->get();
        // $product = Product::where('facility_id',auth()->user()->facility->id)->get();
       
       
        return view('Admin.products.index', compact('categories'))->with('message', 'Product Created Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');
        $faculties = Faculty::orderBy('name','ASC')->get()->pluck('name','id');
        $units = Unit::orderBy('name','ASC')->get()->pluck('name','id');
        return view('Admin.products.create', compact('categories','faculties','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
     
        // $this->validate($request , [
        //     'nama'          => 'required|string',
        //     'qty'           => 'required',
        //     'category_id'   => 'required',
        // ]);

        $input_product = $request->except(['faculty_id','qty','monitor_inventory_auto','minimum_qty']);
       
      
        $input_product['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

       $product= Product::create($input_product);

       $input_product_qty=[
        'product_id'=>$product->id,
        'faculty_id'=>$request->faculty_id,
        'qty'=>$request->qty,
        'monitor_inventory_auto'=>isset($request->monitor_inventory_auto) ? $request->monitor_inventory_auto:0,
        'minimum_qty'=>$request->minimum_qty,
        'type'=>'in',
        'main'=>1,
       ];
       $product_qty= ProductQuntity::create($input_product_qty);
       return redirect()->route('faculties_products.index')->with('message', 'Product Created Successfully');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Products Created'
        // ]);

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
        $category = Category::orderBy('name','ASC')
        ->get()
        ->pluck('name','id');
        $producs = Product::all();
        return view('Admin.products.edit', compact('category'));
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');


        $input = $request->all();
        dd($input);
        $product = Product::findOrFail($id);

        $input['image'] = $product->image;

        if ($request->hasFile('image')){
            if (!$product->image == NULL){
                unlink(public_path($product->image));
            }
            $input['image'] = '/upload/products/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $product->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Update'
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
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Products Deleted'
        ]);
    }

    public function apiProducts(){
      
        $product = Product::all();

        return Datatables::of($product)
            ->addColumn('category_name', function ($product){
                return $product->category->name;
            })
            ->addColumn('type', function ($product){
                if($product->type == 'fixed')
                return 'fixed';
                else {
                return 'consumed';
                }
            })
            ->addColumn('show_photo', function($product){
                if ($product->image == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($product->image) .'" alt="">';
            })
           
           
            ->addColumn('monitor_inventory_auto', function($product){
                if ($product->monitor_inventory_auto){
                    return'<p  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-ok"></i> </p> ';
                }else{
                    return'<p  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></p> ';
                }
               
            })
            ->addColumn('action', function($product){
                $link=route('api.faculties_productdetials',$product->id);
                return'<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> </a> ' .
                    '<a href="'.$link.'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-th"></i> </a> '.
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a> ';
            })
            ->rawColumns(['category_name','show_photo','action','monitor_inventory_auto'])->make(true);

    }
    public function details(Request $request,$product_id)
    {   
        $product=Product::find($product_id);
        $categories = Category::orderBy('name','ASC')->get()->pluck('name','id');
        // $faculty = $product->faculties()->get();
        // return $faculty;
        if ($request->ajax()) {
         
          
            // $faculty = $product->faculties()->select('faculties.id','faculties.name')->distinct()->get();
        
            $faculty = $product->faculties()->distinct()->get()->makeHidden('pivot','updated_at','created_at');
            // return $faculty;
        return Datatables::of($faculty)
            ->addColumn('qty', function ($faculty)use ($product){
                return $product->ProductQuntities()->where('faculty_id',$faculty->id)->max('qty');
            })
            ->addColumn('minimum_qty', function ($faculty)use ($product){
                $minimumqty=$product->ProductQuntities()->where('main',1)->first();
                return $minimumqty->minimum_qty;
            })
          
            ->addColumn('monitor_inventory_auto', function ($faculty) use ($product){
                $moitorInvenotry=$product->ProductQuntities()->where('main',1)->first();
               
                if ($moitorInvenotry->monitor_inventory_auto){
                    return'<p  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-ok"></i> </p> ';
                }else{
                    return'<p  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></p> ';
                }
            })
            
            ->rawColumns(['monitor_inventory_auto'])->make(true);
      }

      return view('Admin.products.faculties',compact('categories','product'))->with('message', 'Product Created Successfully');
    }
}
