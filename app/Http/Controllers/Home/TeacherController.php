<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\BindLineRequest;
use App\Http\Requests\TeacherBindEmailRequest;
use App\Http\Requests\TeacherRegisterRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Traits\BindLine;
use App\Traits\PassportToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    use BindLine, PassportToken;

    public function index()
    {
        $teachers = Teacher::all();

        return TeacherResource::collection($teachers);
    }

    public function me()
    {
        return new TeacherResource(Auth::user());
    }

    // 注册
    public function register(TeacherRegisterRequest $request)
    {
        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $provider = 'teachers';
        $result = $this->getBearerTokenByUser($teacher->id, 2, $provider, false);

        $result['provider'] = $provider;
        $result['created_at'] = time() * 1000;

        return $this->success(['data' => $result]);
    }

    // 邮箱绑定
    public function bindEmail(TeacherBindEmailRequest $request)
    {
        $teacher = Auth::user();
        if ($teacher->email) {
            return $this->forbidden("当前账号已绑定，请勿重复绑定");
        }

        $teacher->email = $request->email;
        $teacher->save();

        return $this->noContent();
    }

    // 绑定line
    public function bindLine(BindLineRequest $request)
    {
        return $this->providerBindLine("teachers", $request->oauth_id);
    }
}
