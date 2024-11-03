<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    protected function validate(Request $request, array $validation, callable $callbackFail, callable $callbackSuccess, array $parameters = []): RedirectResponse
    {
        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return $callbackFail($validator, ...$parameters);
        }
        return $callbackSuccess($request, ...$parameters);
    }
}
