<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestedController extends Controller
{
    public function index()
    {
        $list = DB::table('request')
                        ->leftJoin('users', 'users.id', '=', 'request.sender')
                        ->where('request.recipient', Auth::user()->id)
                        ->select('users.*', 'request.*')
                        ->get();

        $data = [
            'info' => 'I am Supplier Requested list page',
            'link' => 'supplier/requested',
            'list' => $list
        ];
        // print_r($data);exit;
        return view('pages.requested_list', $data);
    }

    /**
     * Adding request from retailer
     *
     * @return \Illuminate\Http\Response
     */
    public function receive(Request $request)
    {
        $req = $request->all();
        $id = $req['id'];
        unset($req['_token']);
        unset($req['id']);
        $return = DB::table('request')->where('id', $id)->update($req);
        echo json_encode($return);
    }

}
