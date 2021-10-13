<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validate = $this->validator($request->all());

        if ($validate->fails()) {
            return new JsonResponse($validate->errors());
        }

        event(new Registered(($user = $this->create($request->all()))));

        return new JsonResponse($user);
    }
}
