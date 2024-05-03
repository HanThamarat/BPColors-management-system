<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_wip extends Model
{
    use HasFactory;

    protected $table = 'tbl_wip';
    protected $fillable = ['no_claimex','type_doit','respon_name','date_start','date_stop','cal_doit','date_create','user_create'];
}
