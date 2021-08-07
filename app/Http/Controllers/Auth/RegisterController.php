<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\UserConstants;
use App\Services\Auth\RegisterService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

    private $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password', 'type');

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
            'type' => ['string', Rule::in(UserConstants::TYPES)],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages(), 'code' => 422]);
        }
        $data['password'] = bcrypt($data['password']);
        $user = $this->registerService->register($data);
        return response()->json(['success' => true, 'user' => $user, 'code' => 200]);
    }
}
