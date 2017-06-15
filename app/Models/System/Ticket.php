<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['ticket_no', 'type', 'price'];
}
