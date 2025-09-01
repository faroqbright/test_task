<?php

namespace App\Models\Mx;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $connection = 'mx';
    protected $table = 'states';

    protected $fillable = ['name'];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_state')
            ->withPivot('amount');
    }
}
