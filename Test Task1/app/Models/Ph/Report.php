<?php

namespace App\Models\Ph;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $connection = 'ph';
    protected $table = 'reports';

    protected $fillable = [
        'company_id',
        'report_price_id',
        'period_date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reportPrice()
    {
        return $this->belongsTo(ReportPrice::class);
    }
}
