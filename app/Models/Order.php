<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'client_id',
        'product_id',
        'deleted_at'];

    public function getPedidos()
    {
        return $this->get();
    }

    public function cliente()
    {
        return $this->belongsTo(Client::class);
    }

}
