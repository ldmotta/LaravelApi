<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'client_id',
        'product_id'];

    public function getPedidos()
    {
        return $this->get();
    }
}
