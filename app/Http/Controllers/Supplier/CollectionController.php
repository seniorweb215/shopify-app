<?php

namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryData = Category::getData(Auth::user()->id);
        $data = [
            'info' => 'I am Supplier Category page',
            'link' => 'supplier/category',
            'data_list' => $categoryData
        ];
        return view('pages.collection', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'info' => 'I am Supplier Category add page',
            'link' => 'supplier/category',
        ];
        return view('pages.add_collection', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['sup_id'] = Auth::user()->id;
        $return = Category::store($data);
        return redirect('/supplier/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        print_r($id);exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Category::getRow($id);
        $products = DB::table('products')->where('status', '1')->where('supplier_id', Auth::user()->id)->get();

       $arr_ids = [];
       $selected = [];
        if ($row[0]->product_id != "") {
            $arr_ids = explode(",", $row[0]->product_id);
            $selected = DB::table('products')->whereIn('id', $arr_ids)->get();
            // $data['selected'] = $selected;
            // $data['arr_ids'] = $arr_ids;
        }

        $data = [
            'info' => 'I am Supplier Category edit page',
            'link' => 'supplier/category',
            'row' => $row,
            'products' => $products,
            'selected' => $selected,
            'arr_ids' => $arr_ids
        ];
        
        return view('pages.edit_collection', $data);
    }

    /**
     * Edit products
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit_products(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $updated = DB::table('categories')->where('id', $id)->update(['product_id' => $data['ids']]);
        echo json_encode($updated);
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
        $data = $request->all();
        unset($data['_token']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $updated = Category::updateRow($data, $id);
        return redirect('/supplier/category');
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
        $return = Category::destroy($data['id']);
        echo json_encode($return);
    }
}
