<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'price', 'valid_for', 'expired_at'];
}
