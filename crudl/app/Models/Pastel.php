<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
    protected $fillable = [
        'nome',
        'preco',
        'foto'];

    public function getPasteis()
    {
        return $this->get();
    }
    
}
