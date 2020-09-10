<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // line 社会化登录
    'line' => [
        'client_id' => env('LINE_KEY'),
        'client_secret' => env('LINE_SECRET'),
        'redirect' => env('LINE_REDIRECT_URI'),
        // 登陆成功后回调前端地址
        'login_callback_uri' => env("LINE_LOGIN_CALLBACK_URI", "http://localhost:8080/"),
        // 学生绑定之后回调前端地址
        'student_bind_callback_uri' => env("LINE_STUDENT_BIND_CALLBACK_URI", "http://localhost:8080/personal-center/student"),
        // 老师绑定之后回调前端地址
        'teacher_bind_callback_uri' => env("LINE_STUDENT_BIND_CALLBACK_URI", "http://localhost:8080/personal-center/teacher"),
    ],

];
