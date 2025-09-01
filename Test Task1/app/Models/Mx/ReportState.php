<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class ReportState extends Model
{
    protected $connection = 'mx';
    protected $table = 'report_state';

    protected $fillable = [
        'state_id',
        'report_id',
        'amount'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
