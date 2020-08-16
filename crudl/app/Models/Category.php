<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $table = 'categories';
    protected $fillable = ['name'];
    
    public function getResults($name = '')
    {
        if(!$name)
            return $this->get();
            
        return $this->where('name', 'LIKE', "%{$name}%")
            ->get();
    }

}
