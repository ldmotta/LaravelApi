<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'price', 'image', 'deleted_at'];

    public function getProducts()
    {
        return $this->get();
    }
    
    /**
     * Retorna os products com base no array de id's de pastel
     */
    public function products($product_ids)
    {
        return $this->select('id', 'name', 'price', 'image')
            ->whereIn('id', $product_ids)
            ->get();
    }
}
