<?php

namespace App\Http\Controllers\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;

class SuperCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionData = Collection::getData(Auth::user()->id);
        $data = [
            'info' => 'I am Supplier Collection page',
            'link' => 'supplier/collection',
            'data_list' => $collectionData
        ];
        return view('pages.super_collection', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'info' => 'I am Supplier collection add page',
            'link' => 'supplier/collection'
        ];
        return view('pages.add_supper_collection', $data);
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
        $data['sup_id'] = Auth::user()->id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $return = Collection::store($data);
        return redirect('/supplier/collection');
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
        $row = Collection::getRow($id);
        $data = [
            'info' => 'I am Supplier Collection edit page',
            'link' => 'supplier/collection',
            'row' => $row
        ];
        return view('pages.edit_super_collection', $data);
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
        
        $updated = Collection::updateRow($data, $id);
        return redirect('/supplier/collection');
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
        $return = Collection::destroy($data['id']);
        echo json_encode($return);
    }
}
