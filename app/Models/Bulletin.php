<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;
    protected $fillable = [
        'Bulletin_Title', 
	    'Bulletin_StartDate',
        'Bulletin_EndDate',
        'Bulletin_Content',
        'Bulletin_Forever',
        'Bulletin_Enable'
    ];
}
