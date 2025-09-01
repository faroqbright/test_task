<?php

namespace App\Models\Ph;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'ph';
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'slug',
        'registration_number',
        'address'
    ];

    public function reports()
    {
        return $this->hasMany(Report::class, 'company_id');
    }
}
