<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'nascimento',
        'endereco',
        'bairro',
        'complemento',
        'cep'];

    public function getClients()
    {
        return $this->get();
    }

    public function getClientsById($id)
    {
        return $this->where('id', "{$id}")
            ->get();
    }
}
