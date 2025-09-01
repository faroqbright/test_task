<?php

namespace App\Models\Ph;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    protected $connection = 'ph';
    protected $table = 'report_types';

    protected $fillable = ['name', 'price'];

    public function reportPrices()
    {
        return $this->hasMany(ReportPrice::class, 'report_type_id');
    }
}
