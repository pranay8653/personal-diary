<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;
    protected $fillable = ['d_date','d_title','d_info','d_picture','check'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
