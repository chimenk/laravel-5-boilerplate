<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['rfid', 'name', 'address', 'phone', 'member_type'];
}
