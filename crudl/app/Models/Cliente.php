<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'address',
        'district',
        'complement',
        'zip_code'];

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
