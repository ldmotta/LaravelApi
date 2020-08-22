<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_date',
        'address',
        'district',
        'complement',
        'zip_code',
        'deleted_at'
    ];

    public function getCustomers()
    {
        return $this->get();
    }

    public function getCustomersById($id)
    {
        return $this->where('id', "{$id}")
            ->get();
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'address' => $this->address,
            'district' => $this->district,
            'complement' => $this->complement,
            'zip_code' => $this->zip_code,
            'created_at' => $this->created_at,    
            'updated_at' => $this->updated_at    
        ];
    }
}
