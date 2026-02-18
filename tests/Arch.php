<?php

declare(strict_types=1);

arch('controllers do not extend anything besides Controller')
    ->expect('App\Http\Controllers')
    ->toExtendNothing()
    ->ignoring('App\Http\Controllers\Controller');

arch('admin controllers extend base controller')
    ->expect('App\Http\Controllers\Admin')
    ->toExtend('App\Http\Controllers\Controller');

arch('models extend eloquent')
    ->expect('App\Models')
    ->toExtend('Illuminate\Database\Eloquent\Model')
    ->ignoring('App\Models\User');

arch('services have documented methods')
    ->expect('App\Services')
    ->toHaveMethodsDocumented();

arch('no debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

arch('strict types in app namespace')
    ->expect('App')
    ->toUseStrictTypes();

arch('controllers have Controller suffix')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

arch('models are in Models namespace')
    ->expect('App\Models')
    ->toBeClasses();

arch('services are final or have tests')
    ->expect('App\Services')
    ->toBeClasses();

arch('requests extend form request')
    ->expect('App\Http\Requests')
    ->toExtend('Illuminate\Foundation\Http\FormRequest');

arch('mail classes extend mailable')
    ->expect('App\Mail')
    ->toExtend('Illuminate\Mail\Mailable');
