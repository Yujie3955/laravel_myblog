<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MainCate extends Model
{
    use HasFactory;
    protected $fillable = [
        'MainCate_Name', 
	    'Module_Name',
        'MainCate_Color',
        'MainCate_FontColor'
    ];
    
    public function bulletins(): HasMany
    {
        return $this->hasMany(Bulletin::class);
    }
}