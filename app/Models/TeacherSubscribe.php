<?php

namespace App\Models;

use App\Models\Scopes\StudentScope;
use App\Models\Scopes\TeacherScope;
use Illuminate\Database\Eloquent\Model;

class TeacherSubscribe extends Model
{
    use StudentScope, TeacherScope;

    protected $table = "teacher_subscribe";

    public $timestamps = false;

    protected $guarded = ['id'];
}
