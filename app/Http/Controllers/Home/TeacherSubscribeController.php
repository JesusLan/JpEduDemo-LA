<?php

namespace App\Http\Controllers\Home;

use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
use App\Models\TeacherSubscribe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TeacherSubscribeController extends Controller
{
    /**
     * 订阅
     *
     * @param $teacherId
     * @return \Illuminate\Http\Response
     */
    public function subscribe($teacherId)
    {
        TeacherSubscribe::firstOrCreate(['teacher_id' => $teacherId, 'student_id' => Auth::id()], [
            "subscribe_at" => Carbon::now()
        ]);

        return $this->created();
    }

    /**
     * 取消订阅
     *
     * @param $teacherId
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe($teacherId)
    {
        TeacherSubscribe::student()->where("teacher_id", $teacherId)->delete();

        return $this->noContent();
    }

    public function students()
    {
        $students = Auth::user()->students;

        return StudentResource::collection($students);
    }

    public function teachers()
    {
        $teachers = Auth::user()->teachers;

        return TeacherResource::collection($teachers);
    }

}
