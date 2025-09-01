<?php

namespace App\Models\My;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    protected $connection = 'my';
    protected $table = 'company_types';

    protected $fillable = ['name'];

    public function reports()
    {
        return $this->hasMany(Report::class, 'company_type_id');
    }
}
