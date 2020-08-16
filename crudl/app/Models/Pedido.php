<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cliente_id',
        'pastel_id'];

    public function getPedidos()
    {
        return $this->get();
    }
}
