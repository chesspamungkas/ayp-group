<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'worker';
    protected $primaryKey = 'id';
    public function employment()
    {
        return $this->hasMany('App\Models\Employment','workerEmail','email');
    }
}
