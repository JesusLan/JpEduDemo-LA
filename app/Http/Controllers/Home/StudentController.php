<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\BindLineRequest;
use App\Http\Requests\StudentBindEmailRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Traits\BindLine;
use App\Traits\PassportToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    use BindLine, PassportToken;

    public function index()
    {
        $students = Student::all();

        return StudentResource::collection($students);
    }

    public function me()
    {
        return new StudentResource(Auth::user());
    }

    /**
     * @param StudentRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StudentRegisterRequest $request)
    {
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $provider = 'students';
        $result = $this->getBearerTokenByUser($student->id, 2, $provider, false);

        $result['provider'] = $provider;
        $result['created_at'] = time() * 1000;

        return $this->success(['data' => $result]);
    }

    // 邮箱绑定
    public function bindEmail(StudentBindEmailRequest $request)
    {
        $student = Auth::user();
        if ($student->email) {
            return $this->forbidden("当前账号已绑定，请勿重复绑定");
        }

        $student->email = $request->email;
        $student->save();

        return $this->noContent();
    }

    // 绑定line
    public function bindLine(BindLineRequest $request)
    {
        return $this->providerBindLine("students", $request->oauth_id);
    }
}
