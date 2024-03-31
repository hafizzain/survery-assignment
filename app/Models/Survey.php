<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'country', 'dob', 'married', 'date_of_marriage',
        'country_of_marriage', 'widowed', 'ever_married'
    ];
}
