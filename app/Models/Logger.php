<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Logger extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'log';

    protected $primaryKey = '_id';

    protected $dates = [
        'updated_at',
        'created_at'
    ];
}
