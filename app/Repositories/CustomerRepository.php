<?php
namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function all()
    {
        return Customer::orderBy('name')
            ->get()
            ->map->format();
    }

    public function findById($id)
    {
        return Customer::where('id', $id)
            ->firstOrFail()
            ->format();
    }

    public function findByName($name)
    {
        return Customer::where('name', $name)
            ->firstOrFail()
            ->format();
    }

    public function create($requestData)
    {
        return Customer::create($requestData);
    }
}
