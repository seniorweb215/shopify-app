<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = DB::table('users')
                        ->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
                        ->where('users.id', Auth::user()->id)
                        ->select('users.id as user_table_id', 'users.name', 'users.email', 'user_details.*')
                        ->get();
        $data = [
            'info' => 'I am Supplier Profile page',
            'link' => 'supplier/profile',
            'row' => $profile
        ];
        return view('pages.profile', $data);
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
        //
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
        //
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
        // Hash::make($request->password)
        $data = $request->all();
        
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $user_table_data = [];
        $user_table_data['name'] = $data['name'];
        unset($data['name']);
        $user_table_data['password'] = Hash::make( $data['password']);
        unset($data['password']);
        $user_table_data['email'] = $data['email'];
        unset($data['email']);
        
        $user_table_data['updated_at'] = date('Y-m-d H:i:s');
        
        if ($request->file()) {
            $origianlName = $request->file->getClientOriginalName();
            $fileName = time().'_'.$origianlName;
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            
            $data['photo_name'] = $origianlName;
            $data['photo_path'] = 'storage/' . $filePath;
        }
        
        unset($data['_token']);
        unset($data['file']);

        if ($data['id'] != '') {
            if ($request->file()) {
                $col = DB::table('user_details')->select('photo_path')->where('id', $data['id'])->get();
                if ($col[0]->photo_path != '') { //file_exists('')
                    // Storage::exists(public_path('img/dummy.jpg'))
                    unlink($col[0]->photo_path);    
                }
            }
            $details_id = $data['id'];
            unset($data['id']);
            DB::table('user_details')->where('id', $details_id)->update($data);
        } else {
            unset($data['id']);
            $data['user_id'] = $id;
            $data['created_at'] = date('Y-m-d H:i:s');
            DB::table('user_details')->insert($data);
        }

        DB::table('users')->where('id', $id)->update($user_table_data);
        return redirect('/supplier/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
