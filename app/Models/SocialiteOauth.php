<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialiteOauth extends Model
{
    protected $table = "socialite_oauth";

    public $timestamps = false;

    protected $guarded = ['id'];
}
