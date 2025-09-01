<?php

namespace App\Models\Sg;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $connection = 'sg';
    protected $table = 'reports';

    protected $fillable = [
        'company_id', 'name', 'price'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
