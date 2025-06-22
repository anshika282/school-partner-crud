<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolPartner extends Model
{
    use HasFactory;
     protected $fillable = [
        'school_name',
        'contact_person',
        'email',
        'num_students',
        'status',
    ];
}
