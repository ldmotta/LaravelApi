<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pastel extends Model
{
    use SoftDeletes;
    
    protected $table = 'pasteis';
    protected $dates = ['deleted_at'];
    protected $fillable = ['nome', 'preco', 'foto', 'deleted_at'];

    public function getPasteis()
    {
        return $this->get();
    }
    
    /**
     * Cria um nome para fazer upload da imagem
     * @param \Illuminate\Http\Request  $request
     * @param string $imageField
     * @param bool $unique
     * @return string
     */
    public function makeImageName($request, $imageField, $unique = false)
    {
        $nome = Str::kebab($request->nome);       
        if($unique)
            $nome = md5($request->nome . time());
        $ext = $request->file($imageField)->extension();
        return "{$nome}.{$ext}"; 
    }
    
    /**
     * Retorna os pasteis com base no array de id's de pastel
     */
    public function pasteis($pastel_ids)
    {
        return $this->select('id', 'nome', 'preco', 'foto')
            ->whereIn('id', $pastel_ids)
            ->get();
    }
}
