<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image'];

    public function getPasteis()
    {
        return $this->get();
    }
    
}
