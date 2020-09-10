<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;

trait StudentScope
{
    public function scopeStudent($query)
    {
        return $query->where("student_id", Auth::id());
    }
}
