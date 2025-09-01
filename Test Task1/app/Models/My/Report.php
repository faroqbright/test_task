<?php

namespace App\Models\My;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $connection = 'my';
    protected $table = 'reports';

    protected $fillable = [
        'company_type_id',
        'name',
        'price',
        'status'
    ];

    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }
}
