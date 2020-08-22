<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'product_id'];

    public function getOrders()
    {
        return $this->get();
    }
}
