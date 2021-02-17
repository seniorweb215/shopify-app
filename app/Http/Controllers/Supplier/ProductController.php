<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        $productData = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.supplier_id')
                        // ->join('categories', 'categories.id', '=', 'products.category_id')
                        ->where('supplier_id', Auth::user()->id)
                        ->select('products.*', 'users.name')
                        ->get();
        $data = [
            'info' => 'I am Supplier Product page',
            'link' => 'supplier/product',
            'data_list' => $productData
        ];
        return view('pages.product', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category_list = DB::table('categories')->where('status', '1')->get();
        $data = [
            'info' => 'I am Supplier Product add page',
            'link' => 'supplier/product'
        ];
        return view('pages.add_product', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products,title', 
            'price' => 'required|numeric|min:0', 
            'quantity' => 'required|numeric|min:1|',
            'weight' => 'numeric|min:0',
            'shipping_cost' => 'numeric|min:0',
            'file' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->all();

        if ($request->file()) {
            $origianlName = $request->file->getClientOriginalName();
            $fileName = time().'_'.$origianlName;
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            
            $data['file_name'] = $origianlName;
            $data['file_path'] = 'storage/' . $filePath;
        }
        
        $data['supplier_id'] = Auth::user()->id;
        $data['total_quantity'] = $data['quantity'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        unset($data['_token']);
        unset($data['file']);
        DB::table('products')->insert($data);
        return redirect('/supplier/product');
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
        
        $product_list = DB::table('products')->where('id', $id)->get();
        $data = [
            'info' => 'I am Supplier Product edit page',
            'link' => 'supplier/product',
            'row' => $product_list

        ];
        return view('pages.edit_product', $data);
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
        $request->validate([
            'title' => 'required', 
            'price' => 'required|numeric|min:0', 
            'quantity' => 'required|numeric|min:1|',
            'weight' => 'numeric|min:0',
            'shipping_cost' => 'numeric|min:0',
            'file' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $data = $request->all();
        unset($data['_token']);
        $data['supplier_id'] = Auth::user()->id;
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($request->file()) {
            $col = DB::table('products')->select('file_path')->where('id', $id)->get();
            unlink($col[0]->file_path);

            $f = $data['file'];
            unset($data['file']);

            $origianlName = $f->getClientOriginalName();
            $fileName = time().'_'.$origianlName;
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            
            $data['file_name'] = $origianlName;
            $data['file_path'] = 'storage/' . $filePath;
        }
        
        DB::table('products')->where('id', $id)->update($data);
        return redirect('/supplier/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $col = DB::table('products')->select('file_path')->where('id', $data['id'])->get();
        if ($col[0]->file_path != '') {
            unlink($col[0]->file_path);
        }
        $return = DB::table('products')->where('id', $data['id'])->delete();
        echo json_encode($return);
    }
}
