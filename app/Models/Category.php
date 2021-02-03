<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function getData($user_id){
        // $value=DB::table('categories')->orderBy('category_name', 'asc')->get();
        $value = DB::table('categories')
                        ->join('collections', 'collections.id', '=', 'categories.collection_id')
                        ->where('collections.sup_id', $user_id)
                        ->select('categories.*', 'collections.collection_name', 'collections.sup_id')
                        ->get();

        return $value;
    }
    public static function destroy($id) {
        DB::delete('delete from categories where id = ?',[$id]);
        return "successfully!";
    }
    public static function store($data) {
        DB::table('categories')->insert($data);
        return "successfully!";
    }
    public static function getRow($id) {
        return DB::select('select * from categories where id = ?',[$id]);
    }
    public static function updateRow($data, $id) {
        return DB::select('update categories set category_name = ?, collection_id = ?, note = ?, status = ?, updated_at = ? where id = ?',[$data['category_name'], $data['collection_id'], $data['note'], $data['status'], $data['updated_at'], $id]);
        // return DB::table('categories')->whereIn('id', $id)->update($data);
    }
}
