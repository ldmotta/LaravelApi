<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pastel extends Model
{
    use SoftDeletes;
    
    protected $table = 'products';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'price', 'image', 'deleted_at'];

    public function getPasteis()
    {
        return $this->get();
    }
    
    /**
     * Cria um name para fazer upload da imagem
     * @param \Illuminate\Http\Request  $request
     * @param string $imageField
     * @param bool $unique
     * @return string
     */
    public function makeImageName($request, $imageField, $unique = false)
    {
        $name = Str::kebab($request->name);       
        if($unique)
            $name = md5($request->name . time());
        $ext = $request->file($imageField)->extension();
        return "{$name}.{$ext}"; 
    }
    
    /**
     * Retorna os products com base no array de id's de pastel
     */
    public function products($product_ids)
    {
        return $this->select('id', 'name', 'price', 'image')
            ->whereIn('id', $product_ids)
            ->get();
    }
}
