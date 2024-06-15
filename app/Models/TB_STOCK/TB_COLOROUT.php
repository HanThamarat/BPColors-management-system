<?php

namespace App\Models\TB_STOCK;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TB_STOCK\TB_COLORIN;
use App\Models\TB_STOCK\TB_COLORST;

class TB_COLOROUT extends Model
{
    use HasFactory;
    
    protected $table = 'TB_COLORST_OUT';
    protected $fillable = ['OutGramQuantity', 'OutUnitPrice', 'ReferNo', 'Product_Id', 'ClaimNo', 'DateSt_Out'];

    public function STIN() {
        return $this->belongsTo(TB_COLORIN::class, 'ProductNo', 'Product_Id');
    }

    public function Stock() {
        return $this->belongsTo(TB_COLORST::class, 'ProductNo', 'Product_Id');
    }
}
