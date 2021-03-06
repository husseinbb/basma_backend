<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\Customers\CustomerService;
use JWTAuth;
use App\Contracts\DateConstants;
use App\Contracts\UserConstants;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    private $customerService, $user;

    public function __construct(CustomerService $customerService)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->customerService = $customerService;
    }

    public function getCustomers(Request $request)
    {
        if (!$this->checkIfUserAuthorized()) {
            return response()->json(['error' => 'Not Authorized', 'code' => 401]);
        }

        $data = $request->only('id', 'first_name', 'email', 'pagination');
        $validator = Validator::make($data, [
            'id' => 'numeric',
            'first_name' => 'string',
            'email' => 'email',
            'pagination' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages(), 'code' => 422]);
        }

        $customers = $this->customerService->getCustomers($data);
        return response()->json(['success' => true, 'customers' => $customers, 'code' => 200]);
    }

    public function getAverageRegistration(Request $request)
    {
        if (!$this->checkIfUserAuthorized()) {
            return response()->json(['error' => 'Not Authorized', 'code' => 401]);
        }
        
        $data = $request->only('period');
        $validator = Validator::make($data, [
            'period' => ['required', Rule::in(array_keys(DateConstants::PERIODS))]
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages(), 'code' => 422]);
        }

        $average = $this->customerService->getAverageRegistration($data);
        return response()->json(['success' => true, 'average' => $average, 'code' => 200]);
    }   

    public function checkIfUserAuthorized()
    {
        return ($this->user->type == UserConstants::ADMIN);
    }
}