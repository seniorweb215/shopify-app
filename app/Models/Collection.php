<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    public static function getData($user_id){
        $value=DB::table('collections')->where('sup_id', $user_id)->orderBy('collection_name', 'asc')->get();
        return $value;
    }
    public static function destroy($id) {
        DB::delete('delete from collections where id = ?',[$id]);
        return "successfully!";
    }
    public static function store($data) {
        DB::table('collections')->insert($data);
        return "successfully!";
    }
    public static function getRow($id) {
        return DB::select('select * from collections where id = ?',[$id]);
    }
    public static function updateRow($data, $id) {
        return DB::select('update collections set collection_name = ?, note = ?, status = ?, updated_at = ? where id = ?',[$data['collection_name'], $data['note'], $data['status'], $data['updated_at'], $id]);
        // return DB::table('categories')->whereIn('id', $id)->update($data);
    }
}
