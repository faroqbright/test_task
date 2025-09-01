<?php

namespace App\Models\My;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'my';
    protected $table = 'companies';

    protected $fillable = [
        'name', 'slug', 'registration_number', 'address', 'company_type_id'
    ];

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }
}
