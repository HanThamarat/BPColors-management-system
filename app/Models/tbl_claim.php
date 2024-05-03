<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_claim extends Model
{
    use HasFactory;

    protected $table = 'tbl_claim';
    protected $fillable = [];
    protected $guarded = ['updated_at','create_at'];
}
