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
        'client_id' => '1654948440',
        'client_secret' => '97598cee2c20442a095e00af12bf05d6',
        'redirect' => 'https://jpedu-lw-demo.herokuapp.com/line-redirect-to-provider/',
        // 登陆成功后回调前端地址
        'login_callback_uri' => "https://secret-oasis-69470.herokuapp.com/",
        // 学生绑定之后回调前端地址
        'student_bind_callback_uri' => "https://secret-oasis-69470.herokuapp.com/personal-center/student",
        // 老师绑定之后回调前端地址
        'teacher_bind_callback_uri' => "https://secret-oasis-69470.herokuapp.com/personal-center/teacher",
    ],

];
