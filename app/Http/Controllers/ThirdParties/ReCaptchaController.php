<?php

namespace App\Http\Controllers\ThirdParties;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\ThirdParties\ReCaptchaService;

class ReCaptchaController extends Controller
{
    private $reCaptchaService;

    public function __construct(ReCaptchaService $reCaptchaService)
    {
        $this->reCaptchaService = $reCaptchaService;
    }

    public function verifyReCaptcha(Request $request)
    {
        $data = $request->only('secret', 'response');
        $validator = Validator::make($data, [
            'secret' => 'required',
            'response' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages(), 'code' => 422]);
        }
        
        return response()->json($this->reCaptchaService->verifyReCaptcha($data));
    }

}