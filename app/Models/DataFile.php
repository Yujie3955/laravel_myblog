<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFile extends Model
{
    use HasFactory;

    //protected $table = 'data_files';  // 對應資料表名稱
    
    protected $fillable = [
        'File_Name', 'File_FakeName', 'File_Ext', 'Module', 'AutoID'
    ];
}
