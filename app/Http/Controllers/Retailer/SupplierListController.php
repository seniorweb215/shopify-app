<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SupplierListController extends Controller
{
    public function index()
    {
        $list = DB::table('users')
                        ->leftJoin('request', 'request.recipient', '=', 'users.id')
                        ->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
                        ->where('users.type', 1)
                        ->select('users.*', 'request.sender', 'request.request', 'request.status', 'user_details.company_name', 'user_details.company_address', 'user_details.description', 'user_details.photo_path', 'user_details.photo_name')
                        ->get();
        
        $data = [
            'info' => 'I am Retailer Supplier list page',
            'link' => 'retailer/suppliers',
            'list' => $list
        ];
        return view('pages.supplier_list', $data);
    }

    public function request(Request $request)
    {
        $req = $request->all();
        $data = [
            'recipient' => $req['id'],
            'sender' => Auth::user()->id,
            'request' => "approve request",
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $return = DB::table('request')->insert($data);
        echo json_encode($return);
    }

    // public function getCollections($id)
    // {
    //     $list = DB::table('collections')->where('sup_id', $id)->get();
    //     $data = [
    //         'info' => 'I am Retailer Collection list page',
    //         'link' => 'retailer/suppliers',
    //         'data_list' => $list
    //     ];
        
    //     return view('pages.collection_list', $data);
    // }

    public function getCategories($id)
    {
        // $sup_id = DB::table('collections')->where('id', $id)->select('sup_id')->get();
        $list = DB::table('categories')->where('sup_id', $id)->get();
        $data = [
            'info' => 'I am Retailer Category list page',
            'link' => 'retailer/suppliers',
            'data_list' => $list,
            'sup_id' => $id
        ];
        return view('pages.category_list', $data);
    }
}
