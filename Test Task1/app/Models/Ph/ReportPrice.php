<?php

namespace App\Models\Ph;

use Illuminate\Database\Eloquent\Model;

class ReportPrice extends Model
{
    protected $connection = 'ph';
    protected $table = 'report_prices';

    protected $fillable = ['report_type_id', 'pages'];

    public function reportType()
    {
        return $this->belongsTo(ReportType::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'report_price_id');
    }
}
