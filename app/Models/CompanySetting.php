<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'company_name',
        'email',
        'logo',
        'address',
        'phone',
        'website',
        'timezone',
    ];
}
