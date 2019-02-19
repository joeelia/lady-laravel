<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Haircuts extends Model
{
    protected $fillable = [
        'name','was_called',
    ];
}
