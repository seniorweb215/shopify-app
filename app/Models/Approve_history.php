<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approve_history extends Model
{
    use HasFactory;

    protected $table = 'approve_histories';
    protected $primaryKey = 'id';
    // public $timestamps = false;
}
