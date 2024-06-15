<?php

namespace App\Models\TB_STOCK;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TB_STOCK\TB_COLORIN;
use App\Models\TB_STOCK\TB_COLOROUT;

class TB_COLORST extends Model
{
    use HasFactory;

    protected $table = 'TB_COLOR_STOCK';
    protected $fillable = ['id', 'ProductNo', 'ProductDetail', 'ProductPrice', 'UnitType', 'UnitPrice', 'UnitStart'];

    public function STIN() {
        return $this->belongsTo(TB_COLORIN::class, 'Product_Id', 'ProductNo');
    }

    public function STOUT() {
        return $this->belongsTo(TB_COLOROUT::class, 'Product_Id', 'ProductNo');
    }
}
