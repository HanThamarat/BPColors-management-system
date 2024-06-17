<?php

namespace App\Models\TB_STOCK;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TB_STOCK\TB_COLOROUT;
use App\Models\TB_STOCK\TB_COLORST;

class TB_COLORIN extends Model
{
    use HasFactory;

    protected $table = 'TB_COLORST_IN';
    protected $fillable = ['GramQuantity', 'InUnitPirece', 'DateSt_In', 'Product_con', 'Product_Id'];

    public function STOUT() {
        return $this->belongsTo(TB_COLOROUT::class, 'Product_Id', 'Product_Id');
    }

    public function Stock() {
        return $this->belongsTo(TB_COLORST::class, 'Product_Id', 'ProductNo');
    }
}
