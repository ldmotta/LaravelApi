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
        'deleted_at'
    ];

    public function getClients()
    {
        return $this->get();
    }

    public function getClientsById($id)
    {
        return $this->where('id', "{$id}")
            ->get();
    }

    public function order()
    {
        return $this->hasMany(Pedido::class);
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'nome' =>$this->nome,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'nascimento' => $this->nascimento,
            'endereco' => $this->endereco,
            'bairro' => $this->bairro,
            'complemento' => $this->complemento,
            'cep' => $this->cep,
            'created_at' => $this->created_at,    
            'updated_at' => $this->updated_at    
        ];
    }
}
