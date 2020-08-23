<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'customer_id',
        'product_id',
        'deleted_at'];

    public function getOrders()
    {
        return $this->get();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
