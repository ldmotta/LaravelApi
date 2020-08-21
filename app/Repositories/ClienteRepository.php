<?php
namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
{
    public function all()
    {
        return Cliente::orderBy('nome')
            ->get()
            ->map->format();
    }

    public function findById($id)
    {
        return Cliente::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function findByName($name)
    {
        return Cliente::where('name', $name)
            ->firstOrFail()
            ->format();
    }

    public function create($requestData)
    {
        return Cliente::create($requestData);
    }
}
