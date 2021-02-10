<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Approve_history;
// use Shopify;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $row = DB::table('categories')->where('id', $id)->select('product_id', 'sup_id')->get();
        $arr_ids = [];
        $selected = [];
        if ($row[0]->product_id != "") {
            $arr_ids = explode(",", $row[0]->product_id);
            $selected = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.supplier_id')
                        ->whereIn('products.id', $arr_ids)
                        ->select('products.*', 'users.name')
                        ->get();
        }
        $data = [
            'info' => 'I am Retailer Product page',
            'link' => 'retailer/suppliers', //'retailer/product'
            'data_list' => $selected,
            'sup_id' => $row[0]->sup_id
        ];
        
        return view('pages.r_product', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productData = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.supplier_id')
                        // ->join('categories', 'categories.id', '=', 'products.category_id')
                        ->where('products.id', $id)
                        ->select('products.*', 'users.name')
                        ->get();
        $data = [
            'info' => 'I am Retailer Product details view page',
            'link' => 'retailer/product',
            'row' => $productData
        ];
        
        return view('pages.show_r_product', $data);
    }

     /**
     * Add product into shopify using API
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        // approved product history table
        // Be able to add when you are using domain address
        $data = $request->all();
        // Start - Add history
        $inventory = $data['quantity'] - $data['approved']; // Not reflected order quantity.
        DB::table('products')->where('id', $data['id'])->update(['quantity' => $inventory]);
        
        $history = [];
        $history['product_id'] = $data['id'];
        $history['retailer_id'] = Auth::user()->id;
        $history['approved_price'] = $data['price'];
        $history['approved_quantity'] = $data['approved'];
        $history['approved_description'] = $data['description'];
        $history['approved_tags'] = $data['tags'];
        $history['created_at'] = date('Y-m-d H:i:s');
        $history['updated_at'] = date('Y-m-d H:i:s');
        DB::table('approve_histories')->insert($history);
        // End - Add history
        
        // Start - Add into shopify
        $tags = [];
        if ($data['tags'] != '') {
            $tags = explode(',', $data['tags']);
        }

        $row = DB::table('products')
                    ->join('users', 'users.id', '=', 'products.supplier_id')
                    ->where('products.id', $data['id'])
                    ->select('products.*', 'users.name')
                    ->get();
        
        $products_array = [
            'product' => [
                'title' => $row[0]->title,
                'body_html' => '<p>'. $data['description'] .'</p>',
                'vendor' => $row[0]->name,
                'tags' => $tags,
                'status'=> 'draft',
                // 'published'=> false,
                'images' => [
                    [
                        'src' => asset($row[0]->file_path)
                    ]
                ],
                'variants' => [
                    [
                        'sku' => $row[0]->SKU,
                        'price' => $data['price'],
                        'weight' => $row[0]->weight,
                        'inventory_quantity' => $data['approved'],
                        'requires_shipping' => true
                    ]
                ],
            ]
        ];
        
        $url = "https://".env('SHOPIFY_API_KEY').":".env('SHOPIFY_API_PASS')."@".env('SHOPIFY_ADDRESS')."/admin/api/2021-01/products.json";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, 0);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($products_array));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        curl_close ($curl);
        // End - Add into shopify
        
        echo json_encode($response);
    }

    /**
     * Changes needed to approve product
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getChanges(Request $request)
    {
        $data = $request->all();
        $row = DB::table('products')->where('id', $data['id'])->select('title', 'price', 'description', 'quantity')->get();
        echo json_encode($row);
    }
}
