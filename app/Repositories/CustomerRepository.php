<?php
namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    // customer property on class instance
    protected $customer;

    // Constructor to bind customer to repo
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    
    // Get all instances of model
    public function all()
    {
        return $this->customer->orderBy('name')
            ->get()
            ->map->format();
    }

    public function findById($id)
    {
        return $this->customer->find($id);
    }

    public function findByName($name)
    {
        return $this->customer->where('name', $name)
            ->firstOrFail()
            ->format();
    }

    public function create($data)
    {
        return $this->customer->create($data);
    }

    public function update($data)
    {
        $record = $this->customer->find($data->id);
        return $record->update($data);
    }

    public function delete($id)
    {
        $this->customer->destroy($id);
    }
}
