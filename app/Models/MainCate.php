<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCate extends Model
{
    use HasFactory;
    protected $fillable = [
        'MainCate_Name', 
	    'Module_Name',
        'MainCate_Color',
        'MainCate_FontColor'
    ];
}
