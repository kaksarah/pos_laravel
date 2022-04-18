<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $table = "sales_details";
    protected $primaryKey = "id_sale_details";
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Products::class, 'id_product', 'id_product');
    }
}
