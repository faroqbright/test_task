<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'mx';
    protected $table = 'companies';

    protected $fillable = [
        'name', 'slug', 'registration_number', 'state_id', 'address'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
