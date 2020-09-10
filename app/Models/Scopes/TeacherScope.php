<?php


namespace App\Models\Scopes;


use Illuminate\Support\Facades\Auth;

trait TeacherScope
{
    public function scopeTeacher($query)
    {
        return $query->where("teacher_id", Auth::id());
    }
}
