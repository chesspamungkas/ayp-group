<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $table = 'employment';

    public function worker()
    {
        $this->belongsTo('App\Models\Worker','workerEmail','email');
    }
}
