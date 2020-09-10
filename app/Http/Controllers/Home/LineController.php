<?php

namespace App\Http\Controllers\Home;

use App\Models\SocialiteOauth;
use App\Models\Student;
use App\Models\Teacher;
use App\Traits\PassportToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\Config;

class LineController extends Controller
{
    use PassportToken;

    public function redirectToProvider($authProvider)
    {
        $config = new Config(
            config("services.line.client_id"),
            config("services.line.client_secret"),
            config("services.line.redirect") . "-" . $authProvider
        );

        return Socialite::driver("line")->setConfig($config)->redirect();
    }

    public function studentBindCallback()
    {
        return $this->responseBindLine("students", "services.line.student_bind_callback_uri");
    }

    public function teacherBindCallback()
    {
        return $this->responseBindLine("teacher", "services.line.teacher_bind_callback_uri");
    }

    /**
     * @param $provider
     * @param $configKey
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function responseBindLine($provider, $configKey)
    {
        $path = $provider == "students" ? "student-bind" : "teacher-bind";
        $config = new Config(
            config("services.line.client_id"),
            config("services.line.client_secret"),
            config("services.line.redirect") . "-" . $path
        );

        $user = Socialite::driver("line")->setConfig($config)->user();
        $socialiteOauth = $this->firstSocialiteOauth($provider, $user);
        if ($socialiteOauth->user_id > 0) {
            return $this->redirectBind($configKey, ['status' => false, 'message' => "当前账号已绑定其他账号"]);
        }

        return $this->redirectBind($configKey, ['status' => true, 'oauth_id' => $user->getId()]);
    }

    private function redirectBind($configKey, $data)
    {
        $url = config($configKey) . "?result=" . json_encode($data);
        return redirect($url);
    }

    /**
     * @param $provider
     * @param $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function firstSocialiteOauth($provider, $user)
    {
        return SocialiteOauth::query()->firstOrCreate([
            'oauth_type' => 'line',
            "provider" => $provider,
            "oauth_id" => $user->getId()
        ], [
            "credential" => json_encode($this->credential($user))
        ]);
    }

    public function studentLoginCallback()
    {
        return $this->loginCallback("students");
    }

    public function teacherLoginCallback()
    {
        return $this->loginCallback("teachers");
    }

    public function loginCallback($provider)
    {
        $config = new Config(
            config("services.line.client_id"),
            config("services.line.client_secret"),
            config("services.line.redirect") . "-" . $provider
        );

        $user = Socialite::driver("line")->setConfig($config)->user();
        $socialiteOauth = $this->firstSocialiteOauth($provider, $user);

        if ($socialiteOauth->user_id == 0) {
            $userId = $provider == 'students' ? $this->studentLogin($user) : $this->teacherLogin($user);
            $socialiteOauth->user_id = $userId;
            $socialiteOauth->save();
        }


        $result = $this->getBearerTokenByUser($socialiteOauth->user_id, 2, $provider, false);

        $result['provider'] = $provider;
        $result['created_at'] = time() * 1000;
        $url = config("services.line.login_callback_uri") . "?token=" . json_encode($result);
        return redirect($url);
    }

    private function studentLogin($user)
    {
        $student = Student::create([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
        ]);

        return $student->id;
    }

    private function teacherLogin($user)
    {
        $teacher = Teacher::create([
            "name" => $user->getName(),
            "email" => $user->getEmail(),
        ]);

        return $teacher->id;
    }

    private function credential($user)
    {
        return [];
    }
}
