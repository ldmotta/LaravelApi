<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'nascimento',
        'endereco',
        'bairro',
        'complemento',
        'cep',
        'deleted_at'];

    public function getClients()
    {
        return $this->get();
    }

    public function getClientsById($id)
    {
        return $this->where('id', "{$id}")
            ->get();
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}
