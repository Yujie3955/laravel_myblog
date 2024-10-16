<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bulletin extends Model
{
    use HasFactory;
    protected $fillable = [
        'Bulletin_Title', 
	    'Bulletin_StartDate',
        'Bulletin_EndDate',
        'Bulletin_Content',
        'Bulletin_Forever',
        'Bulletin_Enable',
        'main_cate_id'
    ];
    // 多對一關聯：Bulletin 屬於某個 MainCate
    public function mainCate(): BelongsTo
    {
        return $this->belongsTo(MainCate::class , 'main_cate_id');
    }
    
    // 一對多:一則公告有多個檔案
    public function files(){
        return $this->hasMany(DataFile::class, 'AutoID')
                    ->where('Module', 'Bulletin');
    }

}
