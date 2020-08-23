<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Repository implements RepositoryInterface
{
    protected $model;
    protected $uploadFolder;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->uploadFolder = $model->getTable();
    }
    
    // Finds all entry of the container and returns it.    
    public function all()
    {
        return $this->model->all();
    }

    // Creates a record in a container from the given array data.    
    public function create($data)
    {
        return $this->model->create($data);
    }

    // Updates a record in a container from the given object data.
    public function update($data)
    {
        $record = $this->model->find($data->id);
        return $record->update($data);
    }
   
    // Finds an entry of the container by its identifier and remove it.
    public function delete($product)
    {
        if (isset($product->image)) {
            $filePath = "{$this->uploadFolder}/{$product->image}";
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $this->model->destroy($product->id);
    }

    // Finds an entry of the container by its identifier and returns it.    
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Finds an entry of the container by its identifier and returns it.
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Gets the assicated model    
    public function getModel()
    {
        return $this->model;
    }

    // Defines the model that you want to instantiate    
    public function setModel($model)
    {
        $this->model = $model;
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this;
    }
    
    // Set the relationships that should be eager loaded.
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
