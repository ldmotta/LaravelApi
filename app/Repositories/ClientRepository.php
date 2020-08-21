<?php
namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    public function all()
    {
        return Client::orderBy('name')
            ->get()
            ->map->format();
    }

    public function findById($id)
    {
        return Client::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function findByName($name)
    {
        return Client::where('name', $name)
            ->firstOrFail()
            ->format();
    }

    public function create($requestData)
    {
        return Client::create($requestData);
    }
}
