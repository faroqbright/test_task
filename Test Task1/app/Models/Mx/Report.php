<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $connection = 'mx';
    protected $table = 'reports';

    protected $fillable = ['name'];

    public function states()
    {
        return $this->belongsToMany(State::class, 'report_state')
                    ->withPivot('amount');
    }
}
