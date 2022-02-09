<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{
    protected $fillable = ['originalUrl', 'shortenedUrl', 'title'];
}
